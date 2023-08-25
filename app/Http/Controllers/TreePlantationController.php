<?php

namespace App\Http\Controllers;

use App\Exports\TreePlantationExport;
use App\Http\Requests\TreePlantationStoreRequest;
use App\Models\Audit;
use App\Models\TreePlantation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class TreePlantationController extends Controller
{

    // FUNCIÓN DE OBTENCIÓN DE DATOS
    public function getTreePlantation(Request $request)
    {
        // ADECUACIÓN DE TEXTO A FECHA DEL PARAMETRO QUE LLEGA
        $day = date('Y-m-d', strtotime($request->dateFilter));
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LA PLANTACIÓN DE ÁRBOLES
        $treePlantation =
            // RELACIONES
            TreePlantation::with([
                'Headquarter' => function ($query) {
                    $query->select('headquarters.id', 'headquarters.name');
                },
                'EvidenceTreePlantations' => function ($query) {
                    $query->select(
                        'evidence_tree_plantations.id',
                        'evidence_tree_plantations.file',
                        'evidence_tree_plantations.tree_plantation_id'
                    );
                },
            ])
            // FILTRO DE CONSULTA SEGÚN PARAMETROS DE BÚSQUEDA
            ->where(function ($query) use ($request, $day, $permissions) {
                // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
                if ($request->search) $query->search($request->search);
                // FILTRO PARA BÚSQUEDA DE FECHA DE PLANTACIÓN
                if ($request->dateFilter) $query->whereBetween('tree_plantations.date', [$day . " 00:00:00", $day . " 23:59:59"]);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR SEDE
                if (array_key_exists('filter_headquarters_tree_plantations', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->headquarters_model) {
                        $headquarter = json_decode($request->headquarters_model);
                        $query->where('tree_plantations.headquarter_id', $headquarter->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA SEDE A LA CUAL PERTENECE
                    $query->where('tree_plantations.headquarter_id', Auth::user()->headquarter_id);
                }
            })
            // ORDENAMIENTO POR ID
            ->orderBy('tree_plantations.id')
            // PÁGINADO DE RESPUESTA
            ->simplePaginate(10);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['treePlantation' => $treePlantation]);
    }

    // FUNCIÓN PARA CREACIÓN
    public function store(TreePlantationStoreRequest $request)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // OBTENCIÓN DE LA SEDE DEL USUARIO CON SESIÓN ACTIVA
                $headquarter_id = auth()->user()->headquarter_id;

                // GUARDADO DEL REGISTRO HECHO
                // LOS QUE NO NECESITA UN TRATAMIENTO ESPECIAL PASAN DIRECTO POR EL ALL()
                $treePlantation = new TreePlantation($request->all());
                $treePlantation->address = mb_strtoupper($request->address); // TRATAMIENTO A LA DIRECCIÓN
                $treePlantation->headquarter_id = $headquarter_id; // SEDE
                $treePlantation->user_id = $user_id; // USUARIO QUE REPORTA
                $treePlantation->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // REGISTRO DE LAS RELACIONES
                $treePlantation->Headquarter;
                $treePlantation->EvidenceTreePlantations;
                $treePlantation->User;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $treePlantation->id,
                    'description' => $treePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha realizadó con éxito.',
                    'treePlantation' => $treePlantation,
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
            Log::error("(TreePlantationController - store) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA VISUALIZACIÓN DE DETALLE
    public function show(TreePlantation $treePlantation)
    {
        // CONTROL DE ERRORES
        try {

            // RELACIONES
            $treePlantation->Headquarter;
            $treePlantation->EvidenceTreePlantations;
            $treePlantation->User;

            // RESPUESTA PARA EL USUARIO
            return response()->json(['treePlantation' => $treePlantation]);
        } catch (\Exception $exception) {
            Log::error("(TreePlantationController - show) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ACTUALIZACIÓN
    public function update(Request $request, TreePlantation $treePlantation)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = $treePlantation->user_id;

                // OBTENCIÓN DE LA SEDE DEL USUARIO QUE HIZO EL REGISTRO
                $headquarter_id = $treePlantation->headquarter_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $treePlantation->id,
                    'description' => $treePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $treePlantation->update([
                    'headquarter_id' => $headquarter_id,
                    'number_of_trees_planted' => $request->number_of_trees_planted,
                    'date' => $request->date,
                    'address' => mb_strtoupper($request->address),
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'observations' => $request->observations,
                    'user_id' => $user_id,
                ]);

                // REGISTRO DE LAS RELACIONES
                $treePlantation->Headquarter;
                $treePlantation->EvidenceTreePlantations;
                $treePlantation->User;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN FINAL DE REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $treePlantation->id,
                    'description' => $treePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'treePlantation' => $treePlantation,
                    'new' => false
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(TreePlantationController - update) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    // FUNCIÓN PARA ELIMINACIÓN (ELIMINADCÓN LÓGICA)
    public function destroy(TreePlantation $treePlantation)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $treePlantation->id,
                    'description' => $treePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $treePlantation->delete();

                // REGISTRO DE LAS RELACIONES
                $treePlantation->Headquarter;
                $treePlantation->EvidenceTreePlantations;
                $treePlantation->User;

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha actualizado con éxito.',
                    'treePlantation' => $treePlantation,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(TreePlantationController - destroy) ERROR => " . $exception->getMessage());
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
                $report = DB::table('tree_plantations')
                    // COLUMNAS DE INTERÉS PARA EL REPORTE
                    ->select(
                        'headquarters.id AS h_id',
                        'headquarters.name AS h_name',
                        'tree_plantations.id AS tp_id',
                        'tree_plantations.headquarter_id AS tp_headquarter_id',
                        'tree_plantations.number_of_trees_planted AS tp_number_of_trees_planted',
                        'tree_plantations.date AS tp_date',
                        'tree_plantations.address AS tp_address',
                        'tree_plantations.lat AS tp_lat',
                        'tree_plantations.lng AS tp_lng',
                        'tree_plantations.observations AS tp_observations',
                        'tree_plantations.created_at AS tp_created_at',
                        'tree_plantations.user_id AS tp_user_id',
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
                    // RELACIÓN CON LA SEDE EN DONDE SE HIZO EL REGISTRO
                    ->join('headquarters', 'headquarters.id', '=', 'tree_plantations.headquarter_id')
                    // RELACIÓN CON EL USUARIO QUE HIZO EL REGISTRO
                    ->join('users', 'users.id', '=', 'tree_plantations.user_id')
                    // FILTRO DE CONSULTA SEGÚN PARAMETROS DE FECHA
                    ->where(function ($query) use ($fromDay, $untilDay, $day, $weekStartDate, $weekEndDate, $monthStartDate, $monthEndDate, $yearStartDate, $yearEndDate) {
                        if ($day != null) $query->whereBetween('tree_plantations.date', [$day . " 00:00:00", $day . " 23:59:59"]);
                        if ($weekStartDate != null || $weekEndDate != null) $query->whereBetween('tree_plantations.date', [$weekStartDate, $weekEndDate]);
                        if ($monthStartDate != null || $monthEndDate != null) $query->whereBetween('tree_plantations.date', [$monthStartDate, $monthEndDate]);
                        if ($yearStartDate != null || $yearEndDate != null) $query->whereBetween('tree_plantations.date', [$yearStartDate, $yearEndDate]);
                        if ($fromDay != null && $untilDay == null) $query->whereBetween('tree_plantations.date', [$fromDay . " 00:00:00", now()->format('Y-m-d') . " 23:59:59"]);
                        if ($fromDay == null && $untilDay != null) $query->whereBetween('tree_plantations.date', ["2000-01-01 00:00:00", $untilDay . " 23:59:59"]);
                        if ($fromDay != null && $untilDay != null) $query->whereBetween('tree_plantations.date', [$fromDay . " 00:00:00", $untilDay . " 23:59:59"]);
                    })
                    // FILTRO DE CONSULTA POR PARAMETRO DE SEDE
                    ->where(function ($query) use ($request, $permissions) {
                        // SI TIENE EL PERMISO DE VISUALIZACIÓN DEL FILTRO
                        if (array_key_exists('filter_headquarters_tree_plantations', $permissions->permissions()))
                            // PUEDE ENVIARLA POR PARAMETRO
                            if ($request->delegation) $query->where('tree_plantations.headquarter_id', $request->delegation['code']);
                            // PERO SI NO LA ENVÍA ES PORQUE QUIERE UN REPORTE GENERAL
                            else $query->get();
                    })
                    // OBTENCIÓN DE LOS REGISTROS
                    ->get();

                // ESTA FUNCIÓN EN NECESARIA YA QUE LAS OBSERVACIONES SE GUARDAN CON HTML ES NECESARIO LIMPIARLAS PARA TENER SOLO EL TEXTO
                $cleanedReport = $report->map(function ($item) {
                    // LIMPIAR TEXTO HTML A TEXTO PLANO
                    $item->tp_observations = Str::of(strip_tags($item->tp_observations))->trim()->__toString();
                    // CAMBIAR EL FORMATO DE LA FECHA
                    $item->tp_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->tp_date)->format('d-m-Y');
                    // CAMBIAR EL FORMATO DE LA FECHA
                    $item->tp_created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->tp_created_at)->format('d-m-Y h:i:s');
                    // AGREGAR UN CAMPO PERSONALIZADO (NOMBRE COMPLETO)
                    $item->u_full_name = $item->u_first_name . ' ' . $item->u_second_name . ' ' . $item->u_first_last_name . ' ' . $item->u_second_last_name;
                    // RETORNO DE LOS CAMBIOS
                    return $item;
                });

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'GENERACIÓN DE REPORTE MASIVO DE PLANTACIÓN DE ÁRBOLES',
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // VALIDACIÓN DE CANTIDAD DE RESGISTROS EN LA RESPUESTA (SI NO HAY REGISTROS)
                if (count($cleanedReport) == 0) return response()->json(['file' => false, 'msg' => 'Para este rango de fechas no existen registros, verifique por favor.', 'fileName' => null, 'icon' => 'warning']);
                // SI HAY REGISTROS
                else {
                    $fileName = 'REPORTE-DE-PLANTACIÓN-DE-ÁRBOLES-' . str_replace([':', ' '], '-', now()->toDateTimeString()) . '.xlsx';
                    Excel::store(new TreePlantationExport($cleanedReport), $fileName, 'tree_plantations');
                    sleep(5);
                    return response()->json(['file' => true, 'msg' => 'Reporte generado con éxito', 'fileName' => $fileName, 'icon' => 'success']);
                }
            }
        } catch (\Exception $exception) {
            Log::error("(TreePlantationController - generateReport) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
