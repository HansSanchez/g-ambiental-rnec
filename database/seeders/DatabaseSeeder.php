<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DelegationsTableSeeder::class,
            MunicipalitiesTableSeeder::class,
            ElectricalConsumptionsTableSeeder::class,
            WaterConsumptionsTableSeeder::class,
        ]);
    }
}
