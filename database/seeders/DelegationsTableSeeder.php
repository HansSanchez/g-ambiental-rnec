<?php

namespace Database\Seeders;

use App\Models\Delegation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DelegationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {

            DB::table('delegations')->delete();

            Delegation::create([
                'id' => 1,
                'name' => 'AMAZONAS',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);


            Delegation::create([
                'id' => 2,
                'name' => 'ANTIOQUIA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 3,
                'name' => 'ARAUCA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 4,
                'name' => 'ATLÁNTICO',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 5,
                'name' => 'BOGOTÁ',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 6,
                'name' => 'BOLÍVAR',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 7,
                'name' => 'BOYACÁ',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 8,
                'name' => 'CALDAS',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 9,
                'name' => 'CAQUETÁ',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 10,
                'name' => 'CASANARE',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 11,
                'name' => 'CAUCA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 12,
                'name' => 'CESAR',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 13,
                'name' => 'CHOCÓ',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 14,
                'name' => 'CÓRDOBA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 15,
                'name' => 'CUNDINAMARCA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 16,
                'name' => 'GUAINÍA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 17,
                'name' => 'GUAVIARE',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 18,
                'name' => 'HUILA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 19,
                'name' => 'LA GUAJIRA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 20,
                'name' => 'MAGDALENA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 21,
                'name' => 'META',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 22,
                'name' => 'NARIÑO',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 23,
                'name' => 'NORTE DE SANTANDER',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 24,
                'name' => 'PUTUMAYO',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 25,
                'name' => 'QUINDÍO',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 26,
                'name' => 'RISARALDA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 27,
                'name' => 'SAN ANDRÉS Y PROVIDENCIA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 28,
                'name' => 'SANTANDER',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 29,
                'name' => 'SUCRE',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 30,
                'name' => 'TOLIMA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 31,
                'name' => 'VALLE DEL CAUCA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 32,
                'name' => 'VAUPÉS',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            Delegation::create([
                'id' => 33,
                'name' => 'VICHADA',
                'in_charge' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        } catch (\Exception $exception) {
            Log::error("(DelegationsTableSeeder - run) ERROR => " . $exception->getMessage());
        }
    }
}
