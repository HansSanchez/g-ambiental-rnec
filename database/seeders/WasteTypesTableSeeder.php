<?php

namespace Database\Seeders;

use App\Models\WasteType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WasteTypesTableSeeder extends Seeder
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
            for ($i = 2022; $i <= 2032; $i++) $allYears[] = $i;

            // PASO 2. DEFINIR LOS TIPOS DE RESIDUOS
            $allTypes = [
                "BIOSANITARIOS",
                "RAEE (KG)",
                "LUMINARIAS (KG)",
                "TÓNER (KG)",
                "EFLUENTES CON TINTAS, SÓLIDOS IMPREGNADOS, ETC (KG)",
                "PILAS Y BATERÍAS",
                "MUEBLES Y ENSERES (KG)",
                "APROVECHABLES ELECTORALES (KG)",
                "APROVECHABLES (KG)",
            ];

            // PASO 3. BORRAR LOS REGISTROS PREVIOS
            DB::table('waste_types')->delete();

            // PASO 4. CREAR LOS REGISTROS DEFAULT
            $insertData = [];

            // RECORRER TODOS LOS AÑOS Y TIPOS
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
                        'user_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ];
                }
            }

            // PASO 5. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 2;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('waste_types')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(WasteTypesTableSeeder - run) ERROR => " . $exception->getMessage());
        }
    }
}
