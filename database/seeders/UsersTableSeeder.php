<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'personal_id'       => '1069766258',
                'first_name'        => 'HANS',
                'second_name'       => 'YADIEL',
                'first_last_name'   => 'SÁNCHEZ',
                'second_last_name'  => 'MORA',
                'email'             => 'admin@admin.com',
                'phone_number'      => '3126248950',
                'position'          => 'ADMINISTRADOR',
                'password'          => bcrypt('@990305Hans#.'),
                'remember_token'    => Str::random(60),
                'role_id'           => $role->id,
            ]);
        }
    }
}
