<?php

namespace App\Http\Controllers;

use App\Http\Requests\TreePlantationStoreRequest;
use App\Models\Audit;
use App\Models\EvidenceTreePlantation;
use App\Models\TreePlantation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TreePlantationController extends Controller
{
    public function getTreePlantation(Request $request)
    {
        $day = date('Y-m-d', strtotime($request->dateFilter));
        $permissions = new HomeController;
        $treePlantation =
            TreePlantation::with([
                'Delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                'EvidenceTreePlantations' => function ($query) {
                    $query->select(
                        'evidence_tree_plantations.id',
                        'evidence_tree_plantations.file',
                        'evidence_tree_plantations.tree_plantation_id'
                    );
                },
            ])
            ->where(function ($query) use ($request, $day, $permissions) {
                // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
                if ($request->search) $query->search($request->search);
                // FILTRO PARA BÚSQUEDA DE FECHA DE PLANTACIÓN
                if ($request->dateFilter) $query->whereBetween('tree_plantations.date', [$day . " 00:00:00", $day . " 23:59:59"]);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
                if (array_key_exists('filter_delegations_tree_plantations', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->delegations_model) {
                        $delegation = json_decode($request->delegations_model);
                        $query->where('tree_plantations.delegation_id', $delegation->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN A LA CUAL PERTENECE
                    $query->where('tree_plantations.delegation_id', Auth::user()->delegation_id);
                }
            })
            ->orderBy('tree_plantations.id')
            ->simplePaginate(10);
        return response()->json(['treePlantation' => $treePlantation]);
    }

    // FUNCIÓN DE CREACIÓN
    public function store(TreePlantationStoreRequest $request)
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
                $treePlantation = new TreePlantation($request->all());
                $treePlantation->address = mb_strtoupper($request->address);
                $treePlantation->delegation_id = $delegation_id;
                $treePlantation->user_id = $user_id;
                $treePlantation->save();

                // REGISTRO DE LAS RELACIONES
                $treePlantation->delegation;
                $treePlantation->user;

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

    public function show(TreePlantation $treePlantation)
    {
        // CONTROL DE ERRORES
        try {

            // RELACIONES
            $treePlantation->Delegation;
            $treePlantation->EvidenceTreePlantations;
            $treePlantation->User;

            // RESPUESTA PARA EL USUARIO
            return response()->json(['treePlantation' => $treePlantation]);

        } catch (\Exception $exception) {
            Log::error("(TreePlantationController - show) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

    public function update(Request $request, TreePlantation $treePlantation)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = $treePlantation->user_id;

                // OBTENCIÓN DE LA DELEGACIÓN DEL USUARIO QUE HIZO EL REGISTRO
                $delegation_id = $treePlantation->delegation_id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ACTUALIZACIÓN INICIAL DE REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $treePlantation->id,
                    'description' => $treePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ACTUALIZACIÓN DE REGISTRO
                $treePlantation->update([
                    'delegation_id' => $delegation_id,
                    'number_of_trees_planted' => $request->number_of_trees_planted,
                    'date' => $request->date,
                    'address' => mb_strtoupper($request->address),
                    'lat' => $request->lat,
                    'lng' => $request->lng,
                    'observations' => $request->observations,
                    'user_id' => $user_id,
                ]);

                // REGISTRO DE LAS RELACIONES
                $treePlantation->delegation;
                $treePlantation->user;

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
}
