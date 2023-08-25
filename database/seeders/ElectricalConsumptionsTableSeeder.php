<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ElectricalConsumptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // PASO 1. DEFINIR LA CANTIDAD DE AÑOS A LOS CUALES LE QUIERO GENERAR DATOS
            $allYears = [];
            for ($i = 2022; $i <= 2028; $i++) $allYears[] = $i;

            // PASO 2. DEFINIR LOS MESES A LOS CUALES QUIERO CREALE DATOS
            $allMonths = [
                'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
            ];

            // PASO 3. IDENTIFICAR TODOS LOS MUNICIPIOS
            $allMunicipalities = Municipality::select('id', 'city_name', 'delegation_id')->where('city_name', '<>', 'TODOS LOS MUNICIPIOS')->get();

            // PASO 4. ELIMINACIÓN DE REGISTROS PREVIOS
            DB::table('electrical_consumptions')->delete();

            // PASO 5. CREAR LOS REGISTROS DEFAULT
            $insertData = [];

            // RECORRER TODOS LOS AÑOS, MESES Y MUNICIPIOS
            foreach ($allYears as $year) {
                foreach ($allMonths as $month) {
                    foreach ($allMunicipalities as $municipality) {
                        $insertData[] = [
                            'environmental_manager' => 'NOMBRE DEL/LA GESTOR(A) AMBIENTAL',
                            'delegation_id' => $municipality->delegation_id,
                            'municipality_id' => $municipality->id,
                            'year' => $year,
                            'month' => $month,
                            'kw_monthly' => 0,
                            'total_staff' => 0,
                            'observations' => '<p>SIN OBSERVACIONES</p>',
                            'user_id' => 1, // USUARIO POR DEFECTO CREADO EN EL SISTEMA AL MOMENTO DE LA INSTALACIÓN
                            'created_at' => now(),
                            'updated_at' => now(),
                            'deleted_at' => null,
                        ];
                    }
                }
            }

            // PASO 6. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 2;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('electrical_consumptions')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(ElectricalConsumptionsTableSeeder - run) ERROR => " . $exception->getMessage());
        }
    }
}
