<?php

namespace Database\Seeders;

use App\Models\Headquarter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        try {

            if (User::count() == 0) {

                $headquarter = Headquarter::create([
                    'id' => 1,
                    'name' => 'SEDE CENTRAL',
                    'in_charge' => strtoupper('Geraldine Barón Castillo'),
                    'type' => 'CENTRAL',
                    'delegation_id' => 5,
                    'municipality_id' => 149,
                    'user_id' => null
                ]);

                User::create([
                    'personal_id'       => '1069766258',
                    'first_name'        => 'HANS',
                    'second_name'       => 'YADIEL',
                    'first_last_name'   => 'SÁNCHEZ',
                    'second_last_name'  => 'MORA',
                    'email'             => 'hysanchez@registraduria.gov.co',
                    'phone_number'      => '3126248950',
                    'position'          => 'ADMINISTRADOR',
                    'password'          => bcrypt('@990305Hans#.'),
                    'remember_token'    => Str::random(60),
                    'role_id'           => 1,
                    'delegation_id'     => 5, // BOGOTÁ
                    'municipality_id'   => 149, // BOGOTÁ
                    'headquarter_id'    => 1 // SEDE CENTRAL
                ]);

                $headquarter->update([
                    'id' => 1,
                    'user_id' => 1
                ]);

                // PASO 3. CREACIÓN DE LOS DATOS POR DEFECTO PARA ESTA SEDE
                $this->storeElectricalConsumption($headquarter); // CONSUMOS ELÉCTRICOS
                sleep(5); // BREVE PAUSA
                $this->storeWaterConsumption($headquarter); // CONSUMOS HÍDRICOS
            }
        } catch (\Exception $exception) {
            Log::error("(UsersTableSeeder - run) ERROR => " . $exception->getMessage());
        }
    }


    // FUNCIÓN PARA CREAR MASIVAMENTE REGISTROS POR DEFECTO PARA EL CONSUMO ELÉCTRICO
    public function storeElectricalConsumption($headquarter)
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
                        'user_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ];
                }
            }

            // PASO 4. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 2;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('electrical_consumptions')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(UsersTableSeeder - storeElectricalConsumption) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }

    // FUNCIÓN PARA CREAR MASIVAMENTE REGISTROS POR DEFECTO PARA EL CONSUMO HÍDRICO
    public function storeWaterConsumption($headquarter)
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
                        'user_id' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => null,
                    ];
                }
            }

            // PASO 4. INSERTAR LOS DATOS EN LOTES EN LA BASE DE DATOS
            $chunkSize = 2;
            $chunks = array_chunk($insertData, $chunkSize);
            foreach ($chunks as $chunk) DB::table('water_consumptions')->insert($chunk);
        } catch (\Exception $exception) {
            Log::error("(UsersTableSeeder - storeWaterConsumption) ERROR => " . $exception->getMessage());
            return response()->json(['msg' => $exception->getMessage(), 'icon' => 'error'], 500);
        }
    }
}
