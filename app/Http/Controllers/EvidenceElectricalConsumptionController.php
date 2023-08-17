<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\ElectricalConsumption;
use App\Models\EvidenceElectricalConsumption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EvidenceElectricalConsumptionController extends Controller
{
    public function evidenceElectricalConsumption(ElectricalConsumption $electricalConsumption)
    {
        $evidenceElectricalConsumptions = EvidenceElectricalConsumption::where('electrical_consumption_id', $electricalConsumption->id)->get();
        return response()->json(['evidenceElectricalConsumptions' => $evidenceElectricalConsumptions]);
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
                $evidenceElectricalConsumption = new EvidenceElectricalConsumption($request->all());

                // VALIDACIÓN PARA EL GUARDADO EN LA CARPETA DEL PROYECTO
                if ($request->hasfile('file')) {
                    $file = Storage::disk('evidences_electrical_consumptions')->put('', $request->file('file'));
                    $evidenceElectricalConsumption->name = $request->file('file')->getClientOriginalName();
                    $evidenceElectricalConsumption->file = $file;
                    $evidenceElectricalConsumption->extension = $request->file('file')->getClientOriginalExtension();
                    $evidenceElectricalConsumption->electrical_consumption_id = $request->electrical_consumption_id;
                }

                // GUARDADO EN LA BASE DE DATOS
                $evidenceElectricalConsumption->save();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La evidencia se registró con éxito.',
                    'evidenceElectricalConsumption' => $evidenceElectricalConsumption,
                    'new' => true

                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceElectricalConsumptionController - storeEvidence) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function destroyEvidence(EvidenceElectricalConsumption $id)
    {
        // CONTROL DE ERRORES
        try {
            // EL NOMBRE DE LA VARIABLE ES MUY LARGO (TOCO REDUCIRLO)
            $evidenceElectricalConsumption = $id;

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE EVIDENCIA DE REGISTRO - CONSUMOS ELÉCTRICOS ID #' . $evidenceElectricalConsumption->id,
                    'description' => $evidenceElectricalConsumption,
                    'module' => 'CONSUMOS ELÉCTRICOS',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $evidenceElectricalConsumption->delete();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'La evidencia se ha eliminado con éxito.',
                    'evidenceElectricalConsumption' => $evidenceElectricalConsumption,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceElectricalConsumptionController - destroyEvidence) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }

}
