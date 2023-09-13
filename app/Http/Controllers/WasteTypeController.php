<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WasteTypeController extends Controller
{
    public function show($year, $month, $headquarter_id)
    {
        $wasteTypes = DB::table('waste_types')
            ->select(
                'waste_types.id',
                'waste_types.name',
                'waste_management.month',
                'waste_management.value',
                'waste_management.observations',
                'waste_types.danger_current',
                'waste_types.transportation_manager',
                'waste_types.external_manager',
                'waste_types.environmental_license',
                'waste_types.certificate_or_type_of_treatment',
                'waste_types.year',
                'waste_types.headquarter_id',
            )
            ->join('waste_management', 'waste_management.waste_type_id', '=', 'waste_types.id')
            // FILTRO DE CONSULTA POR PARAMETRO DE AÑO
            ->where(function ($query) use ($year) {
                if ($year) $query->where('waste_types.year', $year);
                else $query->where('waste_types.year', now()->format('Y'));
            })
            // FILTRO DE CONSULTA POR PARAMETRO DE MES
            ->where(function ($query) use ($month) {
                if ($month) $query->where('waste_management.month', $month);
                else $query->where('waste_management.month', $this->nowMonth());
            })
            // FILTRO DE CONSULTA POR PARAMETRO DE SEDE
            ->where(function ($query) use ($headquarter_id) {
                if ($headquarter_id) $query->where('waste_types.headquarter_id', $headquarter_id);
                // PUEDE VER SOLO LOS REGISTROS DE LA SEDE A LA CUAL PERTENECE
                else $query->where('waste_types.headquarter_id', Auth::user()->headquarter_id);
            })
            ->groupBy('waste_types.id')
            ->get();

        // RESPUESTA PARA EL USUARIO
        return response()->json(['wasteTypes' => $wasteTypes]);
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
}
