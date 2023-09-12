<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\EvidenceWasteManagement;
use App\Models\WasteManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EvidenceWasteManagementController extends Controller
{
    public function evidenceWasteManagement(WasteManagement $wasteManagement)
    {
        $evidenceWasteManagement = EvidenceWasteManagement::where('waste_management_id', $wasteManagement->id)->get();
        return response()->json(['evidenceWasteManagement' => $evidenceWasteManagement]);
    }

    public function storeEvidence(Request $request)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN EN CASO DE EJECUTAR SIN IMAGENES
            if ($request->file === "null")

                // RESPUESTA DE ADVERTENCIA
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'warning',
                    'msg' => 'No hay documento adjunto',
                ]);

            // EN CASO DE QUE ENVIEN BIEN LAS IMÁGENES
            else {

                // GUARDADO DEL DOCUMENTO (ASÍ LLEGUEN VARÍOS DOCUMENTOS ES UNA PETICIÓN)
                $evidenceWasteManagement = new EvidenceWasteManagement($request->all());

                // VALIDACIÓN PARA EL GUARDADO EN LA CARPETA DEL PROYECTO
                if ($request->hasfile('file')) {
                    $file = Storage::disk('evidences_waste_management')->put('', $request->file('file'));
                    $evidenceWasteManagement->name = $request->file('file')->getClientOriginalName();
                    $evidenceWasteManagement->file = $file;
                    $evidenceWasteManagement->extension = $request->file('file')->getClientOriginalExtension();
                    $evidenceWasteManagement->waste_management_id = $request->waste_management_id;
                }

                // GUARDADO EN LA BASE DE DATOS
                $evidenceWasteManagement->save();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La evidencia se registró con éxito.',
                    'evidenceWasteManagement' => $evidenceWasteManagement,
                    'new' => true

                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceWasteManagementController - storeEvidence) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function destroyEvidence(EvidenceWasteManagement $id)
    {
        // CONTROL DE ERRORES
        try {
            // EL NOMBRE DE LA VARIABLE ES MUY LARGO (TOCO REDUCIRLO)
            $evidenceWasteManagement = $id;

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE EVIDENCIA DE REGISTRO - GENERACIÓN DE RESIDUOS ID #' . $evidenceWasteManagement->id,
                    'description' => $evidenceWasteManagement,
                    'module' => 'GENERACIÓN DE RESIDUOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $evidenceWasteManagement->delete();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La evidencia se ha eliminado con éxito.',
                    'evidenceWasteManagement' => $evidenceWasteManagement,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceWasteManagementController - destroyEvidence) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
