<?php

namespace Database\Seeders;

use App\Models\Headquarter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
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
                $role = Role::where('name', 'admin')->firstOrFail();

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
                    'email'             => 'hanssanchez427@gmail.com',
                    'phone_number'      => '3126248950',
                    'position'          => 'ADMINISTRADOR',
                    'password'          => bcrypt('@990305Hans#.'),
                    'remember_token'    => Str::random(60),
                    'role_id'           => $role->id,
                    'delegation_id'     => 5, // BOGOTÁ
                    'municipality_id'   => 149, // BOGOTÁ
                    'headquarter_id'    => 1 // SEDE CENTRAL
                ]);

                $headquarter->update([
                    'id' => 1,
                    'user_id' => 1
                ]);
            }
        } catch (\Exception $exception) {
            Log::error("(UsersTableSeeder - run) ERROR => " . $exception->getMessage());
        }
    }
}
