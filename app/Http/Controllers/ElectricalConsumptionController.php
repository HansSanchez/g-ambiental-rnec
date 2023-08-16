<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\ElectricalConsumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ElectricalConsumptionController extends Controller
{
    // FUNCIÓN DE OBTENCIÓN DE DATOS
    public function getElectricalConsumptions(Request $request)
    {
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LA CONSUMOS ELÉCTRICOS
        $electricalConsumptions =
            // RELACIONES
            ElectricalConsumption::with([
                'Delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                'EvidenceElectricalConsumption' => function ($query) {
                    $query->select(
                        'evidence_electrical_consumptions.id',
                        'evidence_electrical_consumptions.file',
                        'evidence_electrical_consumptions.electrical_consumption_id'
                    );
                },
                'Municipality' => function ($query) {
                    $query->select(
                        'municipalities.id',
                        'municipalities.city_name',
                    );
                },
                // RELACIÓN CON EL REPORTANTE
                'User' => function ($query) {
                    $query->select(
                        'users.id',
                        'users.first_name',
                        'users.second_name',
                        'users.first_last_name',
                        'users.second_last_name',
                    );
                },
            ])
            // FILTRO DE CONSULTA SEGÚN PARAMETROS DE BÚSQUEDA
            ->where(function ($query) use ($request, $permissions) {
                // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
                if ($request->search) $query->search($request->search);
                // FILTRO PARA BÚSQUEDA POR AÑO
                if ($request->yearFilter) $query->where('electrical_consumptions.year', $request->yearFilter);
                // FILTRO PARA BÚSQUEDA POR MES
                if ($request->monthFilter) $query->where('electrical_consumptions.month', $request->monthFilter);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
                if (array_key_exists('filter_delegations_electrical_consumptions', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->delegations_model) {
                        $delegation = json_decode($request->delegations_model);
                        $query->where('electrical_consumptions.delegation_id', $delegation->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN A LA CUAL PERTENECE
                    $query->where('electrical_consumptions.delegation_id', Auth::user()->delegation_id);
                }
            })
            // ORDENAMIENTO POR ID
            ->orderBy('electrical_consumptions.id')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(10);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['electricalConsumptions' => $electricalConsumptions]);
    }

    // FUNCIÓN PARA CREACIÓN
    public function store(Request $request)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // OBTENCIÓN DE LA DELEGACIÓN DEL USUARIO CON SESIÓN ACTIVA
                $delegation_id = auth()->user()->delegation_id;

                // GUARDADO DEL REGISTRO HECHO
                // LOS QUE NO NECESITA UN TRATAMIENTO ESPECIAL PASAN DIRECTO POR EL ALL()
                $electricalConsumption = new ElectricalConsumption($request->all());
                $electricalConsumption->delegation_id = $delegation_id; // DELEGACIÓN
                $electricalConsumption->municipality_id = $request->municipality['code']; // MUNICIPIO
                $electricalConsumption->environmental_manager = mb_strtoupper($request->environmental_manager); // GESTOR AMBIENTAL
                $electricalConsumption->user_id = $user_id; // USUARIO QUE GENERÓ EL REPORTE
                $electricalConsumption->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // REGISTRO DE LAS RELACIONES
                $electricalConsumption->Delegation;
                $electricalConsumption->EvidenceElectricalConsumption;
                $electricalConsumption->Municipality;
                $electricalConsumption->User; // QUIEN REPORTÓ

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - CONSUMOS ELÉCTRICOS ID #' . $electricalConsumption->id,
                    'description' => $electricalConsumption,
                    'module' => 'CONSUMOS ELÉCTRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha realizadó con éxito.',
                    'electricalConsumption' => $electricalConsumption,
                    'new' => true

                ]);
            } else {
                // CONTROL DE CASO DE SESIÓN EXPIRADA
                Log::error("Intento de guardado sin sesión activa - Registro de plantación de árboles");
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'warning',
                    'msg' => 'La sesión se ha cerrado, por ende, no puedes hacer este registro.',
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(ElectricalConsumptionsController - store) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA VISUALIZACIÓN DE DETALLE
    public function show(ElectricalConsumption $electricalConsumption)
    {
        // CONTROL DE ERRORES
        try {

            // REGISTRO DE LAS RELACIONES
            $electricalConsumption->Delegation;
            $electricalConsumption->EvidenceElectricalConsumption;
            $electricalConsumption->Municipality;
            $electricalConsumption->User; // QUIEN REPORTÓ

            // RESPUESTA PARA EL USUARIO
            return response()->json(['electricalConsumption' => $electricalConsumption]);
        } catch (\Exception $exception) {
            Log::error("(ElectricalConsumptionsController - show) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ACTUALIZACIÓN
    public function update(Request $request, ElectricalConsumption $electricalConsumption)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = $electricalConsumption->user_id;

                // OBTENCIÓN DE LA DELEGACIÓN DEL USUARIO QUE HIZO EL REGISTRO
                $delegation_id = $electricalConsumption->delegation_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - CONSUMOS ELÉCTRICOS ID #' . $electricalConsumption->id,
                    'description' => $electricalConsumption,
                    'module' => 'CONSUMOS ELÉCTRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $electricalConsumption->update([
                    'environmental_manager' => mb_strtoupper($request->environmental_manager), // OPERADOR AMBIENTAL
                    'delegation_id' => $delegation_id, // DELEGACIÓN
                    'municipality_id' => $request->municipality['code'], // MUNICIPIO,
                    'year' => $request->year, // AÑO RELACIONADO
                    'month' => $request->month, // MES RELACIONADO
                    'kw_monthly' => $request->kw_monthly, // KILOWATTS (MES)
                    'total_staff' => $request->total_staff, // TOTAL DE PERSONAL
                    'observations' => $request->observations, // OBSERVACIONES
                    'user_id' => $user_id, // REPORTANTE
                ]);

                // REGISTRO DE LAS RELACIONES
                $electricalConsumption->Delegation;
                $electricalConsumption->EvidenceElectricalConsumption;
                $electricalConsumption->Municipality;
                $electricalConsumption->User; // QUIEN REPORTÓ

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN FINAL DE REGISTRO - CONSUMOS ELÉCTRICOS ID #' . $electricalConsumption->id,
                    'description' => $electricalConsumption,
                    'module' => 'CONSUMOS ELÉCTRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'electricalConsumption' => $electricalConsumption,
                    'new' => false
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(ElectricalConsumptionsController - update) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ELIMINACIÓN (ELIMINADCÓN LÓGICA)
    public function destroy(ElectricalConsumption $electricalConsumption)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE REGISTRO - CONSUMOS ELÉCTRICOS ID #' . $electricalConsumption->id,
                    'description' => $electricalConsumption,
                    'module' => 'CONSUMOS ELÉCTRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $electricalConsumption->delete();

                // REGISTRO DE LAS RELACIONES
                $electricalConsumption->Delegation;
                $electricalConsumption->EvidenceElectricalConsumption;
                $electricalConsumption->Municipality;
                $electricalConsumption->User; // QUIEN REPORTÓ

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'electricalConsumption' => $electricalConsumption,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(ElectricalConsumptionsController - destroy) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA GENERACIÓN DE REPORTES
    public function generateReport(Request $request)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // DEFINICIÓN DE VARIABLES
                $fromDay = null;
                $untilDay = null;
                $day = null;
                $weekStartDate = null;
                $weekEndDate = null;
                $monthStartDate = null;
                $monthEndDate = null;
                $yearStartDate = null;
                $yearEndDate = null;
                $date = Carbon::now();
                $permissions = new HomeController;

                // CONDICIONALES POR SI LLEGAN NULOS LOS CAMPOS, NO VIENEN O SI HAY QUE TENERLOS EN CUENTA
                if ($request->fromDay != null) $fromDay = date('Y-m-d', strtotime($request->fromDay));
                if ($request->untilDay != null) $untilDay = date('Y-m-d', strtotime($request->untilDay));
                if ($request->has('day')) $day = date('Y-m-d', strtotime($request->day));
                if ($request->has('week')) {
                    $weekStartDate = $date->startOfWeek()->format('Y-m-d H:i');
                    $weekEndDate = $date->endOfWeek()->format('Y-m-d H:i');
                }
                if ($request->has('month')) {
                    $monthStartDate = $date->startOfMonth()->format('Y-m-d H:i');
                    $monthEndDate = $date->endOfMonth()->format('Y-m-d H:i');
                }
                if ($request->has('year')) {
                    $yearStartDate = $date->startOfYear()->format('Y-m-d H:i');
                    $yearEndDate = $date->endOfYear()->format('Y-m-d H:i');
                }

                // CONSULTA POR RANGO DE FECHAS, DÍA, SEMANA, MES O AÑO
                $report = DB::table('electrical_consumptions')
                    // COLUMNAS DE INTERÉS PARA EL REPORTE
                    ->select(
                        'delegations.id AS d_id',
                        'delegations.name AS d_name',
                        'electrical_consumptions.id AS cra_id',
                        'electrical_consumptions.delegation_id AS cra_delegation_id',
                        'electrical_consumptions.environmental_operator AS cra_environmental_operator',
                        'electrical_consumptions.date AS cra_date',
                        'electrical_consumptions.state AS cra_state',
                        'electrical_consumptions.observations AS cra_observations',
                        'electrical_consumptions.created_at AS cra_created_at',
                        'electrical_consumptions.user_id AS cra_user_id',
                        'municipalities.id AS m_id',
                        'municipalities.city_name AS m_city_name',
                        'users.id AS u_id',
                        'users.personal_id AS u_personal_id',
                        'users.first_name AS u_first_name',
                        'users.second_name AS u_second_name',
                        'users.first_last_name AS u_first_last_name',
                        'users.second_last_name AS u_second_last_name',
                        'users.position AS u_position',
                        'users.email AS u_email',
                        'users.delegation_id AS u_delegation_id',
                    )
                    // RELACIÓN CON LA DELEGACIÓN EN DONDE SE HIZO EL REGISTRO
                    ->join('delegations', 'delegations.id', '=', 'electrical_consumptions.delegation_id')
                    // RELACIÓN CON EL USUARIO QUE HIZO EL REGISTRO
                    ->join('users', 'users.id', '=', 'electrical_consumptions.user_id')
                    // RELACIÓN CON EL(LOS) MUNICIPIO(S)
                    ->join('municipality_electrical_consumptions', 'municipality_electrical_consumptions.co_responsibility_agreement_id', '=', 'electrical_consumptions.id')
                    ->join('municipalities', 'municipalities.id', '=', 'municipality_electrical_consumptions.municipality_id')
                    // FILTRO DE CONSULTA SEGÚN PARAMETROS DE FECHA
                    ->where(function ($query) use ($fromDay, $untilDay, $day, $weekStartDate, $weekEndDate, $monthStartDate, $monthEndDate, $yearStartDate, $yearEndDate) {
                        if ($day != null) $query->whereBetween('electrical_consumptions.date', [$day . " 00:00:00", $day . " 23:59:59"]);
                        if ($weekStartDate != null || $weekEndDate != null) $query->whereBetween('electrical_consumptions.date', [$weekStartDate, $weekEndDate]);
                        if ($monthStartDate != null || $monthEndDate != null) $query->whereBetween('electrical_consumptions.date', [$monthStartDate, $monthEndDate]);
                        if ($yearStartDate != null || $yearEndDate != null) $query->whereBetween('electrical_consumptions.date', [$yearStartDate, $yearEndDate]);
                        if ($fromDay != null && $untilDay == null) $query->whereBetween('electrical_consumptions.date', [$fromDay . " 00:00:00", now()->format('Y-m-d') . " 23:59:59"]);
                        if ($fromDay == null && $untilDay != null) $query->whereBetween('electrical_consumptions.date', ["2000-01-01 00:00:00", $untilDay . " 23:59:59"]);
                        if ($fromDay != null && $untilDay != null) $query->whereBetween('electrical_consumptions.date', [$fromDay . " 00:00:00", $untilDay . " 23:59:59"]);
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE DELEGACIÓN
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_delegations_electrical_consumptions', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->delegation) $query->where('electrical_consumptions.delegation_id', $request->delegation['code']);
                            // PERO SI NO LA ENVÍA ES PORQUE QUIERE UN REPORTE GENERAL
                            else $query->get();
                    })
                    // OBTENCIÓN DE LOS REGISTROS
                    ->get();

                // ESTA FUNCIÓN EN NECESARIA YA QUE LAS OBSERVACIONES SE GUARDAN CON HTML ES NECESARIO LIMPIARLAS PARA TENER SOLO EL TEXTO
                $cleanedReport = $report->map(function ($item) {
                    // LIMPIAR TEXTO HTML A TEXTO PLANO
                    $item->cra_observations = Str::of(strip_tags($item->cra_observations))->trim()->__toString();
                    // CAMBIAR EL FORMATO DE LA FECHA
                    $item->cra_date = Carbon::createFromFormat('Y-m-d H:i:s', $item->cra_date)->format('d-m-Y');
                    // CAMBIAR EL FORMATO DE LA FECHA
                    $item->cra_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $item->cra_created_at)->format('d-m-Y h:i:s');
                    // AGREGAR UN CAMPO PERSONALIZADO (NOMBRE COMPLETO)
                    $item->u_full_name = $item->u_first_name . ' ' . $item->u_second_name . ' ' . $item->u_first_last_name . ' ' . $item->u_second_last_name;
                    // RETORNO DE LOS CAMBIOS
                    return $item;
                });


                // TRANSFORMAR LA INFORMACIÓN DE USUARIOS DENTRO DE CADA ELEMENTO DEL REPORTE
                foreach ($cleanedReport as $key => $item) {
                    // CONSULTA DE ID'S DE LOS USUARIOS EN LA TABLA INTERMEDIA
                    $IdUsers = DB::table('user_electrical_consumptions')
                        ->select('user_id AS ucra_user_id')
                        ->where('co_responsibility_agreement_id', $item->cra_id)
                        ->get();

                    $users = []; // CREAR UN ARRAY PARA ALMACENAR LA INFORMACIÓN DE LOS USUARIOS

                    // CICLO PARA CONSULTAR LOS DATOS DE LOS USUARIOS RELACIONADOS COMO GESTOR(ES) AMBIENTAL(ES)
                    foreach ($IdUsers as $key => $value) {
                        $user = DB::table('users')
                            ->select('users.id AS u_id', 'users.first_name AS u_first_name', 'users.second_name AS u_second_name', 'users.first_last_name AS u_first_last_name', 'users.second_last_name AS u_second_last_name')
                            ->where('id', $value->ucra_user_id)
                            ->first();
                        if ($user) $users[] = $user; // AGREGAR EL USUARIO AL ARRAY
                    }

                    // CONVERTIR EL ARRAY EN UNA COLECCIÓN ANTES DE USAR MAP()
                    $usersCollection = collect($users);

                    // APLICAR MAP() EN LA COLECCIÓN
                    $newUsers = $usersCollection->map(function ($item) {
                        // AGREGAR UN CAMPO PERSONALIZADO (NOMBRE COMPLETO)
                        $item->u_full_name = $item->u_first_name . ' ' . $item->u_second_name . ' ' . $item->u_first_last_name . ' ' . $item->u_second_last_name;
                        // RETORNO DE LOS CAMBIOS
                        return $item;
                    });

                    // AGREGAR LA INFORMACIÓN TRANSFORMADA AL ELEMENTO DEL REPORTE
                    $item->users = $newUsers;
                }

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'GENERACIÓN DE REPORTE MASIVO DE CONSUMOS ELÉCTRICOS',
                    'module' => 'CONSUMOS ELÉCTRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // VALIDACIÓN DE CANTIDAD DE RESGISTROS EN LA RESPUESTA (SI NO HAY REGISTROS)
                if (count($cleanedReport) == 0) return response()->json(['file' => false, 'msg' => 'Para este rango de fechas no existen registros, verifique por favor.', 'fileName' => null, 'icon' => 'warning']);
                // SI HAY REGISTROS
                else {
                    $fileName = 'REPORTE-DE-ACUERDOS-DE-CORRESPONSABILIDAD-' . str_replace([':', ' '], '-', now()->toDateTimeString()) . '.xlsx';
                    Excel::store(new ElectricalConsumptionExport($cleanedReport), $fileName, 'electrical_consumptions');
                    sleep(5);
                    return response()->json(['file' => true, 'msg' => 'Reporte generado con éxito', 'fileName' => $fileName, 'icon' => 'success']);
                }
            }
        } catch (\Exception $exception) {
            Log::error("(ElectricalConsumptionsController - generateReport) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
