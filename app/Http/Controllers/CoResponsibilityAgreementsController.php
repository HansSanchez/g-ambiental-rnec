<?php

namespace App\Http\Controllers;

use App\Exports\CoResponsibilityAgreementExport;
use App\Models\Audit;
use App\Models\CoResponsibilityAgreement;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class CoResponsibilityAgreementsController extends Controller
{
    // FUNCIÓN DE OBTENCIÓN DE DATOS
    public function getCoResponsibilityAgreements(Request $request)
    {
        // ADECUACIÓN DE TEXTO A FECHA DEL PARAMETRO QUE LLEGA
        $day = date('Y-m-d', strtotime($request->dateFilter));
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LA ACUERDOS DE CORRESPONSABILIDAD
        $coResponsibilityAgreements =
            // RELACIONES
            CoResponsibilityAgreement::with([
                'Delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                'EvidenceCoResponsibilityAgreement' => function ($query) {
                    $query->select(
                        'evidence_co_responsibility_agreements.id',
                        'evidence_co_responsibility_agreements.file',
                        'evidence_co_responsibility_agreements.co_responsibility_agreement_id'
                    );
                },
                'Municipalities' => function ($query) {
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
                // RELACIÓN CON LOS GESTORES AMBIENTALES (TABLA PIVOT)
                'Users' => function ($query) {
                    $query->select(
                        'users.id',
                        'users.first_name',
                        'users.second_name',
                        'users.first_last_name',
                        'users.second_last_name',
                    );
                }
            ])
            // FILTRO DE CONSULTA SEGÚN PARAMETROS DE BÚSQUEDA
            ->where(function ($query) use ($request, $day, $permissions) {
                // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
                if ($request->search) $query->search($request->search);
                // FILTRO PARA BÚSQUEDA DE FECHA DE FIRMACIÓN
                if ($request->dateFilter) $query->whereBetween('co_responsibility_agreements.date', [$day . " 00:00:00", $day . " 23:59:59"]);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
                if (array_key_exists('filter_delegations_co_responsibility_agreements', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->delegations_model) {
                        $delegation = json_decode($request->delegations_model);
                        $query->where('co_responsibility_agreements.delegation_id', $delegation->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN A LA CUAL PERTENECE
                    $query->where('co_responsibility_agreements.delegation_id', Auth::user()->delegation_id);
                }
            })
            // ORDENAMIENTO POR ID
            ->orderBy('co_responsibility_agreements.id')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(10);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['coResponsibilityAgreements' => $coResponsibilityAgreements]);
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

                // OBTENCIÓN DE LA DELEGACIÓN DEL FUNCIONARIO(A) CON SESIÓN ACTIVA
                $delegation_id = auth()->user()->delegation_id;

                // GUARDADO DEL REGISTRO HECHO
                // LOS QUE NO NECESITA UN TRATAMIENTO ESPECIAL PASAN DIRECTO POR EL ALL()
                $coResponsibilityAgreement = new CoResponsibilityAgreement($request->all());
                $coResponsibilityAgreement->delegation_id = $delegation_id; // DELEGACIÓN
                $coResponsibilityAgreement->environmental_operator = mb_strtoupper($request->environmental_operator); // OPERADOR AMBIENTAL
                $coResponsibilityAgreement->state = $request->state == true ? 'VIGENTE' : 'NO VIGENTE';
                $coResponsibilityAgreement->user_id = $user_id; // USUARIO QUE GENERÓ EL REPORTE
                $coResponsibilityAgreement->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // RELACIONAMIENTO DEL ACUERDO CON EL(LOS) MUNICIPIO(S)
                if ($request->input('municipalities'))
                    foreach ($request->input('municipalities') as $municipalitiy)
                        $coResponsibilityAgreement->municipalities()->attach($municipalitiy['code']);

                // RELACIONAMIENTO DEL ACUERDO CON LOS GESTORES AMBIENTALES (USUARIOS)
                if ($request->input('users'))
                    foreach ($request->input('users') as $user)
                        $coResponsibilityAgreement->users()->attach($user['code']);


                // REGISTRO DE LAS RELACIONES
                $coResponsibilityAgreement->Delegation;
                $coResponsibilityAgreement->EvidenceCoResponsibilityAgreement;
                $coResponsibilityAgreement->Municipalities;
                $coResponsibilityAgreement->User; // QUIEN REPORTÓ
                $coResponsibilityAgreement->Users; // GESTORES AMBIENTALES

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - ACUERDOS DE CORRESPONSABILIDAD ID #' . $coResponsibilityAgreement->id,
                    'description' => $coResponsibilityAgreement,
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha realizadó con éxito.',
                    'coResponsibilityAgreement' => $coResponsibilityAgreement,
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
            Log::error("(CoResponsibilityAgreementsController - store) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA VISUALIZACIÓN DE DETALLE
    public function show(CoResponsibilityAgreement $coResponsibilityAgreement)
    {
        // CONTROL DE ERRORES
        try {

            // REGISTRO DE LAS RELACIONES
            $coResponsibilityAgreement->Delegation;
            $coResponsibilityAgreement->EvidenceCoResponsibilityAgreement;
            $coResponsibilityAgreement->Municipalities;
            $coResponsibilityAgreement->User; // QUIEN REPORTÓ
            $coResponsibilityAgreement->Users; // GESTORES AMBIENTALES


            // RESPUESTA PARA EL USUARIO
            return response()->json(['coResponsibilityAgreement' => $coResponsibilityAgreement]);
        } catch (\Exception $exception) {
            Log::error("(CoResponsibilityAgreementsController - show) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ACTUALIZACIÓN
    public function update(Request $request, CoResponsibilityAgreement $coResponsibilityAgreement)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = $coResponsibilityAgreement->user_id;

                // OBTENCIÓN DE LA DELEGACIÓN DEL FUNCIONARIO(A) QUE HIZO EL REGISTRO
                $delegation_id = $coResponsibilityAgreement->delegation_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - ACUERDOS DE CORRESPONSABILIDAD ID #' . $coResponsibilityAgreement->id,
                    'description' => $coResponsibilityAgreement,
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $coResponsibilityAgreement->update([
                    'delegation_id' => $delegation_id, // DELEGACIÓN
                    'environmental_operator' => mb_strtoupper($request->environmental_operator), // OPERADOR AMBIENTAL
                    'date' => $request->date, // FECHA DE FIRMA
                    'state' => $request->state == true ? 'VIGENTE' : 'NO VIGENTE', // ESTADO
                    'observations' => $request->observations, // OBSERVACIONES
                    'user_id' => $user_id, // REPORTANTE
                ]);

                // RELACIONAMIENTO DEL ACUERDO CON EL(LOS) MUNICIPIO(S)
                $coResponsibilityAgreement->municipalities()->detach(); // SIEMPRE QUE SE EDITA
                if ($request->input('municipalities'))
                    foreach ($request->input('municipalities') as $municipalitiy)
                        $coResponsibilityAgreement->municipalities()->attach($municipalitiy['code']);

                // RELACIONAMIENTO DEL ACUERDO CON LOS GESTORES AMBIENTALES (USUARIOS)
                $coResponsibilityAgreement->users()->detach(); // SIEMPRE QUE SE EDITA
                if ($request->input('users'))
                    foreach ($request->input('users') as $user)
                        $coResponsibilityAgreement->users()->attach($user['code']);

                // REGISTRO DE LAS RELACIONES
                $coResponsibilityAgreement->Delegation;
                $coResponsibilityAgreement->EvidenceCoResponsibilityAgreement;
                $coResponsibilityAgreement->Municipalities;
                $coResponsibilityAgreement->User; // QUIEN REPORTÓ
                $coResponsibilityAgreement->Users; // GESTORES AMBIENTALES

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN FINAL DE REGISTRO - ACUERDOS DE CORRESPONSABILIDAD ID #' . $coResponsibilityAgreement->id,
                    'description' => $coResponsibilityAgreement,
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'coResponsibilityAgreement' => $coResponsibilityAgreement,
                    'new' => false
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(CoResponsibilityAgreementsController - update) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ELIMINACIÓN (ELIMINADCÓN LÓGICA)
    public function destroy(CoResponsibilityAgreement $coResponsibilityAgreement)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE REGISTRO - ACUERDOS DE CORRESPONSABILIDAD ID #' . $coResponsibilityAgreement->id,
                    'description' => $coResponsibilityAgreement,
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $coResponsibilityAgreement->delete();

                // REGISTRO DE LAS RELACIONES
                $coResponsibilityAgreement->Delegation;
                $coResponsibilityAgreement->EvidenceTreePlantations;
                $coResponsibilityAgreement->User;

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'coResponsibilityAgreement' => $coResponsibilityAgreement,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(CoResponsibilityAgreementsController - destroy) ERROR => " . $exception->getMessage());
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
                $report = DB::table('co_responsibility_agreements')
                    // COLUMNAS DE INTERÉS PARA EL REPORTE
                    ->select(
                        'delegations.id AS d_id',
                        'delegations.name AS d_name',
                        'co_responsibility_agreements.id AS cra_id',
                        'co_responsibility_agreements.delegation_id AS cra_delegation_id',
                        'co_responsibility_agreements.environmental_operator AS cra_environmental_operator',
                        'co_responsibility_agreements.date AS cra_date',
                        'co_responsibility_agreements.state AS cra_state',
                        'co_responsibility_agreements.observations AS cra_observations',
                        'co_responsibility_agreements.created_at AS cra_created_at',
                        'co_responsibility_agreements.user_id AS cra_user_id',
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
                    ->join('delegations', 'delegations.id', '=', 'co_responsibility_agreements.delegation_id')
                    // RELACIÓN CON EL USUARIO QUE HIZO EL REGISTRO
                    ->join('users', 'users.id', '=', 'co_responsibility_agreements.user_id')
                    // RELACIÓN CON EL(LOS) MUNICIPIO(S)
                    ->join('municipality_co_responsibility_agreements', 'municipality_co_responsibility_agreements.co_responsibility_agreement_id', '=', 'co_responsibility_agreements.id')
                    ->join('municipalities', 'municipalities.id', '=', 'municipality_co_responsibility_agreements.municipality_id')
                    // FILTRO DE CONSULTA SEGÚN PARAMETROS DE FECHA
                    ->where(function ($query) use ($fromDay, $untilDay, $day, $weekStartDate, $weekEndDate, $monthStartDate, $monthEndDate, $yearStartDate, $yearEndDate) {
                        if ($day != null) $query->whereBetween('co_responsibility_agreements.date', [$day . " 00:00:00", $day . " 23:59:59"]);
                        if ($weekStartDate != null || $weekEndDate != null) $query->whereBetween('co_responsibility_agreements.date', [$weekStartDate, $weekEndDate]);
                        if ($monthStartDate != null || $monthEndDate != null) $query->whereBetween('co_responsibility_agreements.date', [$monthStartDate, $monthEndDate]);
                        if ($yearStartDate != null || $yearEndDate != null) $query->whereBetween('co_responsibility_agreements.date', [$yearStartDate, $yearEndDate]);
                        if ($fromDay != null && $untilDay == null) $query->whereBetween('co_responsibility_agreements.date', [$fromDay . " 00:00:00", now()->format('Y-m-d') . " 23:59:59"]);
                        if ($fromDay == null && $untilDay != null) $query->whereBetween('co_responsibility_agreements.date', ["2000-01-01 00:00:00", $untilDay . " 23:59:59"]);
                        if ($fromDay != null && $untilDay != null) $query->whereBetween('co_responsibility_agreements.date', [$fromDay . " 00:00:00", $untilDay . " 23:59:59"]);
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE DELEGACIÓN
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_delegations_co_responsibility_agreements', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->delegation) $query->where('co_responsibility_agreements.delegation_id', $request->delegation['code']);
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
                    $IdUsers = DB::table('user_co_responsibility_agreements')
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
                    'action' => 'GENERACIÓN DE REPORTE MASIVO DE ACUERDOS DE CORRESPONSABILIDAD',
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // VALIDACIÓN DE CANTIDAD DE RESGISTROS EN LA RESPUESTA (SI NO HAY REGISTROS)
                if (count($cleanedReport) == 0) return response()->json(['file' => false, 'msg' => 'Para este rango de fechas no existen registros, verifique por favor.', 'fileName' => null, 'icon' => 'warning']);
                // SI HAY REGISTROS
                else {
                    $fileName = 'REPORTE-DE-ACUERDOS-DE-CORRESPONSABILIDAD-' . str_replace([':', ' '], '-', now()->toDateTimeString()) . '.xlsx';
                    Excel::store(new CoResponsibilityAgreementExport($cleanedReport), $fileName, 'co_responsibility_agreements');
                    sleep(5);
                    return response()->json(['file' => true, 'msg' => 'Reporte generado con éxito', 'fileName' => $fileName, 'icon' => 'success']);
                }
            }
        } catch (\Exception $exception) {
            Log::error("(CoResponsibilityAgreementsController - generateReport) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
