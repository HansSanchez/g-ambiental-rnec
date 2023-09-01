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
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LA ACUERDOS DE CORRESPONSABILIDAD
        $coResponsibilityAgreements = CoResponsibilityAgreement::withRelations() // SCOPE EN EL MODELO (RELACIONES)
            ->filter($request, date('Y-m-d', strtotime($request->dateFilter)), $permissions) // SCOPE EN EL MODELO (FILTROS)
            // ORDENAMIENTO POR ID
            ->orderBy('co_responsibility_agreements.id', 'DESC')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(15);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['coResponsibilityAgreements' => $coResponsibilityAgreements]);
    }

    public function allRelations($coResponsibilityAgreement)
    {
        // REGISTRO DE LAS RELACIONES
        $coResponsibilityAgreement->Headquarter;
        $coResponsibilityAgreement->Headquarter->Delegation;
        $coResponsibilityAgreement->Headquarter->Municipality;
        $coResponsibilityAgreement->Headquarters;
        $coResponsibilityAgreement->EvidenceCoResponsibilityAgreement;
        $coResponsibilityAgreement->User; // QUIEN REPORTÓ
        $coResponsibilityAgreement->Users; // GESTORES AMBIENTALES
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

                // OBTENCIÓN DE LA SEDE DEL FUNCIONARIO(A) CON SESIÓN ACTIVA
                $headquarter_id = auth()->user()->headquarter_id;

                // GUARDADO DEL REGISTRO HECHO
                // LOS QUE NO NECESITA UN TRATAMIENTO ESPECIAL PASAN DIRECTO POR EL ALL()
                $coResponsibilityAgreement = new CoResponsibilityAgreement($request->all());
                $coResponsibilityAgreement->state = $request->state == true ? 'VIGENTE' : 'NO VIGENTE';
                $coResponsibilityAgreement->headquarter_id = $headquarter_id; // SEDE
                $coResponsibilityAgreement->user_id = $user_id; // USUARIO QUE GENERÓ EL REPORTE
                $coResponsibilityAgreement->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // RELACIONAMIENTO DEL ACUERDO CON LA(LAS) SEDE(S)
                if ($request->input('headquarters'))
                    foreach ($request->input('headquarters') as $headquarter)
                        $coResponsibilityAgreement->headquarters()->attach($headquarter['code']);

                // RELACIONAMIENTO DEL ACUERDO CON LOS GESTORES AMBIENTALES (USUARIOS)
                if ($request->input('users'))
                    foreach ($request->input('users') as $user)
                        $coResponsibilityAgreement->users()->attach($user['code']);

                // RELACIONES
                $this->allRelations($coResponsibilityAgreement);

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
            // RELACIONES
            $this->allRelations($coResponsibilityAgreement);
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

                // OBTENCIÓN DE LA SEDE DEL FUNCIONARIO(A) QUE HIZO EL REGISTRO
                $headquarter_id = $coResponsibilityAgreement->headquarter_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - ACUERDOS DE CORRESPONSABILIDAD ID #' . $coResponsibilityAgreement->id,
                    'description' => $coResponsibilityAgreement,
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $coResponsibilityAgreement->update([
                    'headquarter_id' => $headquarter_id, // SEDE
                    'date' => $request->date, // FECHA DE FIRMA
                    'state' => $request->state == true ? 'VIGENTE' : 'NO VIGENTE', // ESTADO
                    'observations' => $request->observations, // OBSERVACIONES
                    'user_id' => $user_id, // REPORTANTE
                ]);

                // RELACIONAMIENTO DEL ACUERDO CON LA(LAS) SEDE(S)
                $coResponsibilityAgreement->headquarters()->detach(); // SIEMPRE QUE SE EDITA
                if ($request->input('headquarters'))
                    foreach ($request->input('headquarters') as $headquarter)
                        $coResponsibilityAgreement->headquarters()->attach($headquarter['code']);

                // RELACIONAMIENTO DEL ACUERDO CON LOS GESTORES AMBIENTALES (USUARIOS)
                $coResponsibilityAgreement->users()->detach(); // SIEMPRE QUE SE EDITA
                if ($request->input('users'))
                    foreach ($request->input('users') as $user)
                        $coResponsibilityAgreement->users()->attach($user['code']);

                // RELACIONES
                $this->allRelations($coResponsibilityAgreement);

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

                // RELACIONES
                $this->allRelations($coResponsibilityAgreement);

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
                        'headquarters.id AS h_id',
                        'headquarters.name AS h_name',
                        'headquarters.delegation_id AS h_delegation_id',
                        'headquarters.municipality_id AS h_municipality_id',
                        'municipalities.id AS m_id',
                        'municipalities.city_name AS m_city_name',
                        'co_responsibility_agreements.id AS cra_id',
                        'co_responsibility_agreements.headquarter_id AS cra_headquarter_id',
                        'co_responsibility_agreements.environmental_operator AS cra_environmental_operator',
                        'co_responsibility_agreements.date AS cra_date',
                        'co_responsibility_agreements.state AS cra_state',
                        'co_responsibility_agreements.observations AS cra_observations',
                        'co_responsibility_agreements.created_at AS cra_created_at',
                        'co_responsibility_agreements.user_id AS cra_user_id',
                        'users.id AS u_id',
                        'users.personal_id AS u_personal_id',
                        'users.first_name AS u_first_name',
                        'users.second_name AS u_second_name',
                        'users.first_last_name AS u_first_last_name',
                        'users.second_last_name AS u_second_last_name',
                        'users.position AS u_position',
                        'users.email AS u_email',
                        'users.headquarter_id AS u_headquarter_id',
                    )
                    // RELACIÓN CON LA SEDE EN DONDE SE HIZO EL REGISTRO (SEDE, MUNICIPIO Y DELEGACIÓN)
                    ->join('headquarters', 'headquarters.id', '=', 'co_responsibility_agreements.headquarter_id')
                    ->join('municipalities', 'municipalities.id', '=', 'headquarters.municipality_id')
                    ->join('delegations', 'delegations.id', '=', 'headquarters.delegation_id')
                    // RELACIÓN CON EL USUARIO QUE HIZO EL REGISTRO
                    ->join('users', 'users.id', '=', 'co_responsibility_agreements.user_id')
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
                    // FILTRO DE CONSULTA POR PARAMETRO DE SEDE
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_delegations_co_responsibility_agreements', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->delegation) $query->where('co_responsibility_agreements.headquarter_id', $request->delegation['code']);
                            // PERO SI NO LA ENVÍA ES PORQUE QUIERE UN REPORTE GENERAL
                            else $query->get();
                    })
                    // OBTENCIÓN DE LOS REGISTROS
                    ->get()
                    ->groupBy('h_name'); // AGRUPAR POR NOMBRE DE SEDE

                // ESTA FUNCIÓN EN NECESARIA YA QUE LAS OBSERVACIONES SE GUARDAN CON HTML ES NECESARIO LIMPIARLAS PARA TENER SOLO EL TEXTO
                $cleanedReport = [];
                foreach ($report as $key1 => $headquarterData) {
                    foreach ($headquarterData as $key_2 => $record) {
                        if (is_object($record)) {
                            // CREAR UN NUEVO OBJETO PARA EL REGISTRO
                            $cleanedRecord = (object)[];

                            // COPIAR LAS PROPIEDADES DEL REGISTRO ORIGINAL
                            foreach ($record as $key => $value) $cleanedRecord->{$key} = $value;

                            // LIMPIEZA Y TRANSFORMACIÓN PARA CADA REGISTRO
                            $cleanedRecord->cra_observations = Str::of(strip_tags($record->cra_observations))->trim()->__toString();
                            $cleanedRecord->cra_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $record->cra_date)->format('d-m-Y');
                            $cleanedRecord->cra_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $record->cra_created_at)->format('d-m-Y h:i:s');
                            $cleanedRecord->h_full_name = mb_strtoupper($record->d_name . ' / ' . $record->m_city_name . ' / ' . $record->h_name, "UTF-8");
                            $cleanedRecord->u_full_name_r = mb_strtoupper($record->u_first_name . ' ' . $record->u_second_name . ' ' . $record->u_first_last_name . ' ' . $record->u_second_last_name, "UTF-8");

                            // AGREGAR EL OBJETO LIMPIO AL ARREGLO DE LA CIUDAD
                            // $key_1 CORRESPONDE AL AGRUPAMIENTO DE LAS SEDES (#NOTE - groupBy('h_name') LÍNEA 339)
                            // $key_2 CORRESPONDE A LA CANTIDAD DE ACUERDOS REGISTRADOS POR SEDE
                            $cleanedReport[$key1][$key_2] = $cleanedRecord;
                        }
                    }
                }

                // TRANSFORMAR LA INFORMACIÓN DE USUARIOS DENTRO DE CADA ELEMENTO DEL REPORTE
                foreach ($cleanedReport as $key_1 => $item) {
                    foreach ($item as $key_2 => $value) {
                        // CONSULTA DE ID'S DE LOS USUARIOS EN LA TABLA INTERMEDIA
                        $IdUsers = DB::table('user_co_responsibility_agreements')
                            ->select('user_id AS ucra_user_id')
                            ->where('co_responsibility_agreement_id', $value->cra_id)
                            ->get();

                        // CONSULTA DE ID'S DE LAS SEDES EN LA TABLA INTERMEDIA
                        $IdHeadquarters = DB::table('headquarter_co_responsibility_agreements')
                            ->select('headquarter_id AS hcra_headquarter_id')
                            ->where('co_responsibility_agreement_id', $value->cra_id)
                            ->get();

                        $users = []; // CREAR UN ARRAY PARA ALMACENAR LA INFORMACIÓN DE LOS USUARIOS
                        $headquarters = []; // CREAR UN ARRAY PARA ALMACENAR LA INFORMACIÓN DE LAS SEDES

                        // CICLO PARA CONSULTAR LOS DATOS DE LOS USUARIOS RELACIONADOS COMO GESTOR(ES) AMBIENTAL(ES)
                        foreach ($IdUsers as $key_3 => $value) {
                            $user = DB::table('users')
                                ->select('users.id AS u_id', 'users.first_name AS u_first_name', 'users.second_name AS u_second_name', 'users.first_last_name AS u_first_last_name', 'users.second_last_name AS u_second_last_name')
                                ->where('id', $value->ucra_user_id)
                                ->first();
                            if ($user) $users[] = $user; // AGREGAR EL USUARIO AL ARRAY
                        }

                        // CICLO PARA CONSULTAR LOS DATOS DE LAS SEDES
                        foreach ($IdHeadquarters as $key_4 => $value) {
                            $headquarter = DB::table('headquarters')
                                ->select(
                                    'headquarters.id AS h_id',
                                    'headquarters.name AS h_name',
                                    'headquarters.delegation_id AS h_delegation_id',
                                    'headquarters.municipality_id AS h_municipality_id',
                                    'delegations.id AS d_id',
                                    'delegations.name AS d_name',
                                    'municipalities.id AS m_id',
                                    'municipalities.city_name AS m_city_name',
                                )
                                ->join('municipalities', 'municipalities.id', '=', 'headquarters.municipality_id')
                                ->join('delegations', 'delegations.id', '=', 'headquarters.delegation_id')
                                ->where('headquarters.id', $value->hcra_headquarter_id)
                                ->first();
                            if ($headquarter) $headquarters[] = $headquarter; // AGREGAR LA SEDE AL ARRAY
                        }

                        // CONVERTIR EL ARRAY EN UNA COLECCIÓN ANTES DE USAR MAP()
                        $usersCollection = collect($users);
                        $headquartersCollection = collect($headquarters);

                        // APLICAR MAP() EN LA COLECCIÓN
                        $newUsers = $usersCollection->map(function ($value) {
                            // AGREGAR UN CAMPO PERSONALIZADO (NOMBRE COMPLETO)
                            $value->u_full_name_g = $value->u_first_name . ' ' . $value->u_second_name . ' ' . $value->u_first_last_name . ' ' . $value->u_second_last_name;
                            // RETORNO DE LOS CAMBIOS
                            return $value;
                        });

                        // APLICAR MAP() EN LA COLECCIÓN
                        $newHeadquarters = $headquartersCollection->map(function ($value) {
                            // AGREGAR UN CAMPO PERSONALIZADO (NOMBRE COMPLETO)
                            $value->h_full_name = $value->h_name;
                            // RETORNO DE LOS CAMBIOS
                            return $value;
                        });


                        // AGREGAR LA INFORMACIÓN TRANSFORMADA AL ELEMENTO DEL REPORTE
                        // $key_1 CORRESPONDE AL AGRUPAMIENTO DE LAS SEDES (#NOTE - groupBy('h_name') LÍNEA 339)
                        // $key_2 CORRESPONDE A LA CANTIDAD DE ACUERDOS REGISTRADOS POR SEDE
                        $cleanedReport[$key_1][$key_2]->users = $newUsers;
                        $cleanedReport[$key_1][$key_2]->headquarters = $newHeadquarters;
                    }
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
