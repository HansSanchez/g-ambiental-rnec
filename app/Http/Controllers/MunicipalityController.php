<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MunicipalityController extends Controller
{
    public function getMunicipalities(Request $request)
    {
        return Municipality::select('id AS code', 'city_name AS label')
            ->search($request->search)
            ->where('delegation_id', Auth::user()->delegation_id)
            ->orderBy('id', 'ASC')
            ->simplePaginate(100);
    }
}
