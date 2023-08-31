<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => "Administrador",
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'user']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => "Usuario normal",
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'reporter']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => "Reportador",
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'validator']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => "Validador",
            ])->save();
        }

        $role = Role::firstOrNew(['name' => 'central_user']);
        if (!$role->exists) {
            $role->fill([
                'display_name' => "Usuario Central",
            ])->save();
        }
    }
}
