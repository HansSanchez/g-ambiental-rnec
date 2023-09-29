<?php

namespace App\Http\Controllers;

use App\Exports\WasteManagementExport;
use App\Models\Audit;
use App\Models\Headquarter;
use App\Models\WasteManagement;
use App\Models\WasteType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class WasteManagementController extends Controller
{

    // FUNCIÓN PARA FILTRAR DATOS EN RESIDUOS Y TIPOS DE RESIDUOS
    public function switchOptions($query, Request $request, $permissions, $headquarter_id)
    {
        switch (array_key_exists('filter_headquarters_waste_management', $permissions->permissions())) {
            case true:
                // FILTRO POR DELEGACIÓN
                if ($request->delegations_model) {
                    $delegation = json_decode($request->delegations_model);
                    $query->whereHas('Headquarter', function ($query2) use ($delegation) {
                        $query2->where('delegation_id', $delegation->code);
                    });
                }

                // FILTRO POR MUNICIPIO
                if ($request->municipalities_model) {
                    $municipality = json_decode($request->municipalities_model);
                    $query->whereHas('Headquarter', function ($query2) use ($municipality) {
                        $query2->where('municipality_id', $municipality->code);
                    });
                }

                // FILTRO POR SEDE
                if ($request->headquarters_model) {
                    $headquarter = json_decode($request->headquarters_model);
                    $query->where('headquarter_id', $headquarter->code);
                } else {
                    $query->where('headquarter_id', $headquarter_id);
                }
                break;
            default:
                $query->where('waste_management.headquarter_id', $headquarter_id);
                break;
        }
    }

    // FUNCIÓN PARA OBTENCIÓN DE DATOS EN TIPOS DE RESIDUOS
    public function getWasteTypes(Request $request, $permissions, $headquarter_id)
    {
        $wasteTypes = WasteType::select('waste_types.id', 'waste_types.name')
            ->where(function ($query) use ($request) {
                if ($request->yearFilter) $query->where('waste_types.year', $request->yearFilter);
                else $query->where('waste_types.year', now()->format('Y'));
            })
            ->where(function ($query) use ($request, $permissions, $headquarter_id) {
                $this->switchOptions($query, $request, $permissions, $headquarter_id);
            })
            ->get();

        return $wasteTypes;
    }

    // FUNCIÓN PARA OBTENCIÓN DE DATOS EN RESIDUOS
    public function getWasteManagements(Request $request)
    {
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        $headquarter_id = Auth::user()->headquarter_id;

        // PASO 1. IDENTIFICAR LOS TIPOS DE RESIDUOS (POR AÑO) y (POR SEDE)
        $wasteTypes = $this->getWasteTypes($request, $permissions, $headquarter_id);

        // PASO 2. DEFINICIÓN DE LOS MESES PARA FILTRO
        $month = $this->nowMonth();

        // PASO 3. OBTENCIÓN DE LOS DATOS POR MES SEGÚN LOS TIPOS
        $wasteManagements = []; // CREACIÓN DEL ARRAY PARA CONSOLIDAR RESULTADOS
        foreach ($wasteTypes as $key => $value) {
            // CONSULTA DE LOS REGISTROS MES A MES
            $query = WasteManagement::withRelations()->where('waste_type_id', $value->id)
                ->where(function ($query) use ($request, $month) {
                    // FILTRO POR MES
                    if ($request->monthFilter) $query->where('waste_management.month', $request->monthFilter);
                    else $query->where('waste_management.month', $month);
                })
                ->where(function ($query) use ($request, $permissions, $headquarter_id) {
                    $this->switchOptions($query, $request, $permissions, $headquarter_id);
                });
            // CONSOLIDANDO EL ARRAY
            $wasteManagements[$value->name] = $query->get();
        }

        // RESPUESTA PARA EL USUARIO
        return response()->json(['wasteManagements' => $wasteManagements]);
    }

    // FUNCIÓN PARA IDENTIFICAR EL MES ACTUAL EN ESPAÑOL
    public function nowMonth()
    {
        switch (now()->format('m')) {
            case '01':
                $month = "ENERO";
                break;
            case '02':
                $month = "FEBRERO";
                break;
            case '03':
                $month = "MARZO";
                break;
            case '04':
                $month = "ABRIL";
                break;
            case '05':
                $month = "MAYO";
                break;
            case '06':
                $month = "JUNIO";
                break;
            case '07':
                $month = "JULIO";
                break;
            case '08':
                $month = "AGOSTO";
                break;
            case '09':
                $month = "SEPTIEMBRE";
                break;
            case '10':
                $month = "OCTUBRE";
                break;
            case '11':
                $month = "NOVIEMBRE";
                break;
            case '12':
                $month = "DICIEMBRE";
                break;
            default:
                # code...
                break;
        }

        return $month;
    }

    // FUNCIÓN PARA DEVOLUCIÓN DE TODAS LAS RELACIONES QUE AFECTAN AL MODELO
    public function allRelations($wasteManagement)
    {
        // REGISTRO DE LAS RELACIONES
        $wasteManagement->Headquarter;
        $wasteManagement->Headquarter->Delegation;
        $wasteManagement->Headquarter->Municipality;
        $wasteManagement->Headquarters;
        $wasteManagement->EvidenceWasteManagement;
        $wasteManagement->User; // QUIEN REPORTÓ
        $wasteManagement->WasteType; // TIPO

    }

    // FUNCIÓN PARA VISUALIZACIÓN DE DETALLE
    public function show(WasteManagement $wasteManagement)
    {
        // CONTROL DE ERRORES
        try {
            // RELACIONES
            $this->allRelations($wasteManagement);
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

                // OBTENCIÓN DE LA SEDE DEL FUNCIONARIO(A) QUE HIZO EL REGISTRO
                $headquarter_id = $wasteManagement->headquarter_id;

                // OBTENCIÓN DEL TIPO DE RESIDUO ASOCIADO A EL REGISTRO
                $waste_type_id = $wasteManagement->waste_type_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - GESTIÓN DE RESIDUOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'GESTIÓN DE RESIDUOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $wasteManagement->update([
                    'month' => $request->month, // MES RELACIONADO
                    'value' => $request->value, // VALOR MES RELACIONADO,
                    'observations' => $request->observations, // OBSERVACIONES
                    'headquarter_id' => $headquarter_id, // SEDE A LA CUAL PERTENECE EL USUARIO,
                    'user_id' => $user_id, // REPORTANTE
                    'waste_type_id' => $waste_type_id, // TIPO DEL RESIDUO
                ]);

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN FINAL DE REGISTRO - GESTIÓN DE RESIDUOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'GESTIÓN DE RESIDUOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
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
                    'action' => 'ELIMINACIÓN DE REGISTRO - GESTIÓN DE RESIDUOS ID #' . $wasteManagement->id,
                    'description' => $wasteManagement,
                    'module' => 'GESTIÓN DE RESIDUOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $wasteManagement->delete();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 10000,
                    'type' => 'success',
                    'msg' => 'El registro se ha eliminado con éxito, recuerde que debe volver a filtrar para ver los cambios aplicados.',
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(WasteManagementController - destroy) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    public function switchOptionsReport($query, $request, $permissions, $headquarter_id)
    {
        // dd($request->all());
        switch (array_key_exists('filter_headquarters_waste_management', $permissions->permissions())) {
            case true:
                // FILTRO POR DELEGACIÓN
                if ($request->delegation) {
                    $query->whereHas('Headquarter', function ($query2) use ($request) {
                        $query2->where('delegation_id', $request->delegation['code']);
                    });
                }

                // FILTRO POR MUNICIPIO
                if ($request->municipality) {
                    $query->whereHas('Headquarter', function ($query2) use ($request) {
                        $query2->where('municipality_id', $request->municipality['code']);
                    });
                }

                // FILTRO POR SEDE
                if ($request->headquarter) $query->where('headquarter_id', $request->headquarter['code']);
                break;
            default:
                $query->where('waste_management.headquarter_id', $headquarter_id);
                break;
        }
    }

    public function getwasteTypesForReport($request, $permissions, $headquarter_id)
    {
        $wasteTypes =
            WasteType::select(
                'waste_types.id',
                'waste_types.name',
                'waste_types.danger_current',
                'waste_types.transportation_manager',
                'waste_types.external_manager',
                'waste_types.environmental_license',
                'waste_types.certificate_or_type_of_treatment',
                'waste_types.year',
                'waste_types.headquarter_id',
            )
            // FILTRO DE CONSULTA POR PARAMETRO DE AÑO
            ->where(function ($query) use ($request) {
                if ($request->year) $query->where('waste_types.year', $request->year);
                else $query->where('waste_types.year', now()->format('Y'));
            })
            // FILTRO DE CONSULTA POR PARAMETRO DE SEDE
            ->where(function ($query) use ($request, $permissions, $headquarter_id) {
                $this->switchOptionsReport($query, $request, $permissions, $headquarter_id);
            })
            ->get();

        return $wasteTypes;
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

                $permissions = new HomeController;
                $headquarter_id = Auth::user()->headquarter_id;
                $months = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];

                // PASO 1. IDENTIFICAR LOS TIPOS DE RESIDUOS (POR AÑO)
                $wasteTypes = $this->getwasteTypesForReport($request, $permissions, $headquarter_id);

                $reports = [];
                foreach ($wasteTypes as $key => $wasteType) {
                    // CONSULTA POR RANGO DE FECHAS, DÍA, SEMANA, MES O AÑO
                    $reports[$wasteType->name][] = DB::table('waste_management')
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
                            'municipalities.state_name AS m_state_name',
                            'waste_management.id AS wc_id',
                            'waste_management.month AS wm_month',
                            'waste_management.value AS wm_value',
                            'waste_management.observations AS wm_observations',
                            'waste_management.headquarter_id AS wm_headquarter_id',
                            'waste_management.user_id AS wm_user_id',
                            'waste_management.waste_type_id AS wm_waste_type_id',
                            'waste_management.created_at AS wm_created_at',
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
                        ->join('headquarters', 'headquarters.id', '=', 'waste_management.headquarter_id')
                        ->join('municipalities', 'municipalities.id', '=', 'headquarters.municipality_id')
                        ->join('delegations', 'delegations.id', '=', 'headquarters.delegation_id')
                        // RELACIÓN CON EL USUARIO QUE HIZO EL REGISTRO
                        ->join('users', 'users.id', '=', 'waste_management.user_id')
                        ->where(function ($query) use ($wasteType) {
                            $query->where('waste_management.waste_type_id', $wasteType->id)
                                ->where('waste_management.headquarter_id', $wasteType->headquarter_id);
                        })
                        ->whereIn('waste_management.month', $months)
                        // OBTENCIÓN DE LOS REGISTROS
                        ->get();
                }

                // CICLO PARA RE ORDENAR LA SALIDA DEL ARREGLO
                $oldReport = $reports;
                $newReport = [];
                foreach ($oldReport as $type => $items) {
                    foreach ($items as $headquarter => $data) {
                        if (!isset($newReport[$headquarter])) $newReport[$headquarter] = [];
                        $newReport[$headquarter][$type] = $data;
                    }
                }

                // ESTA FUNCIÓN EN NECESARIA YA QUE LAS OBSERVACIONES SE GUARDAN CON HTML ES NECESARIO LIMPIARLAS PARA TENER SOLO EL TEXTO
                $cleanedReport = [];
                foreach ($newReport as $key1 => $wasteTypeData) {
                    foreach ($wasteTypeData as $type => $records) {
                        foreach ($records as $key3 => $record) {
                            if (is_object($record)) {

                                // ACCEDER AL PRIMER ELEMENTO DE LA COLECCIÓN Y LUEGO A LA PROPIEDAD
                                $recordItem = $record;

                                // CREAR UN NUEVO OBJETO LIMPIO
                                $cleanedRecord = (object)[];

                                // COPIAR LAS PROPIEDADES DEL REGISTRO ORIGINAL
                                foreach ($recordItem as $key => $value) {
                                    $cleanedRecord->{$key} = $value;
                                }

                                // LIMPIEZA Y TRANSFORMACIÓN PARA CADA REGISTRO
                                $cleanedRecord->wm_observations = Str::of(strip_tags($recordItem->wm_observations))->trim()->__toString();
                                $cleanedRecord->wm_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $recordItem->wm_created_at)->format('d-m-Y h:i:s');
                                $cleanedRecord->m_full_name = mb_strtoupper($recordItem->m_city_name . ' - ' . $recordItem->m_state_name, "UTF-8");
                                $cleanedRecord->u_full_name = mb_strtoupper($recordItem->u_first_name . ' ' . $recordItem->u_second_name . ' ' . $recordItem->u_first_last_name . ' ' . $recordItem->u_second_last_name, "UTF-8");

                                // AGREGAR EL OBJETO LIMPIO AL ARREGLO DE LA CIUDAD
                                $cleanedReport[$recordItem->h_name][$type][$key3] = $cleanedRecord;
                            }
                        }
                    }
                }

                dd($cleanedReport);

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'GENERACIÓN DE REPORTE MASIVO DE GESTIÓN DE RESIDUOS',
                    'module' => 'GESTIÓN DE RESIDUOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // VALIDACIÓN DE CANTIDAD DE RESGISTROS EN LA RESPUESTA (SI NO HAY REGISTROS)
                if (count($cleanedReport) == 0) return response()->json(['file' => false, 'msg' => 'Para este rango de fechas no existen registros, verifique por favor.', 'fileName' => null, 'icon' => 'warning']);
                // SI HAY REGISTROS
                else {
                    $fileName = 'REPORTE-DE-GENERACIÓN-DE-RESIDUOS-' . str_replace([':', ' '], '-', now()->toDateTimeString()) . '.xlsx';
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
