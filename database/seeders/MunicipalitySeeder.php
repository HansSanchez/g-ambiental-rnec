<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Delegation;
use App\Models\Municipality;
use Illuminate\Support\Facades\Log;


class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        try {
            DB::table('municipalities')->delete();

            Municipality::create([
                'id' => 1,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5001',
                'city_name' => 'MEDELLÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 2,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5002',
                'city_name' => 'ABEJORRAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 3,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5004',
                'city_name' => 'ABRIAQUÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 4,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5021',
                'city_name' => 'ALEJANDRÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 5,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5030',
                'city_name' => 'AMAGÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 6,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5031',
                'city_name' => 'AMALFI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 7,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5034',
                'city_name' => 'ANDES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 8,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5036',
                'city_name' => 'ANGELÓPOLIS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 9,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5038',
                'city_name' => 'ANGOSTURA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 10,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5040',
                'city_name' => 'ANORÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 11,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5042',
                'city_name' => 'SANTA FÉ DE ANTIOQUIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 12,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5044',
                'city_name' => 'ANZÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 13,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5045',
                'city_name' => 'APARTADÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 14,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5051',
                'city_name' => 'ARBOLETES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 15,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5055',
                'city_name' => 'ARGELIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 16,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5059',
                'city_name' => 'ARMENIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 17,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5079',
                'city_name' => 'BARBOSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 18,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5086',
                'city_name' => 'BELMIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 19,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5088',
                'city_name' => 'BELLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 20,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5091',
                'city_name' => 'BETANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 21,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5093',
                'city_name' => 'BETULIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 22,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5101',
                'city_name' => 'CIUDAD BOLÍVAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 23,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5107',
                'city_name' => 'BRICEÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 24,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5113',
                'city_name' => 'BURITICÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 25,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5120',
                'city_name' => 'CÁCERES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 26,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5125',
                'city_name' => 'CAICEDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 27,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5129',
                'city_name' => 'CALDAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 28,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5134',
                'city_name' => 'CAMPAMENTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 29,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5138',
                'city_name' => 'CAÑASGORDAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 30,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5142',
                'city_name' => 'CARACOLÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 31,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5145',
                'city_name' => 'CARAMANTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 32,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5147',
                'city_name' => 'CAREPA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 33,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5148',
                'city_name' => 'EL CARMEN DE VIBORAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 34,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5150',
                'city_name' => 'CAROLINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 35,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5154',
                'city_name' => 'CAUCASIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 36,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5172',
                'city_name' => 'CHIGORODÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 37,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5190',
                'city_name' => 'CISNEROS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 38,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5197',
                'city_name' => 'COCORNÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 39,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5206',
                'city_name' => 'CONCEPCIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 40,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5209',
                'city_name' => 'CONCORDIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 41,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5212',
                'city_name' => 'COPACABANA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 42,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5234',
                'city_name' => 'DABEIBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 43,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5237',
                'city_name' => 'DONMATÍAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 44,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5240',
                'city_name' => 'EBÉJICO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 45,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5250',
                'city_name' => 'EL BAGRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 46,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5264',
                'city_name' => 'ENTRERRÍOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 47,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5266',
                'city_name' => 'ENVIGADO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 48,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5282',
                'city_name' => 'FREDONIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 49,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5284',
                'city_name' => 'FRONTINO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 50,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5306',
                'city_name' => 'GIRALDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 51,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5308',
                'city_name' => 'GIRARDOTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 52,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5310',
                'city_name' => 'GÓMEZ PLATA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 53,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5313',
                'city_name' => 'GRANADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 54,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5315',
                'city_name' => 'GUADALUPE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 55,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5318',
                'city_name' => 'GUARNE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 56,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5321',
                'city_name' => 'GUATAPÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 57,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5347',
                'city_name' => 'HELICONIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 58,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5353',
                'city_name' => 'HISPANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 59,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5360',
                'city_name' => 'ITAGÜÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 60,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5361',
                'city_name' => 'ITUANGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 61,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5364',
                'city_name' => 'JARDÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 62,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5368',
                'city_name' => 'JERICÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 63,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5376',
                'city_name' => 'LA CEJA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 64,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5380',
                'city_name' => 'LA ESTRELLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 65,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5390',
                'city_name' => 'LA PINTADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 66,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5400',
                'city_name' => 'LA UNIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 67,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5411',
                'city_name' => 'LIBORINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 68,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5425',
                'city_name' => 'MACEO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 69,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5440',
                'city_name' => 'MARINILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 70,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5467',
                'city_name' => 'MONTEBELLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 71,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5475',
                'city_name' => 'MURINDÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 72,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5480',
                'city_name' => 'MUTATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 73,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5483',
                'city_name' => 'NARIÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 74,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5490',
                'city_name' => 'NECOCLÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 75,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5495',
                'city_name' => 'NECHÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 76,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5501',
                'city_name' => 'OLAYA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 77,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5541',
                'city_name' => 'PEÑOL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 78,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5543',
                'city_name' => 'PEQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 79,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5576',
                'city_name' => 'PUEBLORRICO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 80,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5579',
                'city_name' => 'PUERTO BERRÍO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 81,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5585',
                'city_name' => 'PUERTO NARE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 82,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5591',
                'city_name' => 'PUERTO TRIUNFO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 83,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5604',
                'city_name' => 'REMEDIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 84,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5607',
                'city_name' => 'RETIRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 85,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5615',
                'city_name' => 'RIONEGRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 86,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5628',
                'city_name' => 'SABANALARGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 87,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5631',
                'city_name' => 'SABANETA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 88,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5642',
                'city_name' => 'SALGAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 89,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5647',
                'city_name' => 'SAN ANDRÉS DE CUERQUÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 90,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5649',
                'city_name' => 'SAN CARLOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 91,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5652',
                'city_name' => 'SAN FRANCISCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 92,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5656',
                'city_name' => 'SAN JERÓNIMO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 93,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5658',
                'city_name' => 'SAN JOSÉ DE LA MONTAÑA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 94,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5659',
                'city_name' => 'SAN JUAN DE URABÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 95,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5660',
                'city_name' => 'SAN LUIS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 96,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5664',
                'city_name' => 'SAN PEDRO DE LOS MILAGROS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 97,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5665',
                'city_name' => 'SAN PEDRO DE URABÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 98,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5667',
                'city_name' => 'SAN RAFAEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 99,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5670',
                'city_name' => 'SAN ROQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 100,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5674',
                'city_name' => 'SAN VICENTE FERRER',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 101,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5679',
                'city_name' => 'SANTA BÁRBARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 102,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5686',
                'city_name' => 'SANTA ROSA DE OSOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 103,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5690',
                'city_name' => 'SANTO DOMINGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 104,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5697',
                'city_name' => 'EL SANTUARIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 105,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5736',
                'city_name' => 'SEGOVIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 106,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5756',
                'city_name' => 'SONSÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 107,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5761',
                'city_name' => 'SOPETRÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 108,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5789',
                'city_name' => 'TÁMESIS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 109,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5790',
                'city_name' => 'TARAZÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 110,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5792',
                'city_name' => 'TARSO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 111,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5809',
                'city_name' => 'TITIRIBÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 112,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5819',
                'city_name' => 'TOLEDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 113,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5837',
                'city_name' => 'TURBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 114,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5842',
                'city_name' => 'URAMITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 115,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5847',
                'city_name' => 'URRAO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 116,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5854',
                'city_name' => 'VALDIVIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 117,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5856',
                'city_name' => 'VALPARAÍSO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 118,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5858',
                'city_name' => 'VEGACHÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 119,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5861',
                'city_name' => 'VENECIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 120,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5873',
                'city_name' => 'VIGÍA DEL FUERTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 121,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5885',
                'city_name' => 'YALÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 122,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5887',
                'city_name' => 'YARUMAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 123,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5890',
                'city_name' => 'YOLOMBÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 124,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5893',
                'city_name' => 'YONDÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 125,
                'state_code' => '5',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '5895',
                'city_name' => 'ZARAGOZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 126,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8001',
                'city_name' => 'BARRANQUILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 127,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8078',
                'city_name' => 'BARANOA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 128,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8137',
                'city_name' => 'CAMPO DE LA CRUZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 129,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8141',
                'city_name' => 'CANDELARIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 130,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8296',
                'city_name' => 'GALAPA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 131,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8372',
                'city_name' => 'JUAN DE ACOSTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 132,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8421',
                'city_name' => 'LURUACO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 133,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8433',
                'city_name' => 'MALAMBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 134,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8436',
                'city_name' => 'MANATÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 135,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8520',
                'city_name' => 'PALMAR DE VARELA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 136,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8549',
                'city_name' => 'PIOJÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 137,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8558',
                'city_name' => 'POLONUEVO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 138,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8560',
                'city_name' => 'PONEDERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 139,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8573',
                'city_name' => 'PUERTO COLOMBIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 140,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8606',
                'city_name' => 'REPELÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 141,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8634',
                'city_name' => 'SABANAGRANDE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 142,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8638',
                'city_name' => 'SABANALARGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 143,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8675',
                'city_name' => 'SANTA LUCÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 144,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8685',
                'city_name' => 'SANTO TOMÁS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 145,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8758',
                'city_name' => 'SOLEDAD',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 146,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8770',
                'city_name' => 'SUAN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 147,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8832',
                'city_name' => 'TUBARÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 148,
                'state_code' => '8',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '8849',
                'city_name' => 'USIACURÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 149,
                'state_code' => '11',
                'state_name' => 'BOGOTÁ',
                'city_code' => '11001',
                'city_name' => 'BOGOTÁ',
                'active' => 1,
                'delegation_id' => Delegation::where('name', 'BOGOTÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            Municipality::create([
                'id' => 150,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13001',
                'city_name' => 'CARTAGENA DE INDIAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 151,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13006',
                'city_name' => 'ACHÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 152,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13030',
                'city_name' => 'ALTOS DEL ROSARIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 153,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13042',
                'city_name' => 'ARENAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 154,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13052',
                'city_name' => 'ARJONA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 155,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13062',
                'city_name' => 'ARROYOHONDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 156,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13074',
                'city_name' => 'BARRANCO DE LOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 157,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13140',
                'city_name' => 'CALAMAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 158,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13160',
                'city_name' => 'CANTAGALLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 159,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13188',
                'city_name' => 'CICUCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 160,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13212',
                'city_name' => 'CÓRDOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 161,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13222',
                'city_name' => 'CLEMENCIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 162,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13244',
                'city_name' => 'EL CARMEN DE BOLÍVAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 163,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13248',
                'city_name' => 'EL GUAMO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 164,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13268',
                'city_name' => 'EL PEÑÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 165,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13300',
                'city_name' => 'HATILLO DE LOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 166,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13430',
                'city_name' => 'MAGANGUÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 167,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13433',
                'city_name' => 'MAHATES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 168,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13440',
                'city_name' => 'MARGARITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 169,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13442',
                'city_name' => 'MARÍA LA BAJA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 170,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13458',
                'city_name' => 'MONTECRISTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 171,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13468',
                'city_name' => 'MOMPÓS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 172,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13473',
                'city_name' => 'MORALES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 173,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13490',
                'city_name' => 'NOROSÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 174,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13549',
                'city_name' => 'PINILLOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 175,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13580',
                'city_name' => 'REGIDOR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 176,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13600',
                'city_name' => 'RÍO VIEJO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 177,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13620',
                'city_name' => 'SAN CRISTÓBAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 178,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13647',
                'city_name' => 'SAN ESTANISLAO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 179,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13650',
                'city_name' => 'SAN FERNANDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 180,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13654',
                'city_name' => 'SAN JACINTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 181,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13655',
                'city_name' => 'SAN JACINTO DEL CAUCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 182,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13657',
                'city_name' => 'SAN JUAN NEPOMUCENO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 183,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13667',
                'city_name' => 'SAN MARTÍN DE LOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 184,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13670',
                'city_name' => 'SAN PABLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 185,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13673',
                'city_name' => 'SANTA CATALINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 186,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13683',
                'city_name' => 'SANTA ROSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 187,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13688',
                'city_name' => 'SANTA ROSA DEL SUR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 188,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13744',
                'city_name' => 'SIMITÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 189,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13760',
                'city_name' => 'SOPLAVIENTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 190,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13780',
                'city_name' => 'TALAIGUA NUEVO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 191,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13810',
                'city_name' => 'TIQUISIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 192,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13836',
                'city_name' => 'TURBACO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 193,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13838',
                'city_name' => 'TURBANÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 194,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13873',
                'city_name' => 'VILLANUEVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 195,
                'state_code' => '13',
                'state_name' => 'BOLÍVAR',
                'city_code' => '13894',
                'city_name' => 'ZAMBRANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 196,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15001',
                'city_name' => 'TUNJA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 197,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15022',
                'city_name' => 'ALMEIDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 198,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15047',
                'city_name' => 'AQUITANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 199,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15051',
                'city_name' => 'ARCABUCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 200,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15087',
                'city_name' => 'BELÉN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 201,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15090',
                'city_name' => 'BERBEO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 202,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15092',
                'city_name' => 'BETÉITIVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 203,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15097',
                'city_name' => 'BOAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 204,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15104',
                'city_name' => 'BOYACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 205,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15106',
                'city_name' => 'BRICEÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 206,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15109',
                'city_name' => 'BUENAVISTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 207,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15114',
                'city_name' => 'BUSBANZÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 208,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15131',
                'city_name' => 'CALDAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 209,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15135',
                'city_name' => 'CAMPOHERMOSO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 210,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15162',
                'city_name' => 'CERINZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 211,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15172',
                'city_name' => 'CHINAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 212,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15176',
                'city_name' => 'CHIQUINQUIRÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 213,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15180',
                'city_name' => 'CHISCAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 214,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15183',
                'city_name' => 'CHITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 215,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15185',
                'city_name' => 'CHITARAQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 216,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15187',
                'city_name' => 'CHIVATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 217,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15189',
                'city_name' => 'CIÉNEGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 218,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15204',
                'city_name' => 'CÓMBITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 219,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15212',
                'city_name' => 'COPER',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 220,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15215',
                'city_name' => 'CORRALES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 221,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15218',
                'city_name' => 'COVARACHÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 222,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15223',
                'city_name' => 'CUBARÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 223,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15224',
                'city_name' => 'CUCAITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 224,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15226',
                'city_name' => 'CUÍTIVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 225,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15232',
                'city_name' => 'CHÍQUIZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 226,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15236',
                'city_name' => 'CHIVOR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 227,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15238',
                'city_name' => 'DUITAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 228,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15244',
                'city_name' => 'EL COCUY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 229,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15248',
                'city_name' => 'EL ESPINO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 230,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15272',
                'city_name' => 'FIRAVITOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 231,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15276',
                'city_name' => 'FLORESTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 232,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15293',
                'city_name' => 'GACHANTIVÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 233,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15296',
                'city_name' => 'GÁMEZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 234,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15299',
                'city_name' => 'GARAGOA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 235,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15317',
                'city_name' => 'GUACAMAYAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 236,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15322',
                'city_name' => 'GUATEQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 237,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15325',
                'city_name' => 'GUAYATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 238,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15332',
                'city_name' => 'GÜICÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 239,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15362',
                'city_name' => 'IZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 240,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15367',
                'city_name' => 'JENESANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 241,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15368',
                'city_name' => 'JERICÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 242,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15377',
                'city_name' => 'LABRANZAGRANDE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 243,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15380',
                'city_name' => 'LA CAPILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 244,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15401',
                'city_name' => 'LA VICTORIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 245,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15403',
                'city_name' => 'LA UVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 246,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15407',
                'city_name' => 'VILLA DE LEYVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 247,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15425',
                'city_name' => 'MACANAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 248,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15442',
                'city_name' => 'MARIPÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 249,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15455',
                'city_name' => 'MIRAFLORES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 250,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15464',
                'city_name' => 'MONGUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 251,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15466',
                'city_name' => 'MONGUÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 252,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15469',
                'city_name' => 'MONIQUIRÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 253,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15476',
                'city_name' => 'MOTAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 254,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15480',
                'city_name' => 'MUZO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 255,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15491',
                'city_name' => 'NOBSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 256,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15494',
                'city_name' => 'NUEVO COLÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 257,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15500',
                'city_name' => 'OICATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 258,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15507',
                'city_name' => 'OTANCHE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 259,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15511',
                'city_name' => 'PACHAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 260,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15514',
                'city_name' => 'PÁEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 261,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15516',
                'city_name' => 'PAIPA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 262,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15518',
                'city_name' => 'PAJARITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 263,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15522',
                'city_name' => 'PANQUEBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 264,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15531',
                'city_name' => 'PAUNA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 265,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15533',
                'city_name' => 'PAYA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 266,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15537',
                'city_name' => 'PAZ DE RÍO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 267,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15542',
                'city_name' => 'PESCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 268,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15550',
                'city_name' => 'PISBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 269,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15572',
                'city_name' => 'PUERTO BOYACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 270,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15580',
                'city_name' => 'QUÍPAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 271,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15599',
                'city_name' => 'RAMIRIQUÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 272,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15600',
                'city_name' => 'RÁQUIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 273,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15621',
                'city_name' => 'RONDÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 274,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15632',
                'city_name' => 'SABOYÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 275,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15638',
                'city_name' => 'SÁCHICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 276,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15646',
                'city_name' => 'SAMACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 277,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15660',
                'city_name' => 'SAN EDUARDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 278,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15664',
                'city_name' => 'SAN JOSÉ DE PARE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 279,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15667',
                'city_name' => 'SAN LUIS DE GACENO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 280,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15673',
                'city_name' => 'SAN MATEO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 281,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15676',
                'city_name' => 'SAN MIGUEL DE SEMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 282,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15681',
                'city_name' => 'SAN PABLO DE BORBUR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 283,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15686',
                'city_name' => 'SANTANA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 284,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15690',
                'city_name' => 'SANTA MARÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 285,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15693',
                'city_name' => 'SANTA ROSA DE VITERBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 286,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15696',
                'city_name' => 'SANTA SOFÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 287,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15720',
                'city_name' => 'SATIVANORTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 288,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15723',
                'city_name' => 'SATIVASUR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 289,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15740',
                'city_name' => 'SIACHOQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 290,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15753',
                'city_name' => 'SOATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 291,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15755',
                'city_name' => 'SOCOTÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 292,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15757',
                'city_name' => 'SOCHA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 293,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15759',
                'city_name' => 'SOGAMOSO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 294,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15761',
                'city_name' => 'SOMONDOCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 295,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15762',
                'city_name' => 'SORA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 296,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15763',
                'city_name' => 'SOTAQUIRÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 297,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15764',
                'city_name' => 'SORACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 298,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15774',
                'city_name' => 'SUSACÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 299,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15776',
                'city_name' => 'SUTAMARCHÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 300,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15778',
                'city_name' => 'SUTATENZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 301,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15790',
                'city_name' => 'TASCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 302,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15798',
                'city_name' => 'TENZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 303,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15804',
                'city_name' => 'TIBANÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 304,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15806',
                'city_name' => 'TIBASOSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 305,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15808',
                'city_name' => 'TINJACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 306,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15810',
                'city_name' => 'TIPACOQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 307,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15814',
                'city_name' => 'TOCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 308,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15816',
                'city_name' => 'TOGÜÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 309,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15820',
                'city_name' => 'TÓPAGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 310,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15822',
                'city_name' => 'TOTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 311,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15832',
                'city_name' => 'TUNUNGUÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 312,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15835',
                'city_name' => 'TURMEQUÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 313,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15837',
                'city_name' => 'TUTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 314,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15839',
                'city_name' => 'TUTAZÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 315,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15842',
                'city_name' => 'ÚMBITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 316,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15861',
                'city_name' => 'VENTAQUEMADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 317,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15879',
                'city_name' => 'VIRACACHÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 318,
                'state_code' => '15',
                'state_name' => 'BOYACÁ',
                'city_code' => '15897',
                'city_name' => 'ZETAQUIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 319,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17001',
                'city_name' => 'MANIZALES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 320,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17013',
                'city_name' => 'AGUADAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 321,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17042',
                'city_name' => 'ANSERMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 322,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17050',
                'city_name' => 'ARANZAZU',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 323,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17088',
                'city_name' => 'BELALCÁZAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 324,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17174',
                'city_name' => 'CHINCHINÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 325,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17272',
                'city_name' => 'FILADELFIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 326,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17380',
                'city_name' => 'LA DORADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 327,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17388',
                'city_name' => 'LA MERCED',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 328,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17433',
                'city_name' => 'MANZANARES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 329,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17442',
                'city_name' => 'MARMATO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 330,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17444',
                'city_name' => 'MARQUETALIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 331,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17446',
                'city_name' => 'MARULANDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 332,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17486',
                'city_name' => 'NEIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 333,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17495',
                'city_name' => 'NORCASIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 334,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17513',
                'city_name' => 'PÁCORA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 335,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17524',
                'city_name' => 'PALESTINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 336,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17541',
                'city_name' => 'PENSILVANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 337,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17614',
                'city_name' => 'RIOSUCIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 338,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17616',
                'city_name' => 'RISARALDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 339,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17653',
                'city_name' => 'SALAMINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 340,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17662',
                'city_name' => 'SAMANÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 341,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17665',
                'city_name' => 'SAN JOSÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 342,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17777',
                'city_name' => 'SUPÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 343,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17867',
                'city_name' => 'VICTORIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 344,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17873',
                'city_name' => 'VILLAMARÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 345,
                'state_code' => '17',
                'state_name' => 'CALDAS',
                'city_code' => '17877',
                'city_name' => 'VITERBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 346,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18001',
                'city_name' => 'FLORENCIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 347,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18029',
                'city_name' => 'ALBANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 348,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18094',
                'city_name' => 'BELÉN DE LOS ANDAQUÍES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 349,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18150',
                'city_name' => 'CARTAGENA DEL CHAIRÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 350,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18205',
                'city_name' => 'CURILLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 351,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18247',
                'city_name' => 'EL DONCELLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 352,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18256',
                'city_name' => 'EL PAUJÍL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 353,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18410',
                'city_name' => 'LA MONTAÑITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 354,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18460',
                'city_name' => 'MILÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 355,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18479',
                'city_name' => 'MORELIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 356,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18592',
                'city_name' => 'PUERTO RICO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 357,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18610',
                'city_name' => 'SAN JOSÉ DEL FRAGUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 358,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18753',
                'city_name' => 'SAN VICENTE DEL CAGUÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 359,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18756',
                'city_name' => 'SOLANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 360,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18785',
                'city_name' => 'SOLITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 361,
                'state_code' => '18',
                'state_name' => 'CAQUETÁ',
                'city_code' => '18860',
                'city_name' => 'VALPARAÍSO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 362,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19001',
                'city_name' => 'POPAYÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 363,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19022',
                'city_name' => 'ALMAGUER',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 364,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19050',
                'city_name' => 'ARGELIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 365,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19075',
                'city_name' => 'BALBOA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 366,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19100',
                'city_name' => 'BOLÍVAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 367,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19110',
                'city_name' => 'BUENOS AIRES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 368,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19130',
                'city_name' => 'CAJIBÍO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 369,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19137',
                'city_name' => 'CALDONO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 370,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19142',
                'city_name' => 'CALOTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 371,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19212',
                'city_name' => 'CORINTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 372,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19256',
                'city_name' => 'EL TAMBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 373,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19290',
                'city_name' => 'FLORENCIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 374,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19300',
                'city_name' => 'GUACHENÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 375,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19318',
                'city_name' => 'GUAPÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 376,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19355',
                'city_name' => 'INZÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 377,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19364',
                'city_name' => 'JAMBALÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 378,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19392',
                'city_name' => 'LA SIERRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 379,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19397',
                'city_name' => 'LA VEGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 380,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19418',
                'city_name' => 'LÓPEZ DE MICAY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 381,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19450',
                'city_name' => 'MERCADERES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 382,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19455',
                'city_name' => 'MIRANDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 383,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19473',
                'city_name' => 'MORALES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 384,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19513',
                'city_name' => 'PADILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 385,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19517',
                'city_name' => 'PÁEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 386,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19532',
                'city_name' => 'PATÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 387,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19533',
                'city_name' => 'PIAMONTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 388,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19548',
                'city_name' => 'PIENDAMÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 389,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19573',
                'city_name' => 'PUERTO TEJADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 390,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19585',
                'city_name' => 'PURACÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 391,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19622',
                'city_name' => 'ROSAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 392,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19693',
                'city_name' => 'SAN SEBASTIÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 393,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19698',
                'city_name' => 'SANTANDER DE QUILICHAO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 394,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19701',
                'city_name' => 'SANTA ROSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 395,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19743',
                'city_name' => 'SILVIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 396,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19760',
                'city_name' => 'SOTARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 397,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19780',
                'city_name' => 'SUÁREZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 398,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19785',
                'city_name' => 'SUCRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 399,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19807',
                'city_name' => 'TIMBÍO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 400,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19809',
                'city_name' => 'TIMBIQUÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 401,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19821',
                'city_name' => 'TORIBÍO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 402,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19824',
                'city_name' => 'TOTORÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 403,
                'state_code' => '19',
                'state_name' => 'CAUCA',
                'city_code' => '19845',
                'city_name' => 'VILLA RICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 404,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20001',
                'city_name' => 'VALLEDUPAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 405,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20011',
                'city_name' => 'AGUACHICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 406,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20013',
                'city_name' => 'AGUSTÍN CODAZZI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 407,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20032',
                'city_name' => 'ASTREA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 408,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20045',
                'city_name' => 'BECERRIL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 409,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20060',
                'city_name' => 'BOSCONIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 410,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20175',
                'city_name' => 'CHIMICHAGUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 411,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20178',
                'city_name' => 'CHIRIGUANÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 412,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20228',
                'city_name' => 'CURUMANÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 413,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20238',
                'city_name' => 'EL COPEY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 414,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20250',
                'city_name' => 'EL PASO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 415,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20295',
                'city_name' => 'GAMARRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 416,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20310',
                'city_name' => 'GONZÁLEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 417,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20383',
                'city_name' => 'LA GLORIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 418,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20400',
                'city_name' => 'LA JAGUA DE IBIRICO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 419,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20443',
                'city_name' => 'MANAURE BALCÓN DEL CESAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 420,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20517',
                'city_name' => 'PAILITAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 421,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20550',
                'city_name' => 'PELAYA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 422,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20570',
                'city_name' => 'PUEBLO BELLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 423,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20614',
                'city_name' => 'RÍO DE ORO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 424,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20621',
                'city_name' => 'LA PAZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 425,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20710',
                'city_name' => 'SAN ALBERTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 426,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20750',
                'city_name' => 'SAN DIEGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 427,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20770',
                'city_name' => 'SAN MARTÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 428,
                'state_code' => '20',
                'state_name' => 'CESAR',
                'city_code' => '20787',
                'city_name' => 'TAMALAMEQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 429,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23001',
                'city_name' => 'MONTERÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 430,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23068',
                'city_name' => 'AYAPEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 431,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23079',
                'city_name' => 'BUENAVISTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 432,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23090',
                'city_name' => 'CANALETE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 433,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23162',
                'city_name' => 'CERETÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 434,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23168',
                'city_name' => 'CHIMÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 435,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23182',
                'city_name' => 'CHINÚ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 436,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23189',
                'city_name' => 'CIÉNAGA DE ORO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 437,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23300',
                'city_name' => 'COTORRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 438,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23350',
                'city_name' => 'LA APARTADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 439,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23417',
                'city_name' => 'LORICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 440,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23419',
                'city_name' => 'LOS CÓRDOBAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 441,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23464',
                'city_name' => 'MOMIL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 442,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23466',
                'city_name' => 'MONTELÍBANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 443,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23500',
                'city_name' => 'MOÑITOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 444,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23555',
                'city_name' => 'PLANETA RICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 445,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23570',
                'city_name' => 'PUEBLO NUEVO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 446,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23574',
                'city_name' => 'PUERTO ESCONDIDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 447,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23580',
                'city_name' => 'PUERTO LIBERTADOR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 448,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23586',
                'city_name' => 'PURÍSIMA DE LA CONCEPCIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 449,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23660',
                'city_name' => 'SAHAGÚN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 450,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23670',
                'city_name' => 'SAN ANDRÉS DE SOTAVENTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 451,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23672',
                'city_name' => 'SAN ANTERO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 452,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23675',
                'city_name' => 'SAN BERNARDO DEL VIENTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 453,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23678',
                'city_name' => 'SAN CARLOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 454,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23682',
                'city_name' => 'SAN JOSÉ DE URÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 455,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23686',
                'city_name' => 'SAN PELAYO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 456,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23807',
                'city_name' => 'TIERRALTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 457,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23815',
                'city_name' => 'TUCHÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 458,
                'state_code' => '23',
                'state_name' => 'CÓRDOBA',
                'city_code' => '23855',
                'city_name' => 'VALENCIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 459,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25001',
                'city_name' => 'AGUA DE DIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 460,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25019',
                'city_name' => 'ALBÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 461,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25035',
                'city_name' => 'ANAPOIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 462,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25040',
                'city_name' => 'ANOLAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 463,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25053',
                'city_name' => 'ARBELÁEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 464,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25086',
                'city_name' => 'BELTRÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 465,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25095',
                'city_name' => 'BITUIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 466,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25099',
                'city_name' => 'BOJACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 467,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25120',
                'city_name' => 'CABRERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 468,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25123',
                'city_name' => 'CACHIPAY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 469,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25126',
                'city_name' => 'CAJICÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 470,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25148',
                'city_name' => 'CAPARRAPÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 471,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25151',
                'city_name' => 'CÁQUEZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 472,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25154',
                'city_name' => 'CARMEN DE CARUPA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 473,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25168',
                'city_name' => 'CHAGUANÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 474,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25175',
                'city_name' => 'CHÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 475,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25178',
                'city_name' => 'CHIPAQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 476,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25181',
                'city_name' => 'CHOACHÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 477,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25183',
                'city_name' => 'CHOCONTÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 478,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25200',
                'city_name' => 'COGUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 479,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25214',
                'city_name' => 'COTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 480,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25224',
                'city_name' => 'CUCUNUBÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 481,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25245',
                'city_name' => 'EL COLEGIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 482,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25258',
                'city_name' => 'EL PEÑÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 483,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25260',
                'city_name' => 'EL ROSAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 484,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25269',
                'city_name' => 'FACATATIVÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 485,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25279',
                'city_name' => 'FÓMEQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 486,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25281',
                'city_name' => 'FOSCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 487,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25286',
                'city_name' => 'FUNZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 488,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25288',
                'city_name' => 'FÚQUENE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 489,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25290',
                'city_name' => 'FUSAGASUGÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 490,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25293',
                'city_name' => 'GACHALÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 491,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25295',
                'city_name' => 'GACHANCIPÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 492,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25297',
                'city_name' => 'GACHETÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 493,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25299',
                'city_name' => 'GAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 494,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25307',
                'city_name' => 'GIRARDOT',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 495,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25312',
                'city_name' => 'GRANADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 496,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25317',
                'city_name' => 'GUACHETÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 497,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25320',
                'city_name' => 'GUADUAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 498,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25322',
                'city_name' => 'GUASCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 499,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25324',
                'city_name' => 'GUATAQUÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 500,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25326',
                'city_name' => 'GUATAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 501,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25328',
                'city_name' => 'GUAYABAL DE SÍQUIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 502,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25335',
                'city_name' => 'GUAYABETAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 503,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25339',
                'city_name' => 'GUTIÉRREZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 504,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25368',
                'city_name' => 'JERUSALÉN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 505,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25372',
                'city_name' => 'JUNÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 506,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25377',
                'city_name' => 'LA CALERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 507,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25386',
                'city_name' => 'LA MESA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 508,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25394',
                'city_name' => 'LA PALMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 509,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25398',
                'city_name' => 'LA PEÑA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 510,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25402',
                'city_name' => 'LA VEGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 511,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25407',
                'city_name' => 'LENGUAZAQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 512,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25426',
                'city_name' => 'MACHETÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 513,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25430',
                'city_name' => 'MADRID',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 514,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25436',
                'city_name' => 'MANTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 515,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25438',
                'city_name' => 'MEDINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 516,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25473',
                'city_name' => 'MOSQUERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 517,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25483',
                'city_name' => 'NARIÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 518,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25486',
                'city_name' => 'NEMOCÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 519,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25488',
                'city_name' => 'NILO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 520,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25489',
                'city_name' => 'NIMAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 521,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25491',
                'city_name' => 'NOCAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 522,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25506',
                'city_name' => 'VENECIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 523,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25513',
                'city_name' => 'PACHO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 524,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25518',
                'city_name' => 'PAIME',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 525,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25524',
                'city_name' => 'PANDI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 526,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25530',
                'city_name' => 'PARATEBUENO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 527,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25535',
                'city_name' => 'PASCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 528,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25572',
                'city_name' => 'PUERTO SALGAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 529,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25580',
                'city_name' => 'PULÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 530,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25592',
                'city_name' => 'QUEBRADANEGRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 531,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25594',
                'city_name' => 'QUETAME',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 532,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25596',
                'city_name' => 'QUIPILE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 533,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25599',
                'city_name' => 'APULO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 534,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25612',
                'city_name' => 'RICAURTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 535,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25645',
                'city_name' => 'SAN ANTONIO DEL TEQUENDAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 536,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25649',
                'city_name' => 'SAN BERNARDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 537,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25653',
                'city_name' => 'SAN CAYETANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 538,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25658',
                'city_name' => 'SAN FRANCISCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 539,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25662',
                'city_name' => 'SAN JUAN DE RIOSECO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 540,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25718',
                'city_name' => 'SASAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 541,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25736',
                'city_name' => 'SESQUILÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 542,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25740',
                'city_name' => 'SIBATÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 543,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25743',
                'city_name' => 'SILVANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 544,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25745',
                'city_name' => 'SIMIJACA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 545,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25754',
                'city_name' => 'SOACHA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 546,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25758',
                'city_name' => 'SOPÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 547,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25769',
                'city_name' => 'SUBACHOQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 548,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25772',
                'city_name' => 'SUESCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 549,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25777',
                'city_name' => 'SUPATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 550,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25779',
                'city_name' => 'SUSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 551,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25781',
                'city_name' => 'SUTATAUSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 552,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25785',
                'city_name' => 'TABIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 553,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25793',
                'city_name' => 'TAUSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 554,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25797',
                'city_name' => 'TENA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 555,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25799',
                'city_name' => 'TENJO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 556,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25805',
                'city_name' => 'TIBACUY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 557,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25807',
                'city_name' => 'TIBIRITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 558,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25815',
                'city_name' => 'TOCAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 559,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25817',
                'city_name' => 'TOCANCIPÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 560,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25823',
                'city_name' => 'TOPAIPÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 561,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25839',
                'city_name' => 'UBALÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 562,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25841',
                'city_name' => 'UBAQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 563,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25843',
                'city_name' => 'VILLA DE SAN DIEGO DE UBATÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 564,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25845',
                'city_name' => 'UNE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 565,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25851',
                'city_name' => 'ÚTICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 566,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25862',
                'city_name' => 'VERGARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 567,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25867',
                'city_name' => 'VIANÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 568,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25871',
                'city_name' => 'VILLAGÓMEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 569,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25873',
                'city_name' => 'VILLAPINZÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 570,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25875',
                'city_name' => 'VILLETA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 571,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25878',
                'city_name' => 'VIOTÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 572,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25885',
                'city_name' => 'YACOPÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 573,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25898',
                'city_name' => 'ZIPACÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 574,
                'state_code' => '25',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '25899',
                'city_name' => 'ZIPAQUIRÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 575,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27001',
                'city_name' => 'QUIBDÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 576,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27006',
                'city_name' => 'ACANDÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 577,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27025',
                'city_name' => 'ALTO BAUDÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 578,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27050',
                'city_name' => 'ATRATO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 579,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27073',
                'city_name' => 'BAGADÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 580,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27075',
                'city_name' => 'BAHÍA SOLANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 581,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27077',
                'city_name' => 'BAJO BAUDÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 582,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27099',
                'city_name' => 'BOJAYÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 583,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27135',
                'city_name' => 'EL CANTÓN DEL SAN PABLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 584,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27150',
                'city_name' => 'CARMEN DEL DARIÉN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 585,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27160',
                'city_name' => 'CÉRTEGUI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 586,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27205',
                'city_name' => 'CONDOTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 587,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27245',
                'city_name' => 'EL CARMEN DE ATRATO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 588,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27250',
                'city_name' => 'EL LITORAL DEL SAN JUAN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 589,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27361',
                'city_name' => 'ISTMINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 590,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27372',
                'city_name' => 'JURADÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 591,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27413',
                'city_name' => 'LLORÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 592,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27425',
                'city_name' => 'MEDIO ATRATO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 593,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27430',
                'city_name' => 'MEDIO BAUDÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 594,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27450',
                'city_name' => 'MEDIO SAN JUAN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 595,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27491',
                'city_name' => 'NÓVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 596,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27495',
                'city_name' => 'NUQUÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 597,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27580',
                'city_name' => 'RÍO IRÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 598,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27600',
                'city_name' => 'RÍO QUITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 599,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27615',
                'city_name' => 'RIOSUCIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 600,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27660',
                'city_name' => 'SAN JOSÉ DEL PALMAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 601,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27745',
                'city_name' => 'SIPÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 602,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27787',
                'city_name' => 'TADÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 603,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27800',
                'city_name' => 'UNGUÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 604,
                'state_code' => '27',
                'state_name' => 'CHOCÓ',
                'city_code' => '27810',
                'city_name' => 'UNIÓN PANAMERICANA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 605,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41001',
                'city_name' => 'NEIVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 606,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41006',
                'city_name' => 'ACEVEDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 607,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41013',
                'city_name' => 'AGRADO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 608,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41016',
                'city_name' => 'AIPE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 609,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41020',
                'city_name' => 'ALGECIRAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 610,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41026',
                'city_name' => 'ALTAMIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 611,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41078',
                'city_name' => 'BARAYA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 612,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41132',
                'city_name' => 'CAMPOALEGRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 613,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41206',
                'city_name' => 'COLOMBIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 614,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41244',
                'city_name' => 'ELÍAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 615,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41298',
                'city_name' => 'GARZÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 616,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41306',
                'city_name' => 'GIGANTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 617,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41319',
                'city_name' => 'GUADALUPE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 618,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41349',
                'city_name' => 'HOBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 619,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41357',
                'city_name' => 'ÍQUIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 620,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41359',
                'city_name' => 'ISNOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 621,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41378',
                'city_name' => 'LA ARGENTINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 622,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41396',
                'city_name' => 'LA PLATA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 623,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41483',
                'city_name' => 'NÁTAGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 624,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41503',
                'city_name' => 'OPORAPA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 625,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41518',
                'city_name' => 'PAICOL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 626,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41524',
                'city_name' => 'PALERMO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 627,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41530',
                'city_name' => 'PALESTINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 628,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41548',
                'city_name' => 'PITAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 629,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41551',
                'city_name' => 'PITALITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 630,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41615',
                'city_name' => 'RIVERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 631,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41660',
                'city_name' => 'SALADOBLANCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 632,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41668',
                'city_name' => 'SAN AGUSTÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 633,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41676',
                'city_name' => 'SANTA MARÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 634,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41770',
                'city_name' => 'SUAZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 635,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41791',
                'city_name' => 'TARQUI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 636,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41797',
                'city_name' => 'TESALIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 637,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41799',
                'city_name' => 'TELLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 638,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41801',
                'city_name' => 'TERUEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 639,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41807',
                'city_name' => 'TIMANÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 640,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41872',
                'city_name' => 'VILLAVIEJA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 641,
                'state_code' => '41',
                'state_name' => 'HUILA',
                'city_code' => '41885',
                'city_name' => 'YAGUARÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 642,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44001',
                'city_name' => 'RIOHACHA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 643,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44035',
                'city_name' => 'ALBANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 644,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44078',
                'city_name' => 'BARRANCAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 645,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44090',
                'city_name' => 'DIBULLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 646,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44098',
                'city_name' => 'DISTRACCIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 647,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44110',
                'city_name' => 'EL MOLINO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 648,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44279',
                'city_name' => 'FONSECA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 649,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44378',
                'city_name' => 'HATONUEVO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 650,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44420',
                'city_name' => 'LA JAGUA DEL PILAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 651,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44430',
                'city_name' => 'MAICAO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 652,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44560',
                'city_name' => 'MANAURE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 653,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44650',
                'city_name' => 'SAN JUAN DEL CESAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 654,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44847',
                'city_name' => 'URIBIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 655,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44855',
                'city_name' => 'URUMITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 656,
                'state_code' => '44',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '44874',
                'city_name' => 'VILLANUEVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 657,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47001',
                'city_name' => 'SANTA MARTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 658,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47030',
                'city_name' => 'ALGARROBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 659,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47053',
                'city_name' => 'ARACATACA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 660,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47058',
                'city_name' => 'ARIGUANÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 661,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47161',
                'city_name' => 'CERRO DE SAN ANTONIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 662,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47170',
                'city_name' => 'CHIVOLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 663,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47189',
                'city_name' => 'CIÉNAGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 664,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47205',
                'city_name' => 'CONCORDIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 665,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47245',
                'city_name' => 'EL BANCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 666,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47258',
                'city_name' => 'EL PIÑÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 667,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47268',
                'city_name' => 'EL RETÉN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 668,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47288',
                'city_name' => 'FUNDACIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 669,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47318',
                'city_name' => 'GUAMAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 670,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47460',
                'city_name' => 'NUEVA GRANADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 671,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47541',
                'city_name' => 'PEDRAZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 672,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47545',
                'city_name' => 'PIJIÑO DEL CARMEN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 673,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47551',
                'city_name' => 'PIVIJAY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 674,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47555',
                'city_name' => 'PLATO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 675,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47570',
                'city_name' => 'PUEBLOVIEJO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 676,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47605',
                'city_name' => 'REMOLINO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 677,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47660',
                'city_name' => 'SABANAS DE SAN ÁNGEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 678,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47675',
                'city_name' => 'SALAMINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 679,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47692',
                'city_name' => 'SAN SEBASTIÁN DE BUENAVISTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 680,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47703',
                'city_name' => 'SAN ZENÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 681,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47707',
                'city_name' => 'SANTA ANA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 682,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47720',
                'city_name' => 'SANTA BÁRBARA DE PINTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 683,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47745',
                'city_name' => 'SITIONUEVO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 684,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47798',
                'city_name' => 'TENERIFE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 685,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47960',
                'city_name' => 'ZAPAYÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 686,
                'state_code' => '47',
                'state_name' => 'MAGDALENA',
                'city_code' => '47980',
                'city_name' => 'ZONA BANANERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 687,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50001',
                'city_name' => 'VILLAVICENCIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 688,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50006',
                'city_name' => 'ACACÍAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 689,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50110',
                'city_name' => 'BARRANCA DE UPÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 690,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50124',
                'city_name' => 'CABUYARO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 691,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50150',
                'city_name' => 'CASTILLA LA NUEVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 692,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50223',
                'city_name' => 'SAN LUIS DE CUBARRAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 693,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50226',
                'city_name' => 'CUMARAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 694,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50245',
                'city_name' => 'EL CALVARIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 695,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50251',
                'city_name' => 'EL CASTILLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 696,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50270',
                'city_name' => 'EL DORADO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 697,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50287',
                'city_name' => 'FUENTE DE ORO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 698,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50313',
                'city_name' => 'GRANADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 699,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50318',
                'city_name' => 'GUAMAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 700,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50325',
                'city_name' => 'MAPIRIPÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 701,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50330',
                'city_name' => 'MESETAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 702,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50350',
                'city_name' => 'LA MACARENA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 703,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50370',
                'city_name' => 'URIBE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 704,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50400',
                'city_name' => 'LEJANÍAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 705,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50450',
                'city_name' => 'PUERTO CONCORDIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 706,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50568',
                'city_name' => 'PUERTO GAITÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 707,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50573',
                'city_name' => 'PUERTO LÓPEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 708,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50577',
                'city_name' => 'PUERTO LLERAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 709,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50590',
                'city_name' => 'PUERTO RICO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 710,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50606',
                'city_name' => 'RESTREPO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 711,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50680',
                'city_name' => 'SAN CARLOS DE GUAROA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 712,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50683',
                'city_name' => 'SAN JUAN DE ARAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 713,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50686',
                'city_name' => 'SAN JUANITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 714,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50689',
                'city_name' => 'SAN MARTÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 715,
                'state_code' => '50',
                'state_name' => 'META',
                'city_code' => '50711',
                'city_name' => 'VISTAHERMOSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 716,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52001',
                'city_name' => 'PASTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 717,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52019',
                'city_name' => 'ALBÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 718,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52022',
                'city_name' => 'ALDANA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 719,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52036',
                'city_name' => 'ANCUYÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 720,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52051',
                'city_name' => 'ARBOLEDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 721,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52079',
                'city_name' => 'BARBACOAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 722,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52083',
                'city_name' => 'BELÉN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 723,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52110',
                'city_name' => 'BUESACO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 724,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52203',
                'city_name' => 'COLÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 725,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52207',
                'city_name' => 'CONSACÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 726,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52210',
                'city_name' => 'CONTADERO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 727,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52215',
                'city_name' => 'CÓRDOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 728,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52224',
                'city_name' => 'CUASPÚD',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 729,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52227',
                'city_name' => 'CUMBAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 730,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52233',
                'city_name' => 'CUMBITARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 731,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52240',
                'city_name' => 'CHACHAGÜÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 732,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52250',
                'city_name' => 'EL CHARCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 733,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52254',
                'city_name' => 'EL PEÑOL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 734,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52256',
                'city_name' => 'EL ROSARIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 735,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52258',
                'city_name' => 'EL TABLÓN DE GÓMEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 736,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52260',
                'city_name' => 'EL TAMBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 737,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52287',
                'city_name' => 'FUNES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 738,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52317',
                'city_name' => 'GUACHUCAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 739,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52320',
                'city_name' => 'GUAITARILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 740,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52323',
                'city_name' => 'GUALMATÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 741,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52352',
                'city_name' => 'ILES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 742,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52354',
                'city_name' => 'IMUÉS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 743,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52356',
                'city_name' => 'IPIALES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 744,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52378',
                'city_name' => 'LA CRUZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 745,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52381',
                'city_name' => 'LA FLORIDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 746,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52385',
                'city_name' => 'LA LLANADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 747,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52390',
                'city_name' => 'LA TOLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 748,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52399',
                'city_name' => 'LA UNIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 749,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52405',
                'city_name' => 'LEIVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 750,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52411',
                'city_name' => 'LINARES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 751,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52418',
                'city_name' => 'LOS ANDES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 752,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52427',
                'city_name' => 'MAGÜÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 753,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52435',
                'city_name' => 'MALLAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 754,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52473',
                'city_name' => 'MOSQUERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 755,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52480',
                'city_name' => 'NARIÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 756,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52490',
                'city_name' => 'OLAYA HERRERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 757,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52506',
                'city_name' => 'OSPINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 758,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52520',
                'city_name' => 'FRANCISCO PIZARRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 759,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52540',
                'city_name' => 'POLICARPA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 760,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52560',
                'city_name' => 'POTOSÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 761,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52565',
                'city_name' => 'PROVIDENCIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 762,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52573',
                'city_name' => 'PUERRES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 763,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52585',
                'city_name' => 'PUPIALES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 764,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52612',
                'city_name' => 'RICAURTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 765,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52621',
                'city_name' => 'ROBERTO PAYÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 766,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52678',
                'city_name' => 'SAMANIEGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 767,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52683',
                'city_name' => 'SANDONÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 768,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52685',
                'city_name' => 'SAN BERNARDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 769,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52687',
                'city_name' => 'SAN LORENZO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 770,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52693',
                'city_name' => 'SAN PABLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 771,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52694',
                'city_name' => 'SAN PEDRO DE CARTAGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 772,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52696',
                'city_name' => 'SANTA BÁRBARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 773,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52699',
                'city_name' => 'SANTACRUZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 774,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52720',
                'city_name' => 'SAPUYES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 775,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52786',
                'city_name' => 'TAMINANGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 776,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52788',
                'city_name' => 'TANGUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 777,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52835',
                'city_name' => 'SAN ANDRÉS DE TUMACO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 778,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52838',
                'city_name' => 'TÚQUERRES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 779,
                'state_code' => '52',
                'state_name' => 'NARIÑO',
                'city_code' => '52885',
                'city_name' => 'YACUANQUER',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 780,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54001',
                'city_name' => 'CÚCUTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 781,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54003',
                'city_name' => 'ÁBREGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 782,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54051',
                'city_name' => 'ARBOLEDAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 783,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54099',
                'city_name' => 'BOCHALEMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 784,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54109',
                'city_name' => 'BUCARASICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 785,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54125',
                'city_name' => 'CÁCOTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 786,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54128',
                'city_name' => 'CÁCHIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 787,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54172',
                'city_name' => 'CHINÁCOTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 788,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54174',
                'city_name' => 'CHITAGÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 789,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54206',
                'city_name' => 'CONVENCIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 790,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54223',
                'city_name' => 'CUCUTILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 791,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54239',
                'city_name' => 'DURANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 792,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54245',
                'city_name' => 'EL CARMEN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 793,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54250',
                'city_name' => 'EL TARRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 794,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54261',
                'city_name' => 'EL ZULIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 795,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54313',
                'city_name' => 'GRAMALOTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 796,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54344',
                'city_name' => 'HACARÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 797,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54347',
                'city_name' => 'HERRÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 798,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54377',
                'city_name' => 'LABATECA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 799,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54385',
                'city_name' => 'LA ESPERANZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 800,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54398',
                'city_name' => 'LA PLAYA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 801,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54405',
                'city_name' => 'LOS PATIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 802,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54418',
                'city_name' => 'LOURDES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 803,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54480',
                'city_name' => 'MUTISCUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 804,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54498',
                'city_name' => 'OCAÑA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 805,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54518',
                'city_name' => 'PAMPLONA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 806,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54520',
                'city_name' => 'PAMPLONITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 807,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54553',
                'city_name' => 'PUERTO SANTANDER',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 808,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54599',
                'city_name' => 'RAGONVALIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 809,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54660',
                'city_name' => 'SALAZAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 810,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54670',
                'city_name' => 'SAN CALIXTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 811,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54673',
                'city_name' => 'SAN CAYETANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 812,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54680',
                'city_name' => 'SANTIAGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 813,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54720',
                'city_name' => 'SARDINATA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 814,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54743',
                'city_name' => 'SILOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 815,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54800',
                'city_name' => 'TEORAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 816,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54810',
                'city_name' => 'TIBÚ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 817,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54820',
                'city_name' => 'TOLEDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 818,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54871',
                'city_name' => 'VILLA CARO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 819,
                'state_code' => '54',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '54874',
                'city_name' => 'VILLA DEL ROSARIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 820,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63001',
                'city_name' => 'ARMENIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 821,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63111',
                'city_name' => 'BUENAVISTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 822,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63130',
                'city_name' => 'CALARCÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 823,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63190',
                'city_name' => 'CIRCASIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 824,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63212',
                'city_name' => 'CÓRDOBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 825,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63272',
                'city_name' => 'FILANDIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 826,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63302',
                'city_name' => 'GÉNOVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 827,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63401',
                'city_name' => 'LA TEBAIDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 828,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63470',
                'city_name' => 'MONTENEGRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 829,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63548',
                'city_name' => 'PIJAO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 830,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63594',
                'city_name' => 'QUIMBAYA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 831,
                'state_code' => '63',
                'state_name' => 'QUINDIO',
                'city_code' => '63690',
                'city_name' => 'SALENTO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDIO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 832,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66001',
                'city_name' => 'PEREIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 833,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66045',
                'city_name' => 'APÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 834,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66075',
                'city_name' => 'BALBOA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 835,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66088',
                'city_name' => 'BELÉN DE UMBRÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 836,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66170',
                'city_name' => 'DOSQUEBRADAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 837,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66318',
                'city_name' => 'GUÁTICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 838,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66383',
                'city_name' => 'LA CELIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 839,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66400',
                'city_name' => 'LA VIRGINIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 840,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66440',
                'city_name' => 'MARSELLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 841,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66456',
                'city_name' => 'MISTRATÓ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 842,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66572',
                'city_name' => 'PUEBLO RICO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 843,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66594',
                'city_name' => 'QUINCHÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 844,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66682',
                'city_name' => 'SANTA ROSA DE CABAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 845,
                'state_code' => '66',
                'state_name' => 'RISARALDA',
                'city_code' => '66687',
                'city_name' => 'SANTUARIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 846,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68001',
                'city_name' => 'BUCARAMANGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 847,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68013',
                'city_name' => 'AGUADA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 848,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68020',
                'city_name' => 'ALBANIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 849,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68051',
                'city_name' => 'ARATOCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 850,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68077',
                'city_name' => 'BARBOSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 851,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68079',
                'city_name' => 'BARICHARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 852,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68081',
                'city_name' => 'BARRANCABERMEJA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 853,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68092',
                'city_name' => 'BETULIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 854,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68101',
                'city_name' => 'BOLÍVAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 855,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68121',
                'city_name' => 'CABRERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 856,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68132',
                'city_name' => 'CALIFORNIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 857,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68147',
                'city_name' => 'CAPITANEJO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 858,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68152',
                'city_name' => 'CARCASÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 859,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68160',
                'city_name' => 'CEPITÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 860,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68162',
                'city_name' => 'CERRITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 861,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68167',
                'city_name' => 'CHARALÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 862,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68169',
                'city_name' => 'CHARTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 863,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68176',
                'city_name' => 'CHIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 864,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68179',
                'city_name' => 'CHIPATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 865,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68190',
                'city_name' => 'CIMITARRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 866,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68207',
                'city_name' => 'CONCEPCIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 867,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68209',
                'city_name' => 'CONFINES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 868,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68211',
                'city_name' => 'CONTRATACIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 869,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68217',
                'city_name' => 'COROMORO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 870,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68229',
                'city_name' => 'CURITÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 871,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68235',
                'city_name' => 'EL CARMEN DE CHUCURÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 872,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68245',
                'city_name' => 'EL GUACAMAYO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 873,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68250',
                'city_name' => 'EL PEÑÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 874,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68255',
                'city_name' => 'EL PLAYÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 875,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68264',
                'city_name' => 'ENCINO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 876,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68266',
                'city_name' => 'ENCISO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 877,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68271',
                'city_name' => 'FLORIÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 878,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68276',
                'city_name' => 'FLORIDABLANCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 879,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68296',
                'city_name' => 'GALÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 880,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68298',
                'city_name' => 'GÁMBITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 881,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68307',
                'city_name' => 'GIRÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 882,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68318',
                'city_name' => 'GUACA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 883,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68320',
                'city_name' => 'GUADALUPE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 884,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68322',
                'city_name' => 'GUAPOTÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 885,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68324',
                'city_name' => 'GUAVATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 886,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68327',
                'city_name' => 'GÜEPSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 887,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68344',
                'city_name' => 'HATO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 888,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68368',
                'city_name' => 'JESÚS MARÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 889,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68370',
                'city_name' => 'JORDÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 890,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68377',
                'city_name' => 'LA BELLEZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 891,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68385',
                'city_name' => 'LANDÁZURI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 892,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68397',
                'city_name' => 'LA PAZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 893,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68406',
                'city_name' => 'LEBRIJA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 894,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68418',
                'city_name' => 'LOS SANTOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 895,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68425',
                'city_name' => 'MACARAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 896,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68432',
                'city_name' => 'MÁLAGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 897,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68444',
                'city_name' => 'MATANZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 898,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68464',
                'city_name' => 'MOGOTES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 899,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68468',
                'city_name' => 'MOLAGAVITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 900,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68498',
                'city_name' => 'OCAMONTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 901,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68500',
                'city_name' => 'OIBA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 902,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68502',
                'city_name' => 'ONZAGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 903,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68522',
                'city_name' => 'PALMAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 904,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68524',
                'city_name' => 'PALMAS DEL SOCORRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 905,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68533',
                'city_name' => 'PÁRAMO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 906,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68547',
                'city_name' => 'PIEDECUESTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 907,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68549',
                'city_name' => 'PINCHOTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 908,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68572',
                'city_name' => 'PUENTE NACIONAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 909,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68573',
                'city_name' => 'PUERTO PARRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 910,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68575',
                'city_name' => 'PUERTO WILCHES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 911,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68615',
                'city_name' => 'RIONEGRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 912,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68655',
                'city_name' => 'SABANA DE TORRES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 913,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68669',
                'city_name' => 'SAN ANDRÉS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 914,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68673',
                'city_name' => 'SAN BENITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 915,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68679',
                'city_name' => 'SAN GIL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 916,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68682',
                'city_name' => 'SAN JOAQUÍN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 917,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68684',
                'city_name' => 'SAN JOSÉ DE MIRANDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 918,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68686',
                'city_name' => 'SAN MIGUEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 919,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68689',
                'city_name' => 'SAN VICENTE DE CHUCURÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 920,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68705',
                'city_name' => 'SANTA BÁRBARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 921,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68720',
                'city_name' => 'SANTA HELENA DEL OPÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 922,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68745',
                'city_name' => 'SIMACOTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 923,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68755',
                'city_name' => 'SOCORRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 924,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68770',
                'city_name' => 'SUAITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 925,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68773',
                'city_name' => 'SUCRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 926,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68780',
                'city_name' => 'SURATÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 927,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68820',
                'city_name' => 'TONA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 928,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68855',
                'city_name' => 'VALLE DE SAN JOSÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 929,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68861',
                'city_name' => 'VÉLEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 930,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68867',
                'city_name' => 'VETAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 931,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68872',
                'city_name' => 'VILLANUEVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 932,
                'state_code' => '68',
                'state_name' => 'SANTANDER',
                'city_code' => '68895',
                'city_name' => 'ZAPATOCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 933,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70001',
                'city_name' => 'SINCELEJO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 934,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70110',
                'city_name' => 'BUENAVISTA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 935,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70124',
                'city_name' => 'CAIMITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 936,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70204',
                'city_name' => 'COLOSO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 937,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70215',
                'city_name' => 'COROZAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 938,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70221',
                'city_name' => 'COVEÑAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 939,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70230',
                'city_name' => 'CHALÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 940,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70233',
                'city_name' => 'EL ROBLE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 941,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70235',
                'city_name' => 'GALERAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 942,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70265',
                'city_name' => 'GUARANDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 943,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70400',
                'city_name' => 'LA UNIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 944,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70418',
                'city_name' => 'LOS PALMITOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 945,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70429',
                'city_name' => 'MAJAGUAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 946,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70473',
                'city_name' => 'MORROA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 947,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70508',
                'city_name' => 'OVEJAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 948,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70523',
                'city_name' => 'PALMITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 949,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70670',
                'city_name' => 'SAMPUÉS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 950,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70678',
                'city_name' => 'SAN BENITO ABAD',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 951,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70702',
                'city_name' => 'SAN JUAN DE BETULIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 952,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70708',
                'city_name' => 'SAN MARCOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 953,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70713',
                'city_name' => 'SAN ONOFRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 954,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70717',
                'city_name' => 'SAN PEDRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 955,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70742',
                'city_name' => 'SAN LUIS DE SINCÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 956,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70771',
                'city_name' => 'SUCRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 957,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70820',
                'city_name' => 'SANTIAGO DE TOLÚ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 958,
                'state_code' => '70',
                'state_name' => 'SUCRE',
                'city_code' => '70823',
                'city_name' => 'TOLÚ VIEJO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 959,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73001',
                'city_name' => 'IBAGUÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 960,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73024',
                'city_name' => 'ALPUJARRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 961,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73026',
                'city_name' => 'ALVARADO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 962,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73030',
                'city_name' => 'AMBALEMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 963,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73043',
                'city_name' => 'ANZOÁTEGUI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 964,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73055',
                'city_name' => 'ARMERO GUAYABAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 965,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73067',
                'city_name' => 'ATACO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 966,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73124',
                'city_name' => 'CAJAMARCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 967,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73148',
                'city_name' => 'CARMEN DE APICALÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 968,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73152',
                'city_name' => 'CASABIANCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 969,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73168',
                'city_name' => 'CHAPARRAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 970,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73200',
                'city_name' => 'COELLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 971,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73217',
                'city_name' => 'COYAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 972,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73226',
                'city_name' => 'CUNDAY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 973,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73236',
                'city_name' => 'DOLORES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 974,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73268',
                'city_name' => 'ESPINAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 975,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73270',
                'city_name' => 'FALAN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 976,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73275',
                'city_name' => 'FLANDES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 977,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73283',
                'city_name' => 'FRESNO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 978,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73319',
                'city_name' => 'GUAMO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 979,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73347',
                'city_name' => 'HERVEO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 980,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73349',
                'city_name' => 'HONDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 981,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73352',
                'city_name' => 'ICONONZO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 982,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73408',
                'city_name' => 'LÉRIDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 983,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73411',
                'city_name' => 'LÍBANO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 984,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73443',
                'city_name' => 'SAN SEBASTIÁN DE MARIQUITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 985,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73449',
                'city_name' => 'MELGAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 986,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73461',
                'city_name' => 'MURILLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 987,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73483',
                'city_name' => 'NATAGAIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 988,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73504',
                'city_name' => 'ORTEGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 989,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73520',
                'city_name' => 'PALOCABILDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 990,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73547',
                'city_name' => 'PIEDRAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 991,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73555',
                'city_name' => 'PLANADAS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 992,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73563',
                'city_name' => 'PRADO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 993,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73585',
                'city_name' => 'PURIFICACIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 994,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73616',
                'city_name' => 'RIOBLANCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 995,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73622',
                'city_name' => 'RONCESVALLES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 996,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73624',
                'city_name' => 'ROVIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 997,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73671',
                'city_name' => 'SALDAÑA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 998,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73675',
                'city_name' => 'SAN ANTONIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 999,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73678',
                'city_name' => 'SAN LUIS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1000,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73686',
                'city_name' => 'SANTA ISABEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1001,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73770',
                'city_name' => 'SUÁREZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1002,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73854',
                'city_name' => 'VALLE DE SAN JUAN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1003,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73861',
                'city_name' => 'VENADILLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1004,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73870',
                'city_name' => 'VILLAHERMOSA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1005,
                'state_code' => '73',
                'state_name' => 'TOLIMA',
                'city_code' => '73873',
                'city_name' => 'VILLARRICA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1006,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76001',
                'city_name' => 'CALI',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1007,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76020',
                'city_name' => 'ALCALÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1008,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76036',
                'city_name' => 'ANDALUCÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1009,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76041',
                'city_name' => 'ANSERMANUEVO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1010,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76054',
                'city_name' => 'ARGELIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1011,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76100',
                'city_name' => 'BOLÍVAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1012,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76109',
                'city_name' => 'BUENAVENTURA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1013,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76111',
                'city_name' => 'GUADALAJARA DE BUGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1014,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76113',
                'city_name' => 'BUGALAGRANDE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1015,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76122',
                'city_name' => 'CAICEDONIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1016,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76126',
                'city_name' => 'CALIMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1017,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76130',
                'city_name' => 'CANDELARIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1018,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76147',
                'city_name' => 'CARTAGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1019,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76233',
                'city_name' => 'DAGUA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1020,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76243',
                'city_name' => 'EL ÁGUILA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1021,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76246',
                'city_name' => 'EL CAIRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1022,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76248',
                'city_name' => 'EL CERRITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1023,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76250',
                'city_name' => 'EL DOVIO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1024,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76275',
                'city_name' => 'FLORIDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1025,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76306',
                'city_name' => 'GINEBRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1026,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76318',
                'city_name' => 'GUACARÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1027,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76364',
                'city_name' => 'JAMUNDÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1028,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76377',
                'city_name' => 'LA CUMBRE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1029,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76400',
                'city_name' => 'LA UNIÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1030,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76403',
                'city_name' => 'LA VICTORIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1031,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76497',
                'city_name' => 'OBANDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1032,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76520',
                'city_name' => 'PALMIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1033,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76563',
                'city_name' => 'PRADERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1034,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76606',
                'city_name' => 'RESTREPO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1035,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76616',
                'city_name' => 'RIOFRÍO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1036,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76622',
                'city_name' => 'ROLDANILLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1037,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76670',
                'city_name' => 'SAN PEDRO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1038,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76736',
                'city_name' => 'SEVILLA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1039,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76823',
                'city_name' => 'TORO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1040,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76828',
                'city_name' => 'TRUJILLO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1041,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76834',
                'city_name' => 'TULUÁ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1042,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76845',
                'city_name' => 'ULLOA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1043,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76863',
                'city_name' => 'VERSALLES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1044,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76869',
                'city_name' => 'VIJES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1045,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76890',
                'city_name' => 'YOTOCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1046,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76892',
                'city_name' => 'YUMBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1047,
                'state_code' => '76',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '76895',
                'city_name' => 'ZARZAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1048,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81001',
                'city_name' => 'ARAUCA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1049,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81065',
                'city_name' => 'ARAUQUITA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1050,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81220',
                'city_name' => 'CRAVO NORTE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1051,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81300',
                'city_name' => 'FORTUL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1052,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81591',
                'city_name' => 'PUERTO RONDÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1053,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81736',
                'city_name' => 'SARAVENA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1054,
                'state_code' => '81',
                'state_name' => 'ARAUCA',
                'city_code' => '81794',
                'city_name' => 'TAME',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1055,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85001',
                'city_name' => 'YOPAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1056,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85010',
                'city_name' => 'AGUAZUL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1057,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85015',
                'city_name' => 'CHÁMEZA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1058,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85125',
                'city_name' => 'HATO COROZAL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1059,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85136',
                'city_name' => 'LA SALINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1060,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85139',
                'city_name' => 'MANÍ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1061,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85162',
                'city_name' => 'MONTERREY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1062,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85225',
                'city_name' => 'NUNCHÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1063,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85230',
                'city_name' => 'OROCUÉ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1064,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85250',
                'city_name' => 'PAZ DE ARIPORO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1065,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85263',
                'city_name' => 'PORE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1066,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85279',
                'city_name' => 'RECETOR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1067,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85300',
                'city_name' => 'SABANALARGA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1068,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85315',
                'city_name' => 'SÁCAMA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1069,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85325',
                'city_name' => 'SAN LUIS DE PALENQUE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1070,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85400',
                'city_name' => 'TÁMARA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1071,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85410',
                'city_name' => 'TAURAMENA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1072,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85430',
                'city_name' => 'TRINIDAD',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1073,
                'state_code' => '85',
                'state_name' => 'CASANARE',
                'city_code' => '85440',
                'city_name' => 'VILLANUEVA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1074,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86001',
                'city_name' => 'MOCOA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1075,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86219',
                'city_name' => 'COLÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1076,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86320',
                'city_name' => 'ORITO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1077,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86568',
                'city_name' => 'PUERTO ASÍS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1078,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86569',
                'city_name' => 'PUERTO CAICEDO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1079,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86571',
                'city_name' => 'PUERTO GUZMÁN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1080,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86573',
                'city_name' => 'PUERTO LEGUÍZAMO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1081,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86749',
                'city_name' => 'SIBUNDOY',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1082,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86755',
                'city_name' => 'SAN FRANCISCO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1083,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86757',
                'city_name' => 'SAN MIGUEL',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1084,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86760',
                'city_name' => 'SANTIAGO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1085,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86865',
                'city_name' => 'VALLE DEL GUAMUEZ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1086,
                'state_code' => '86',
                'state_name' => 'PUTUMAYO',
                'city_code' => '86885',
                'city_name' => 'VILLAGARZÓN',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1087,
                'state_code' => '88',
                'state_name' => 'SAN ANDRÉS Y PROVIDENCIA',
                'city_code' => '88001',
                'city_name' => 'SAN ANDRÉS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SAN ANDRÉS Y PROVIDENCIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1088,
                'state_code' => '88',
                'state_name' => 'SAN ANDRÉS Y PROVIDENCIA',
                'city_code' => '88564',
                'city_name' => 'PROVIDENCIA Y SANTA CATALINA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SAN ANDRÉS Y PROVIDENCIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1089,
                'state_code' => '91',
                'state_name' => 'AMAZONAS',
                'city_code' => '91001',
                'city_name' => 'LETICIA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'AMAZONAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1090,
                'state_code' => '91',
                'state_name' => 'AMAZONAS',
                'city_code' => '91540',
                'city_name' => 'PUERTO NARIÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'AMAZONAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1091,
                'state_code' => '94',
                'state_name' => 'GUAINÍA',
                'city_code' => '94001',
                'city_name' => 'INÍRIDA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAINÍA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1092,
                'state_code' => '95',
                'state_name' => 'GUAVIARE',
                'city_code' => '95001',
                'city_name' => 'SAN JOSÉ DEL GUAVIARE',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAVIARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1093,
                'state_code' => '95',
                'state_name' => 'GUAVIARE',
                'city_code' => '95015',
                'city_name' => 'CALAMAR',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAVIARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1094,
                'state_code' => '95',
                'state_name' => 'GUAVIARE',
                'city_code' => '95025',
                'city_name' => 'EL RETORNO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAVIARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1095,
                'state_code' => '95',
                'state_name' => 'GUAVIARE',
                'city_code' => '95200',
                'city_name' => 'MIRAFLORES',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAVIARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1096,
                'state_code' => '97',
                'state_name' => 'VAUPÉS',
                'city_code' => '97001',
                'city_name' => 'MITÚ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VAUPÉS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1097,
                'state_code' => '97',
                'state_name' => 'VAUPÉS',
                'city_code' => '97161',
                'city_name' => 'CARURÚ',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VAUPÉS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1098,
                'state_code' => '97',
                'state_name' => 'VAUPÉS',
                'city_code' => '97666',
                'city_name' => 'TARAIRA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VAUPÉS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1099,
                'state_code' => '99',
                'state_name' => 'VICHADA',
                'city_code' => '99001',
                'city_name' => 'PUERTO CARREÑO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VICHADA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1100,
                'state_code' => '99',
                'state_name' => 'VICHADA',
                'city_code' => '99524',
                'city_name' => 'LA PRIMAVERA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VICHADA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1101,
                'state_code' => '99',
                'state_name' => 'VICHADA',
                'city_code' => '99624',
                'city_name' => 'SANTA ROSALÍA',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VICHADA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1102,
                'state_code' => '99',
                'state_name' => 'VICHADA',
                'city_code' => '99773',
                'city_name' => 'CUMARIBO',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VICHADA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1103,
                'state_code' => '0',
                'state_name' => 'AMAZONAS',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'AMAZONAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1104,
                'state_code' => '0',
                'state_name' => 'ANTIOQUIA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ANTIOQUIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1105,
                'state_code' => '0',
                'state_name' => 'ARAUCA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ARAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1106,
                'state_code' => '0',
                'state_name' => 'ATLÁNTICO',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'ATLÁNTICO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            Municipality::create([
                'id' => 1107,
                'state_code' => '0',
                'state_name' => 'BOLÍVAR',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOLÍVAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1108,
                'state_code' => '0',
                'state_name' => 'BOYACÁ',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'BOYACÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1109,
                'state_code' => '0',
                'state_name' => 'CALDAS',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CALDAS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1110,
                'state_code' => '0',
                'state_name' => 'CAQUETÁ',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAQUETÁ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1111,
                'state_code' => '0',
                'state_name' => 'CASANARE',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CASANARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1112,
                'state_code' => '0',
                'state_name' => 'CAUCA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1113,
                'state_code' => '0',
                'state_name' => 'CESAR',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CESAR')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1114,
                'state_code' => '0',
                'state_name' => 'CHOCÓ',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CHOCÓ')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1115,
                'state_code' => '0',
                'state_name' => 'CÓRDOBA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CÓRDOBA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1116,
                'state_code' => '0',
                'state_name' => 'CUNDINAMARCA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'CUNDINAMARCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1117,
                'state_code' => '0',
                'state_name' => 'GUAINÍA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAINÍA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1118,
                'state_code' => '0',
                'state_name' => 'GUAVIARE',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'GUAVIARE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1119,
                'state_code' => '0',
                'state_name' => 'HUILA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'HUILA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1120,
                'state_code' => '0',
                'state_name' => 'LA GUAJIRA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'LA GUAJIRA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1121,
                'state_code' => '0',
                'state_name' => 'MAGDALENA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'MAGDALENA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1122,
                'state_code' => '0',
                'state_name' => 'META',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'META')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1123,
                'state_code' => '0',
                'state_name' => 'NARIÑO',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NARIÑO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1124,
                'state_code' => '0',
                'state_name' => 'NORTE DE SANTANDER',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'NORTE DE SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1125,
                'state_code' => '0',
                'state_name' => 'PUTUMAYO',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'PUTUMAYO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1126,
                'state_code' => '0',
                'state_name' => 'QUINDÍO',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'QUINDÍO')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1127,
                'state_code' => '0',
                'state_name' => 'RISARALDA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'RISARALDA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1128,
                'state_code' => '0',
                'state_name' => 'SAN ANDRÉS Y PROVIDENCIA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SAN ANDRÉS Y PROVIDENCIA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1129,
                'state_code' => '0',
                'state_name' => 'SANTANDER',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SANTANDER')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1130,
                'state_code' => '0',
                'state_name' => 'SUCRE',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'SUCRE')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1131,
                'state_code' => '0',
                'state_name' => 'TOLIMA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'TOLIMA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1132,
                'state_code' => '0',
                'state_name' => 'VALLE DEL CAUCA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VALLE DEL CAUCA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1133,
                'state_code' => '0',
                'state_name' => 'VAUPÉS',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VAUPÉS')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Municipality::create([
                'id' => 1134,
                'state_code' => '0',
                'state_name' => 'VICHADA',
                'city_code' => '0',
                'city_name' => 'TODOS LOS MUNICIPIOS',
                'active' => true,
                'delegation_id' => Delegation::where('name', 'VICHADA')->value('id'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        } catch (\Exception $exception) {
            Log::error("(MunicipalitySeeder - run) ERROR => " . $exception->getMessage());
        }
    }
}
