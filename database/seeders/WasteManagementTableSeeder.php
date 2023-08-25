<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\WasteManagement;
use App\Models\WasteType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WasteManagementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // PASO 1. DEFINIR LOS MESES A LOS CUALES QUIERO CREALE DATOS
            $allMonths = [
                'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
            ];

            // PASO 2. IDENTIFICAR TODOS LOS MUNICIPIOS
            $allMunicipalities = Municipality::select('id', 'city_name', 'delegation_id')->where('city_name', '<>', 'TODOS LOS MUNICIPIOS')->get();

            // PASO 3. IDENTIFICAR TODOS LOS TIPOS
            $allTypes = WasteType::select('id')->get();

            // PASO 4. ELIMINACIÓN DE REGISTROS PREVIOS
            DB::table('waste_management')->delete();

            // PASO 5. CREAR LOS REGISTROS DEFAULT
            // RECORRER TODOS LOS MESES, MUNICIPIOS Y TIPOS
            foreach ($allMonths as $month) {
                foreach ($allMunicipalities as $municipality) {
                    foreach ($allTypes as $type) {
                        WasteManagement::create([
                            'month' => $month,
                            'value' => 0,
                            'observations' => '<p>SIN OBSERVACIONES</p>',
                            'delegation_id' => $municipality->delegation_id,
                            'municipality_id' => $municipality->id,
                            'user_id' => 1, // USUARIO POR DEFECTO CREADO EN EL SISTEMA AL MOMENTO DE LA INSTALACIÓN
                            'waste_type_id' => $type->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'deleted_at' => null,
                        ]);
                    }
                }
            }
        } catch (\Exception $exception) {
            Log::error("(WasteManagementTableSeeder - run) ERROR => " . $exception->getMessage());
        }
    }
}
