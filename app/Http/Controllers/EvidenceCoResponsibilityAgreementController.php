<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\CoResponsibilityAgreement;
use App\Models\EvidenceCoResponsibilityAgreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EvidenceCoResponsibilityAgreementController extends Controller
{
    public function evidenceCoResponsibilityAgreement(CoResponsibilityAgreement $coResponsibilityAgreement)
    {
        $evidenceCoResponsibilityAgreements = EvidenceCoResponsibilityAgreement::where('co_responsibility_agreement_id', $coResponsibilityAgreement->id)->get();
        return response()->json(['evidenceCoResponsibilityAgreements' => $evidenceCoResponsibilityAgreements]);
    }

    public function storeDocument(Request $request)
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
                $evidenceCoResponsibilityAgreement = new EvidenceCoResponsibilityAgreement($request->all());

                // VALIDACIÓN PARA EL GUARDADO EN LA CARPETA DEL PROYECTO
                if ($request->hasfile('file')) {
                    $file = Storage::disk('evidences_co_responsibility_agreements')->put('', $request->file('file'));
                    $evidenceCoResponsibilityAgreement->name = $request->file('file')->getClientOriginalName();
                    $evidenceCoResponsibilityAgreement->file = $file;
                    $evidenceCoResponsibilityAgreement->co_responsibility_agreement_id = $request->co_responsibility_agreement_id;
                }

                // GUARDADO EN LA BASE DE DATOS
                $evidenceCoResponsibilityAgreement->save();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El documento se registró con éxito.',
                    'evidenceCoResponsibilityAgreement' => $evidenceCoResponsibilityAgreement,
                    'new' => true

                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceCoResponsibilityAgreementController - storeDocument) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    public function destroyDocument(EvidenceCoResponsibilityAgreement $id)
    {
        // CONTROL DE ERRORES
        try {
            // EL NOMBRE DE LA VARIABLE ES MUY LARGO (TOCO REDUCIRLO)
            $evidenceCoResponsibilityAgreement = $id;

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID QUE HIZO EL REGISTRO
                $user_id = auth()->user()->id;

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'ELIMINACIÓN DE EVIDENCIA DE REGISTRO - ACUERDOS DE CORRESPONSABILIDAD ID #' . $evidenceCoResponsibilityAgreement->id,
                    'description' => $evidenceCoResponsibilityAgreement,
                    'module' => 'ACUERDOS DE CORRESPONSABILIDAD',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // ELIMINACIÓN DEL REGISTRO
                $evidenceCoResponsibilityAgreement->delete();

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El documento se ha eliminado con éxito.',
                    'evidenceCoResponsibilityAgreement' => $evidenceCoResponsibilityAgreement,
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(EvidenceCoResponsibilityAgreementController - destroyDocument) ERROR => " . $exception->getMessage());
            return response()->json(['message' => $exception->getMessage(), 'icon' => 'error']);
        }
    }
}
