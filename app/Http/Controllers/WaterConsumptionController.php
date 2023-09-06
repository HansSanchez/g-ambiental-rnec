<?php

namespace App\Http\Controllers;

use App\Exports\WaterConsumptionExport;
use App\Models\Audit;
use App\Models\WaterConsumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class WaterConsumptionController extends Controller
{
    // FUNCIÓN DE OBTENCIÓN DE DATOS
    public function getWaterConsumptions(Request $request)
    {
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LOS CONSUMOS HÍDRICOS
        $waterConsumptions =
            // RELACIONES
            WaterConsumption::withRelations() // SCOPE EN EL MODELO (RELACIONES)
            ->filter($request, $permissions) // SCOPE EN EL MODELO (FILTROS)
            // ORDENAMIENTO POR ID
            ->orderBy('id', 'DESC')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(12);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['waterConsumptions' => $waterConsumptions]);
    }

    public function allRelations($waterConsumption)
    {
        // REGISTRO DE LAS RELACIONES
        $waterConsumption->Headquarter;
        $waterConsumption->Headquarter->Delegation;
        $waterConsumption->Headquarter->Municipality;
        $waterConsumption->Headquarters;
        $waterConsumption->EvidenceWaterConsumption;
        $waterConsumption->User; // QUIEN REPORTÓ
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
                $waterConsumption = new WaterConsumption($request->all());
                $waterConsumption->headquarter_id = $headquarter_id; // SEDE A LA CUAL PERTENECE EL USUARIO
                $waterConsumption->user_id = $user_id; // USUARIO QUE GENERÓ EL REPORTE
                $waterConsumption->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // RELACIONES
                $this->allRelations($waterConsumption);

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - CONSUMOS HÍDRICOS ID #' . $waterConsumption->id,
                    'description' => $waterConsumption,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha realizadó con éxito.',
                    'waterConsumption' => $waterConsumption,
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
            Log::error("(WaterConsumptionsController - store) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA VISUALIZACIÓN DE DETALLE
    public function show(WaterConsumption $waterConsumption)
    {
        // CONTROL DE ERRORES
        try {
            // RELACIONES
            $this->allRelations($waterConsumption);
            // RESPUESTA PARA EL USUARIO
            return response()->json(['waterConsumption' => $waterConsumption]);
        } catch (\Exception $exception) {
            Log::error("(WaterConsumptionsController - show) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ACTUALIZACIÓN
    public function update(Request $request, WaterConsumption $waterConsumption)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // OBTENCIÓN DE LA SEDE A LA CUAL SE LE HIZO EL REGISTRO POR DEFECTO
                $headquarter_id = $waterConsumption->headquarter_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $waterConsumption->id,
                    'description' => $waterConsumption,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $waterConsumption->update([
                    'headquarter_id' => $headquarter_id, // SEDE
                    'year' => $request->year, // AÑO RELACIONADO
                    'month' => $request->month, // MES RELACIONADO
                    'm3_monthly' => $request->m3_monthly, // KILOWATTS (MES)
                    'total_staff' => $request->total_staff, // TOTAL DE PERSONAL
                    'observations' => $request->observations, // OBSERVACIONES
                    'user_id' => $user_id, // REPORTANTE
                ]);

                // RELACIONES
                $this->allRelations($waterConsumption);

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN FINAL DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $waterConsumption->id,
                    'description' => $waterConsumption,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'waterConsumption' => $waterConsumption,
                    'new' => false
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(WaterConsumptionsController - update) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ELIMINACIÓN (ELIMINADCÓN LÓGICA)
    public function destroy(WaterConsumption $waterConsumption)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $waterConsumption->id,
                    'description' => $waterConsumption,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $waterConsumption->delete();

                // RELACIONES
                $this->allRelations($waterConsumption);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'waterConsumption' => $waterConsumption,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(WaterConsumptionsController - destroy) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA GENERACIÓN DE REPORTES
    public function generateReport(Request $request)
    {
        // dd($request->all());
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                $permissions = new HomeController;

                // CONSULTA POR RANGO DE FECHAS, DÍA, SEMANA, MES O AÑO
                $report = DB::table('water_consumptions')
                    // COLUMNAS DE INTERÉS PARA EL REPORTE (SEGÚN FORMATO OFICIAL)
                    ->select(
                        'delegations.id AS d_id',
                        'delegations.name AS d_name',
                        'headquarters.id AS h_id',
                        'headquarters.name AS h_name',
                        'headquarters.delegation_id AS h_delegation_id',
                        'headquarters.municipality_id AS h_municipality_id',
                        'municipalities.id AS m_id',
                        'municipalities.city_name AS m_city_name',
                        'water_consumptions.id AS wc_id',
                        'water_consumptions.headquarter_id AS wc_headquarter_id',
                        'water_consumptions.year AS wc_year',
                        'water_consumptions.month AS wc_month',
                        'water_consumptions.m3_monthly AS wc_m3_monthly',
                        'water_consumptions.total_staff AS wc_total_staff',
                        'water_consumptions.observations AS wc_observations',
                        'water_consumptions.created_at AS wc_created_at',
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
                    ->join('headquarters', 'headquarters.id', '=', 'water_consumptions.headquarter_id')
                    ->join('municipalities', 'municipalities.id', '=', 'headquarters.municipality_id')
                    ->join('delegations', 'delegations.id', '=', 'headquarters.delegation_id')
                    // RELACIÓN CON EL USUARIO QUE HIZO EL REGISTRO
                    ->join('users', 'users.id', '=', 'water_consumptions.user_id')
                    // FILTRO DE CONSULTA POR PARAMETRO DE AÑO
                    ->where(function ($query) use ($request) {
                        if ($request->year) {
                            if (intval($request->year) > 2022) {
                                $query->where('year', $request->year)
                                    ->orWhere(function ($query) use ($request) {
                                        $previousYear = intval($request->year) - 1;
                                        $query->where('year', strval($previousYear))
                                            ->where('month', 'DICIEMBRE');
                                    })
                                    ->orWhere(function ($query) use ($request) {
                                        $nextYear = intval($request->year) + 1;
                                        $query->where('year', strval($nextYear))
                                            ->whereIn('month', ['ENERO', 'FEBRERO']);
                                    });
                            } else {
                                $query->where('year', $request->year)
                                    ->orWhere(function ($query) use ($request) {
                                        $nextYear = intval($request->year) + 1;
                                        $query->where('year', strval($nextYear))
                                            ->whereIn('month', ['ENERO', 'FEBRERO']);
                                    });
                            }
                        }
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE MES
                    ->where(function ($query) use ($request) {
                        if ($request->month) $query->where('month', $request->month);
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE SEDE
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_headquarters_water_consumptions', $permissions->permissions())) { // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->headquarter)
                                $query->where('water_consumptions.headquarter_id', $request->headquarter['code']);
                        }
                        // SI NO TIENE PERMISO
                        else {
                            // PUEDE VER SOLO LOS REGISTROS DE LA SEDE A LA CUAL PERTENECE
                            $query->where('water_consumptions.headquarter_id', Auth::user()->headquarter_id);
                        }
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
                            $cleanedRecord->wc_observations = Str::of(strip_tags($record->wc_observations))->trim()->__toString();
                            $cleanedRecord->wc_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $record->wc_created_at)->format('d-m-Y h:i:s');
                            $cleanedRecord->h_full_name = mb_strtoupper($record->d_name . ' / ' . $record->m_city_name . ' / ' . $record->h_name, "UTF-8");
                            $cleanedRecord->u_full_name = mb_strtoupper($record->u_first_name . ' ' . $record->u_second_name . ' ' . $record->u_first_last_name . ' ' . $record->u_second_last_name, "UTF-8");
                            // AGREGAR EL OBJETO LIMPIO AL ARREGLO DE LA SEDE
                            $cleanedReport[$key1][$key_2] = $cleanedRecord;
                        }
                    }
                }

                // dd($cleanedReport);
                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'GENERACIÓN DE REPORTE MASIVO DE CONSUMOS HÍDRICOS',
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // VALIDACIÓN DE CANTIDAD DE RESGISTROS EN LA RESPUESTA (SI NO HAY REGISTROS)
                if (count($cleanedReport) == 0) return response()->json(['file' => false, 'msg' => 'Para este rango de fechas no existen registros, verifique por favor.', 'fileName' => null, 'icon' => 'warning']);
                // SI HAY REGISTROS
                else {
                    $fileName = 'REPORTE-DE-CONSUMOS-HÍDRICOS-' . str_replace([':', ' '], '-', now()->toDateTimeString()) . '.xlsx';
                    Excel::store(new WaterConsumptionExport($cleanedReport, intval($request->year), $request->delegation['label']), $fileName, 'water_consumptions');
                    sleep(5);
                    return response()->json(['file' => true, 'msg' => 'Reporte generado con éxito', 'fileName' => $fileName, 'icon' => 'success']);
                }
            }
        } catch (\Exception $exception) {
            Log::error("(WaterConsumptionsController - generateReport) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
