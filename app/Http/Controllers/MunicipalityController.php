<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MunicipalityController extends Controller
{
    public function getMunicipalities(Request $request)
    {
        // dd($request->all());
        return Municipality::select('id AS code', 'city_name AS label')
            ->search($request->search)
            ->where(function ($query) use ($request) {
                if ($request->delegation) {
                    $delegation = json_decode($request->delegation);
                    $query->where('municipalities.delegation_id', $delegation->code);
                } else $query->where('delegation_id', Auth::user()->delegation_id);
            })
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->where('municipalities.city_name', '<>', 'TODOS LOS MUNICIPIOS');
                }
            })
            ->orderBy('id', 'ASC')
            ->simplePaginate(100);
    }
}
