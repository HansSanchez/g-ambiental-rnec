<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function permissions()
    {
        $query_permissions = auth()->user()->role->permissions->pluck('key');
        $permissions = [];
        foreach ($query_permissions as $query_permission) $permissions[$query_permission] = $query_permission;
        return $permissions;
    }
}
