<?php

namespace App\Http\Controllers;

use App\Exports\AuditsExport;
use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AuditController extends Controller
{
    public function getAudits(Request $request)
    {
        $search = $request->search;
        $audits =
            Audit::with([
                'user' => function ($query) {
                    $query->select(
                        'users.id',
                        'users.first_name',
                        'users.first_last_name',
                        'users.position',
                        'users.delegation_id',
                    );
                }
            ])
            ->search($search)
            ->orderBy('created_at', 'DESC')
            ->simplePaginate(10);
        return response()->json(['audits' => $audits]);
    }

    public function generateReport(Request $request): \Illuminate\Http\JsonResponse
    {
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
        $report = DB::table('audits')
            ->select(
                'audits.id AS au_id',
                'audits.action AS au_action',
                'audits.created_at AS au_created_at',
                'audits.module AS au_module',
                'users.id AS u_id',
                'users.personal_id AS u_personal_id',
                'users.first_name AS u_first_name',
                'users.second_name AS u_second_name',
                'users.first_last_name AS u_first_last_name',
                'users.second_last_name AS u_second_last_name',
                'users.position AS u_position',
                'users.email AS u_email',
                'users.delegation_id AS u_delegation_id',
            )
            ->join('users', 'users.id', '=', 'audits.user_id')
            ->where(function ($query) use ($fromDay, $untilDay, $day, $weekStartDate, $weekEndDate, $monthStartDate, $monthEndDate, $yearStartDate, $yearEndDate) {
                if ($day != null) $query->whereBetween('audits.created_at', [$day . " 00:00:00", $day . " 23:59:59"]);
                if ($weekStartDate != null || $weekEndDate != null) $query->whereBetween('audits.created_at', [$weekStartDate, $weekEndDate]);
                if ($monthStartDate != null || $monthEndDate != null) $query->whereBetween('audits.created_at', [$monthStartDate, $monthEndDate]);
                if ($yearStartDate != null || $yearEndDate != null) $query->whereBetween('audits.created_at', [$yearStartDate, $yearEndDate]);
                if ($fromDay != null && $untilDay == null) $query->whereBetween('audits.created_at', [$fromDay . " 00:00:00", now()->format('Y-m-d') . " 23:59:59"]);
                if ($fromDay == null && $untilDay != null) $query->whereBetween('audits.created_at', ["2000-01-01 00:00:00", $untilDay . " 23:59:59"]);
                if ($fromDay != null && $untilDay != null) $query->whereBetween('audits.created_at', [$fromDay . " 00:00:00", $untilDay . " 23:59:59"]);
            })->where(function ($query) {
                if (auth()->user()->role->name !== 'admin') $query->where('users.society_id', auth()->user()->society_id);
            })
            ->groupBy('audits.id')->get();

        Audit::create([
            'action' => 'GENERACIÓN DE REPORTE MASIVO DE AUDITORÍAS',
            'module' => 'AUDITORIAS',
            'user_id' => auth()->user()->id,
        ]);

        if (count($report) == 0) return response()->json(['file' => false, 'msg' => 'Para este rango de fechas no existen registros, verifique por favor.', 'fileName' => null, 'icon' => 'warning']);
        else {
            $fileName = 'REPORTE-DE-AUDITORÍAS-' . str_replace([':', ' '], '-', now()->toDateTimeString()) . '.xlsx';
            Excel::store(new AuditsExport($report), $fileName, 'audits');
            sleep(5);
            return response()->json(['file' => true, 'msg' => 'Reporte generado con éxito', 'fileName' => $fileName, 'icon' => 'success']);
        }
    }
}
