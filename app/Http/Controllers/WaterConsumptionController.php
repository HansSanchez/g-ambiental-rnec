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
        // CONSULTA DE LA CONSUMOS HÍDRICOS
        $waterConsumptions =
            // RELACIONES
            WaterConsumption::with([
                'Delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                'EvidenceWaterConsumption' => function ($query) {
                    $query->select(
                        'evidence_water_consumptions.id',
                        'evidence_water_consumptions.file',
                        'evidence_water_consumptions.water_consumption_id'
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
                if ($request->yearFilter) $query->where('water_consumptions.year', $request->yearFilter);
                else $query->where('water_consumptions.year', now()->format('Y'));
                // FILTRO PARA BÚSQUEDA POR MES
                if ($request->monthFilter) $query->where('water_consumptions.month', $request->monthFilter);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
                if (array_key_exists('filter_delegations_water_consumptions', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->delegations_model) {
                        $delegation = json_decode($request->delegations_model);
                        $query->where('water_consumptions.delegation_id', $delegation->code);
                    } else $query->where('water_consumptions.delegation_id', Auth::user()->delegation_id);
                    if ($request->municipalities_model) {
                        $municipality = json_decode($request->municipalities_model);
                        $query->where('water_consumptions.municipality_id', $municipality->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN Y MUNICIPIO AL CUAL PERTENECE
                    $query->where('water_consumptions.delegation_id', Auth::user()->delegation_id)
                        ->where('water_consumptions.municipality_id', Auth::user()->municipality_id);
                }
            })
            // ORDENAMIENTO POR ID
            ->orderBy('water_consumptions.id')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(10);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['waterConsumptions' => $waterConsumptions]);
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
                $waterConsumption = new WaterConsumption($request->all());
                $waterConsumption->delegation_id = $delegation_id; // DELEGACIÓN
                $waterConsumption->municipality_id = $request->municipality['code']; // MUNICIPIO
                $waterConsumption->environmental_manager = mb_strtoupper($request->environmental_manager); // GESTOR AMBIENTAL
                $waterConsumption->user_id = $user_id; // USUARIO QUE GENERÓ EL REPORTE
                $waterConsumption->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // REGISTRO DE LAS RELACIONES
                $waterConsumption->Delegation;
                $waterConsumption->EvidenceWaterConsumption;
                $waterConsumption->Municipality;
                $waterConsumption->User; // QUIEN REPORTÓ

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
                    '$waterConsumption' => $waterConsumption,
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

            // REGISTRO DE LAS RELACIONES
            $waterConsumption->Delegation;
            $waterConsumption->EvidenceWaterConsumption;
            $waterConsumption->Municipality;
            $waterConsumption->User; // QUIEN REPORTÓ

            // RESPUESTA PARA EL USUARIO
            return response()->json(['$waterConsumption' => $waterConsumption]);
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

                // OBTENCIÓN DE LA DELEGACIÓN DEL USUARIO QUE HIZO EL REGISTRO
                $delegation_id = $waterConsumption->delegation_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $waterConsumption->id,
                    'description' => $waterConsumption,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $waterConsumption->update([
                    'environmental_manager' => mb_strtoupper($request->environmental_manager), // OPERADOR AMBIENTAL
                    'delegation_id' => $delegation_id, // DELEGACIÓN
                    'municipality_id' => $request->municipality['code'], // MUNICIPIO,
                    'year' => $request->year, // AÑO RELACIONADO
                    'month' => $request->month, // MES RELACIONADO
                    'm3_monthly' => $request->m3_monthly, // METROS CÚBICOS (MES)
                    'total_staff' => $request->total_staff, // TOTAL DE PERSONAL
                    'observations' => $request->observations, // OBSERVACIONES
                    'user_id' => $user_id, // REPORTANTE
                ]);

                // REGISTRO DE LAS RELACIONES
                $waterConsumption->Delegation;
                $waterConsumption->EvidenceWaterConsumption;
                $waterConsumption->Municipality;
                $waterConsumption->User; // QUIEN REPORTÓ

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
                    '$waterConsumption' => $waterConsumption,
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

                // REGISTRO DE LAS RELACIONES
                $waterConsumption->Delegation;
                $waterConsumption->EvidenceWaterConsumption;
                $waterConsumption->Municipality;
                $waterConsumption->User; // QUIEN REPORTÓ

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    '$waterConsumption' => $waterConsumption,
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
                        'water_consumptions.id AS wc_id',
                        'water_consumptions.environmental_manager AS wc_environmental_manager',
                        'water_consumptions.delegation_id AS wc_delegation_id',
                        'water_consumptions.municipality_id AS wc_municipality_id',
                        'water_consumptions.year AS wc_year',
                        'water_consumptions.month AS wc_month',
                        'water_consumptions.m3_monthly AS wc_m3_monthly',
                        'water_consumptions.total_staff AS wc_total_staff',
                        'water_consumptions.observations AS wc_observations',
                        'water_consumptions.created_at AS wc_created_at',
                        'municipalities.id AS m_id',
                        'municipalities.city_name AS m_city_name',
                        'municipalities.state_name AS m_state_name',
                    )
                    // RELACIÓN CON LA DELEGACIÓN
                    ->join('delegations', 'delegations.id', '=', 'water_consumptions.delegation_id')
                    // RELACIÓN CON EL MUNICIPIO
                    ->join('municipalities', 'municipalities.id', '=', 'water_consumptions.municipality_id')
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
                    ->where(function ($query) use ($request) {
                        if ($request->month) $query->where('month', $request->month);
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE DELEGACIÓN
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_delegations_water_consumptions', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->delegation) $query->where('water_consumptions.delegation_id', $request->delegation['code']);
                            // PERO SI NO LA ENVÍA ES PORQUE QUIERE UN REPORTE GENERAL
                            else $query->get();
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE MUNICIPIO
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_municipalities_water_consumptions', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->municipality) $query->where('water_consumptions.municipality_id', $request->municipality['code']);
                            // PERO SI NO LA ENVÍA ES PORQUE QUIERE UN REPORTE GENERAL
                            else $query->get();
                    })
                    // OBTENCIÓN DE LOS REGISTROS
                    ->get()
                    ->groupBy('m_city_name'); // Agrupar por nombre de ciudad

                // ESTA FUNCIÓN EN NECESARIA YA QUE LAS OBSERVACIONES SE GUARDAN CON HTML ES NECESARIO LIMPIARLAS PARA TENER SOLO EL TEXTO
                $cleanedReport = [];
                foreach ($report as $cityName => $cityData) {
                    foreach ($cityData as $index => $record) {
                        if (is_object($record)) {
                            // CREAR UN NUEVO OBJETO PARA EL REGISTRO
                            $cleanedRecord = (object)[];

                            // COPIAR LAS PROPIEDADES DEL REGISTRO ORIGINAL
                            foreach ($record as $key => $value) $cleanedRecord->{$key} = $value;

                            // LIMPIEZA Y TRANSFORMACIÓN PARA CADA REGISTRO
                            $cleanedRecord->wc_observations = Str::of(strip_tags($record->wc_observations))->trim()->__toString();
                            $cleanedRecord->wc_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $record->wc_created_at)->format('d-m-Y h:i:s');
                            $cleanedRecord->m_full_name = mb_strtoupper($record->m_city_name . ' - ' . $record->m_state_name, "UTF-8");

                            // AGREGAR EL OBJETO LIMPIO AL ARREGLO DE LA CIUDAD
                            $cleanedReport[$cityName][$index] = $cleanedRecord;
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
