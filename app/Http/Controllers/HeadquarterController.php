<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Headquarter;
use App\Models\WasteManagement;
use App\Models\WasteType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HeadquarterController extends Controller
{

    public function getHeadquartersFilter(Request $request)
    {
        return Headquarter::select('id AS code', 'name AS label')
            ->search($request->search)
            ->where(function ($query) use ($request) {
                if ($request->municipality) {
                    $municipality = json_decode($request->municipality);
                    $query->where('headquarters.municipality_id', $municipality->code);
                } else $query->where('municipality_id', Auth::user()->municipality_id);
            })
            ->orderBy('id', 'ASC')
            ->simplePaginate(25);
    }

    // FUNCIÓN DE OBTENCIÓN DE DATOS
    public function getHeadquarters(Request $request)
    {
        // CONSULTA DE LOS PERMISOS
        $permissions = new HomeController;
        // CONSULTA DE LAS SEDES
        $headquarters =
            Headquarter::with([
                // RELACIÓN CON LA DELEGACIÓN
                'Delegation' => function ($query) {
                    $query->select('delegations.id', 'delegations.name');
                },
                // RELACIÓN CON EL MUNICIPIO
                'Municipality' => function ($query) {
                    $query->select(
                        'municipalities.id',
                        'municipalities.city_name',
                    );
                },
                // RELACIÓN CON EL/LA CREADOR(A)
                'User' => function ($query) {
                    $query->select(
                        'users.id',
                        'users.first_name',
                        'users.second_name',
                        'users.first_last_name',
                        'users.second_last_name',
                    );
                },
            ])
            // FILTRO DE CONSULTA SEGÚN PARAMETROS DE BÚSQUEDA
            ->where(function ($query) use ($request, $permissions) {
                // FILTRO PARA BÚSQUEDA DE TEXTO EN OBSERVACIONES
                if ($request->search) $query->search($request->search);
                // SI EL FUNCIONARIO TIENE PERMISO DE BUSCAR POR DELEGACIÓN
                if (array_key_exists('filter_delegations_headquarters', $permissions->permissions())) {
                    // PUEDE ACCEDER AL FILTRO Y ENVIAR DIFERENTES DELEGACIONES POR PARAMETRO
                    if ($request->delegations_model) {
                        $delegation = json_decode($request->delegations_model);
                        $query->where('headquarters.delegation_id', $delegation->code);
                    } else $query->where('headquarters.delegation_id', Auth::user()->delegation_id);
                    if ($request->municipalities_model) {
                        $municipality = json_decode($request->municipalities_model);
                        $query->where('headquarters.municipality_id', $municipality->code);
                    }
                }
                // SI NO TIENE PERMISO
                else {
                    // PUEDE VER SOLO LOS REGISTROS DE LA DELEGACIÓN Y MUNICIPIO AL CUAL PERTENECE
                    $query->where('headquarters.delegation_id', Auth::user()->delegation_id)
                        ->where('headquarters.municipality_id', Auth::user()->municipality_id);
                }
            })
            ->orderBy('headquarters.created_at', 'DESC')
            ->simplePaginate(15);

        // RESPUESTA PARA EL USUARIO
        return response()->json(['headquarters' => $headquarters]);
    }

    // FUNCIÓN PARA CREACIÓN
    public function store(Request $request)
    {
        // CONTROL DE ERRORES
        try {

            // VALIDACIÓN DE SESEIÓN ACTIVA
            if (Auth::check()) {

                // OBTENCIÓN DEL ID CON SESIÓN ACTIVA
                $user_id = auth()->user()->id;

                // PASO 1. CREAR LA SEDE
                $headquarter = new Headquarter();
                $headquarter->name = mb_strtoupper($request->name); // NOMBRE DE LA SEDE
                $headquarter->in_charge = mb_strtoupper($request->in_charge); // PERSONA A CARGO
                $headquarter->type = mb_strtoupper($request->type); // TIPO DE SEDE
                $headquarter->delegation_id = $request->delegation['code']; // DELEGACIÓN
                $headquarter->municipality_id = $request->municipality['code']; // MUNICIPIO
                $headquarter->user_id = $user_id; // USUARIO QUE CREA EL REGISTRO
                $headquarter->save(); // ALMACENAMIENTO DE LA INFORMACIÓN

                // PASO 2. REGISTRO DE LAS RELACIONES
                $headquarter->Delegation;
                $headquarter->Municipality;
                $headquarter->User;

                // PASO 3. CREACIÓN DE LOS DATOS POR DEFECTO PARA ESTA SEDE
                $this->storeElectricalConsumptions($headquarter); // CONSUMOS ELÉCTRICOS
                $this->storeWaterConsumptions($headquarter); // CONSUMOS HÍDRICOS
                $this->storeWasteTypes($headquarter); // TIPOS DE RESIDUOS POR SEDE
                $this->storeWasteManagements($headquarter); // GENERACIÓN DE RESIDUOS

                // REGISTRO DE LA ACCIÓN REALIZADA
                Audit::create([
                    'action' => 'CREACIÓN DE NUEVO REGISTRO - SEDE ID #' . $headquarter->id,
                    'description' => $headquarter,
                    'module' => 'SEDES',
                    'user_id' => Auth::check() ? auth()->user()->id : $user_id,
                ]);

                // RESPUESTA SATISFATORIA PARA EL USUARIO
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'success',
                    'msg' => 'El registro se ha realizadó con éxito.',
                    'headquarter' => $headquarter,
                    'new' => true

                ]);
            } else {
                // CONTROL DE CASO DE SESIÓN EXPIRADA
                Log::error("Intento de guardado sin sesión activa - Registro de sedes");
                return response()->json([
                    'timeout' => 5000,
                    'type' => 'warning',
                    'msg' => 'La sesión se ha cerrado, por ende, no puedes hacer este registro.',
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(HeadquarterController - store) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA CREAR MASIVAMENTE REGISTROS POR DEFECTO PARA EL CONSUMO ELÉCTRICO
    public function storeElectricalConsumptions($headquarter)
    {
        // CONTROL DE ERRORES
        try {
            // PASO 1. DEFINIR LA CANTIDAD DE AÑOS A LOS CUALES LE QUIERO GENERAR DATOS
            $allYears = [];
            for ($i = 2022; $i <= 2032; $i++) $allYears[] = $i;

            // PASO 2. DEFINIR LOS MESES A LOS CUALES QUIERO CREALE DATOS
            $allMonths = [
                'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
            ];

            // PASO 3. CREAR LOS REGISTROS DEFAULT Y RECORRER TODOS LOS AÑOS CON SUS MESES
            $insertData = [];
            foreach ($allYears as $year) {
                foreach ($allMonths as $month) {
                    $insertData[] = [
                        'year' => $year,
                        'month' => $month,
                        'kw_monthly' => 0,
                        'total_staff' => 0,
                        'observations' => '<p>SIN OBSERVACIONES</p>',
                        'headquarter_id' => $headquarter->id,
                        'user_id' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ];
                }
            }

            // PASO 4. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 5;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('electrical_consumptions')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(HeadquarterController - storeElectricalConsumptions) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA CREAR MASIVAMENTE REGISTROS POR DEFECTO PARA EL CONSUMO HÍDRICO
    public function storeWaterConsumptions($headquarter)
    {

        // CONTROL DE ERRORES
        try {
            // PASO 1. DEFINIR LA CANTIDAD DE AÑOS A LOS CUALES LE QUIERO GENERAR DATOS
            $allYears = [];
            for ($i = 2022; $i <= 2032; $i++) $allYears[] = $i;

            // PASO 2. DEFINIR LOS MESES A LOS CUALES LE QUIERO GENERAR DATOS
            $allMonths = [
                'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
            ];

            // PASO 3. CREAR LOS REGISTROS DEFAULT Y RECORRER TODOS LOS AÑOS CON SUS MESES
            $insertData = [];
            foreach ($allYears as $year) {
                foreach ($allMonths as $month) {
                    $insertData[] = [
                        'year' => $year,
                        'month' => $month,
                        'm3_monthly' => 0,
                        'total_staff' => 0,
                        'observations' => '<p>SIN OBSERVACIONES</p>',
                        'headquarter_id' => $headquarter->id,
                        'user_id' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ];
                }
            }

            // PASO 4. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 5;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('water_consumptions')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(HeadquarterController - storeWaterConsumptions) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA CREAR MASIVAMENTE REGISTROS POR DEFECTO PARA TIPOS DE RESIDUOS POR SEDE
    public function storeWasteTypes($headquarter)
    {
        // CONTROL DE ERRORES
        try {
            // PASO 1. DEFINIR LA CANTIDAD DE AÑOS A LOS CUALES LE QUIERO GENERAR DATOS
            $allYears = [];
            for ($i = 2022; $i <= 2032; $i++) $allYears[] = $i;

            // PASO 2. IDENTIFICAR TODOS LOS TIPOS
            $allTypes = WasteType::select('id')->where('headquarter_id', $headquarter->id)->get();

            // PASO 3. CREAR LOS REGISTROS DEFAULT y RECORRER TODOS LOS MESES CON LOS DIFERENTES TIPOS
            foreach ($allYears as $year) {
                foreach ($allTypes as $type) {
                    $insertData[] = [
                        'name' => $type,
                        'danger_current' => null,
                        'transportation_manager' => null,
                        'external_manager' => null,
                        'environmental_license' => null,
                        'certificate_or_type_of_treatment' => null,
                        'year' => $year,
                        'headquarter_id' => $headquarter->id,
                        'user_id' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ];
                }
            }

            // PASO 4. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 2;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('waste_types')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(HeadquarterController - storeWasteTypes) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA CREAR MASIVAMENTE REGISTROS POR DEFECTO PARA LA GENERACIÓN DE RESIDUOS
    public function storeWasteManagements($headquarter)
    {
        // CONTROL DE ERRORES
        try {
            // PASO 1. DEFINIR LOS MESES A LOS CUALES QUIERO CREALE DATOS
            $allMonths = [
                'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
            ];

            // PASO 2. IDENTIFICAR TODOS LOS TIPOS
            $allTypes = WasteType::select('id')->get();

            // PASO 3. CREAR LOS REGISTROS DEFAULT y RECORRER TODOS LOS MESES CON LOS DIFERENTES TIPOS
            foreach ($allMonths as $month) {
                foreach ($allTypes as $type) {
                    WasteManagement::create([
                        'month' => $month,
                        'value' => 0,
                        'observations' => '<p>SIN OBSERVACIONES</p>',
                        'headquarter_id' => $headquarter->id,
                        'user_id' => Auth::user()->id,
                        'waste_type_id' => $type->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ]);
                }
            }
        } catch (\Exception $exception) {
            Log::error("(HeadquarterController - storeWasteManagements) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }
}
