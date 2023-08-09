<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\EvidenceTreePlantation;
use App\Models\TreePlantation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EvidenceTreePlantationController extends Controller
{

    public function evidenceTreePlantation(TreePlantation $treePlantation)
    {
        $evidenceTreePlantation = EvidenceTreePlantation::where('tree_plantation_id', $treePlantation->id)->get();
        return response()->json(['evidenceTreePlantation' => $evidenceTreePlantation]);
    }

    public function storeImage(Request $request)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN EN CASO DE EJECUTAR SIN IMAGENES
            if ($request->file === "null")

                // RESPUESTA DE ADVERTENCIA
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'warning',
                    'msg' => 'No hay imagen adjunta',
                ]);

            // EN CASO DE QUE ENVIEN BIEN LAS IMÁGENES
            else {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // GUARDADO DE LA IMAGEN (ASÍ LLEGUEN VARÍAS CADA IMAGEN ES UNA PETICIÓN)
                $evidenceTreePlantation = new EvidenceTreePlantation($request->all());

                // VALIDACIÓN PARA EL GUARDADO EN LA CARPETA DEL PROYECTO
                if ($request->hasfile('file')) {
                    $file = Storage::disk('evidences_tree_plantations')->put('', $request->file('file'));
                    $evidenceTreePlantation->file = $file;
                    $evidenceTreePlantation->tree_plantation_id = $request->tree_plantation_id;
                }

                // GUARDADO EN LA BASE DE DATOS
                $evidenceTreePlantation->save();

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $evidenceTreePlantation->id,
                    'description' => $evidenceTreePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La imagen se registró con éxito.',
                    'evidenceTreePlantation' => $evidenceTreePlantation,
                    'new' => true

                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceTreePlantationController - storeImage) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function destroyImage(EvidenceTreePlantation $evidenceTreePlantation)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE EVIDENCIA DE REGISTRO - PLANTACIÓN DE ÁRBOLES ID #' . $evidenceTreePlantation->id,
                    'description' => $evidenceTreePlantation,
                    'module' => 'PLANTACIÓN DE ÁRBOLES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $evidenceTreePlantation->delete();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha eliminado con éxito.',
                    'evidenceTreePlantation' => $evidenceTreePlantation,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceTreePlantationController - destroyImage) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
