<?php

namespace App\Http\Controllers;

use App\Models\WasteManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WasteManagementController extends Controller
{
    // FUNCIÓN DE OBTENCIÓN DE DATOS
    public function getWasteManagements(Request $request)
    {
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LA CONSUMOS HÍDRICOS
        $wasteManagements =
            // RELACIONES
            WasteManagement::with([
                // RELACIÓN CON LA DELEGACIÓN
                'Delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                // RELACIÓN CON LA EVIDENCIA
                'EvidenceWasteManagement' => function ($query) {
                    $query->select(
                        'evidence_waste_management.id',
                        'evidence_waste_management.name',
                        'evidence_waste_management.extension',
                        'evidence_waste_management.file',
                        'evidence_waste_management.waste_management_id'
                    );
                },
                // RELACIÓN CON EL MUNICIPIO
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
                // RELACIÓN CON EL TIPO DE RESIDUO
                'WasteType' => function ($query) {
                    $query->select(
                        'waste_types.id',
                        'waste_types.name',
                        'waste_types.danger_current',
                        'waste_types.transportation_manager',
                        'waste_types.external_manager',
                        'waste_types.environmental_license',
                        'waste_types.certificate_or_type_of_treatment',
                        'waste_types.year',
                    );
                },
            ])
            // FILTRO DE CONSULTA SEGÚN PARAMETROS DE BÚSQUEDA
            ->where(function ($query) use ($request, $permissions) {
                // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
                if ($request->search) $query->search($request->search);
                // FILTRO PARA BÚSQUEDA POR AÑO
                if ($request->yearFilter)
                    $query->whereHas('WasteType', function ($query2) use ($request) {
                        $query2->where('waste_types.year', $request->yearFilter);
                    });
                else
                    $query->whereHas('WasteType', function ($query2) use ($request) {
                        $query2->where('waste_types.year', now()->format('Y'));
                    });
                // FILTRO PARA BÚSQUEDA POR MES
                if ($request->monthFilter) $query->where('waste_management.month', $request->monthFilter);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
                if (array_key_exists('filter_delegations_waste_management', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->delegations_model) {
                        $delegation = json_decode($request->delegations_model);
                        $query->where('waste_management.delegation_id', $delegation->code);
                    } else $query->where('waste_management.delegation_id', Auth::user()->delegation_id);
                    if ($request->municipalities_model) {
                        $municipality = json_decode($request->municipalities_model);
                        $query->where('waste_management.municipality_id', $municipality->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN Y MUNICIPIO AL CUAL PERTENECE
                    $query->where('waste_management.delegation_id', Auth::user()->delegation_id)
                        ->where('waste_management.municipality_id', Auth::user()->municipality_id);
                }
            })
            // ORDENAMIENTO POR ID
            ->orderBy('waste_management.id')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(12);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['wasteManagements' => $wasteManagements]);
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
                $wasteManagement = new WasteManagement($request->all());
                $wasteManagement->delegation_id = $delegation_id; // DELEGACIÓN
                $wasteManagement->municipality_id = $request->municipality['code']; // MUNICIPIO
                $wasteManagement->environmental_manager = mb_strtoupper($request->environmental_manager); // GESTOR AMBIENTAL
                $wasteManagement->user_id = $user_id; // USUARIO QUE GENERÓ EL REPORTE
                $wasteManagement->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // REGISTRO DE LAS RELACIONES
                $wasteManagement->Delegation;
                $wasteManagement->EvidenceWasteManagement;
                $wasteManagement->Municipality;
                $wasteManagement->User; // QUIEN REPORTÓ

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - CONSUMOS HÍDRICOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha realizadó con éxito.',
                    'wasteManagement' => $wasteManagement,
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
            Log::error("(WasteManagementController - store) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA VISUALIZACIÓN DE DETALLE
    public function show(WasteManagement $wasteManagement)
    {
        // CONTROL DE ERRORES
        try {

            // REGISTRO DE LAS RELACIONES
            $wasteManagement->Delegation;
            $wasteManagement->EvidenceWasteManagement;
            $wasteManagement->Municipality;
            $wasteManagement->User; // QUIEN REPORTÓ

            // RESPUESTA PARA EL USUARIO
            return response()->json(['wasteManagement' => $wasteManagement]);
        } catch (\Exception $exception) {
            Log::error("(WasteManagementController - show) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ACTUALIZACIÓN
    public function update(Request $request, WasteManagement $wasteManagement)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // OBTENCIÓN DE LA DELEGACIÓN DEL USUARIO QUE HIZO EL REGISTRO
                $delegation_id = $wasteManagement->delegation_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $wasteManagement->update([
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
                $wasteManagement->Delegation;
                $wasteManagement->EvidenceWasteManagement;
                $wasteManagement->Municipality;
                $wasteManagement->User; // QUIEN REPORTÓ

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN FINAL DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'wasteManagement' => $wasteManagement,
                    'new' => false
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(WasteManagementController - update) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ELIMINACIÓN (ELIMINADCÓN LÓGICA)
    public function destroy(WasteManagement $wasteManagement)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $wasteManagement->delete();

                // REGISTRO DE LAS RELACIONES
                $wasteManagement->Delegation;
                $wasteManagement->EvidenceWasteManagement;
                $wasteManagement->Municipality;
                $wasteManagement->User; // QUIEN REPORTÓ

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'wasteManagement' => $wasteManagement,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(WasteManagementController - destroy) ERROR => " . $exception->getMessage());
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
                $report = DB::table('waste_management')
                    // COLUMNAS DE INTERÉS PARA EL REPORTE (SEGÚN FORMATO OFICIAL)
                    ->select(
                        'delegations.id AS d_id',
                        'delegations.name AS d_name',
                        'waste_management.id AS wc_id',
                        'waste_management.environmental_manager AS wc_environmental_manager',
                        'waste_management.delegation_id AS wc_delegation_id',
                        'waste_management.municipality_id AS wc_municipality_id',
                        'waste_management.year AS wc_year',
                        'waste_management.month AS wc_month',
                        'waste_management.m3_monthly AS wc_m3_monthly',
                        'waste_management.total_staff AS wc_total_staff',
                        'waste_management.observations AS wc_observations',
                        'waste_management.created_at AS wc_created_at',
                        'municipalities.id AS m_id',
                        'municipalities.city_name AS m_city_name',
                        'municipalities.state_name AS m_state_name',
                    )
                    // RELACIÓN CON LA DELEGACIÓN
                    ->join('delegations', 'delegations.id', '=', 'waste_management.delegation_id')
                    // RELACIÓN CON EL MUNICIPIO
                    ->join('municipalities', 'municipalities.id', '=', 'waste_management.municipality_id')
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
                        if (array_key_exists('filter_delegations_waste_management', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->delegation) $query->where('waste_management.delegation_id', $request->delegation['code']);
                            // PERO SI NO LA ENVÍA ES PORQUE QUIERE UN REPORTE GENERAL
                            else $query->get();
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE MUNICIPIO
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_municipalities_waste_management', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->municipality) $query->where('waste_management.municipality_id', $request->municipality['code']);
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
                    Excel::store(new WasteManagementExport($cleanedReport, intval($request->year), $request->delegation['label']), $fileName, 'waste_management');
                    sleep(5);
                    return response()->json(['file' => true, 'msg' => 'Reporte generado con éxito', 'fileName' => $fileName, 'icon' => 'success']);
                }
            }
        } catch (\Exception $exception) {
            Log::error("(WasteManagementController - generateReport) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
