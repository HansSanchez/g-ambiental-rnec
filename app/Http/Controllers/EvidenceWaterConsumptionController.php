<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\WaterConsumption;
use App\Models\EvidenceWaterConsumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EvidenceWaterConsumptionController extends Controller
{
    public function evidenceWaterConsumption(WaterConsumption $waterConsumption)
    {
        $evidenceWaterConsumptions = EvidenceWaterConsumption::where('water_consumption_id', $waterConsumption->id)->get();
        return response()->json(['evidenceWaterConsumptions' => $evidenceWaterConsumptions]);
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
                $evidenceWaterConsumption = new EvidenceWaterConsumption($request->all());

                // VALIDACIÓN PARA EL GUARDADO EN LA CARPETA DEL PROYECTO
                if ($request->hasfile('file')) {
                    $file = Storage::disk('evidences_water_consumptions')->put('', $request->file('file'));
                    $evidenceWaterConsumption->name = $request->file('file')->getClientOriginalName();
                    $evidenceWaterConsumption->file = $file;
                    $evidenceWaterConsumption->extension = $request->file('file')->getClientOriginalExtension();
                    $evidenceWaterConsumption->water_consumption_id = $request->water_consumption_id;
                }

                // GUARDADO EN LA BASE DE DATOS
                $evidenceWaterConsumption->save();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La evidencia se registró con éxito.',
                    'evidenceWaterConsumption' => $evidenceWaterConsumption,
                    'new' => true

                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceWaterConsumptionController - storeEvidence) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function destroyEvidence(EvidenceWaterConsumption $id)
    {
        // CONTROL DE ERRORES
        try {
            // EL NOMBRE DE LA VARIABLE ES MUY LARGO (TOCO REDUCIRLO)
            $evidenceWaterConsumption = $id;

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE EVIDENCIA DE REGISTRO - CONSUMOS HÍDRICOS ID #' . $evidenceWaterConsumption->id,
                    'description' => $evidenceWaterConsumption,
                    'module' => 'CONSUMOS HÍDRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $evidenceWaterConsumption->delete();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La evidencia se ha eliminado con éxito.',
                    'evidenceWaterConsumption' => $evidenceWaterConsumption,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceWaterConsumptionController - destroyEvidence) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
