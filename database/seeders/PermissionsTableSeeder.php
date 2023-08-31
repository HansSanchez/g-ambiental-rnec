<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        DB::table('permissions')->delete();
        
        DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'browse_admin',
                'table_name' => NULL,
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'browse_bread',
                'table_name' => NULL,
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'browse_database',
                'table_name' => NULL,
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'browse_media',
                'table_name' => NULL,
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'browse_compass',
                'table_name' => NULL,
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'browse_menus',
                'table_name' => 'menus',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'read_menus',
                'table_name' => 'menus',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'edit_menus',
                'table_name' => 'menus',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'add_menus',
                'table_name' => 'menus',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'delete_menus',
                'table_name' => 'menus',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'browse_roles',
                'table_name' => 'roles',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'read_roles',
                'table_name' => 'roles',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'edit_roles',
                'table_name' => 'roles',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'add_roles',
                'table_name' => 'roles',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'delete_roles',
                'table_name' => 'roles',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'browse_users',
                'table_name' => 'users',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'read_users',
                'table_name' => 'users',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            17 => 
            array (
                'id' => 18,
                'key' => 'edit_users',
                'table_name' => 'users',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            18 => 
            array (
                'id' => 19,
                'key' => 'add_users',
                'table_name' => 'users',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            19 => 
            array (
                'id' => 20,
                'key' => 'delete_users',
                'table_name' => 'users',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            20 => 
            array (
                'id' => 21,
                'key' => 'browse_settings',
                'table_name' => 'settings',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            21 => 
            array (
                'id' => 22,
                'key' => 'read_settings',
                'table_name' => 'settings',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            22 => 
            array (
                'id' => 23,
                'key' => 'edit_settings',
                'table_name' => 'settings',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            23 => 
            array (
                'id' => 24,
                'key' => 'add_settings',
                'table_name' => 'settings',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            24 => 
            array (
                'id' => 25,
                'key' => 'delete_settings',
                'table_name' => 'settings',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            25 => 
            array (
                'id' => 26,
                'key' => 'browse_categories',
                'table_name' => 'categories',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            26 => 
            array (
                'id' => 27,
                'key' => 'read_categories',
                'table_name' => 'categories',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            27 => 
            array (
                'id' => 28,
                'key' => 'edit_categories',
                'table_name' => 'categories',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            28 => 
            array (
                'id' => 29,
                'key' => 'add_categories',
                'table_name' => 'categories',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            29 => 
            array (
                'id' => 30,
                'key' => 'delete_categories',
                'table_name' => 'categories',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            30 => 
            array (
                'id' => 31,
                'key' => 'browse_posts',
                'table_name' => 'posts',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            31 => 
            array (
                'id' => 32,
                'key' => 'read_posts',
                'table_name' => 'posts',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            32 => 
            array (
                'id' => 33,
                'key' => 'edit_posts',
                'table_name' => 'posts',
                'created_at' => '2023-08-24 16:48:57',
                'updated_at' => '2023-08-24 16:48:57',
            ),
            33 => 
            array (
                'id' => 34,
                'key' => 'add_posts',
                'table_name' => 'posts',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            34 => 
            array (
                'id' => 35,
                'key' => 'delete_posts',
                'table_name' => 'posts',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            35 => 
            array (
                'id' => 36,
                'key' => 'browse_pages',
                'table_name' => 'pages',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            36 => 
            array (
                'id' => 37,
                'key' => 'read_pages',
                'table_name' => 'pages',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            37 => 
            array (
                'id' => 38,
                'key' => 'edit_pages',
                'table_name' => 'pages',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            38 => 
            array (
                'id' => 39,
                'key' => 'add_pages',
                'table_name' => 'pages',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            39 => 
            array (
                'id' => 40,
                'key' => 'delete_pages',
                'table_name' => 'pages',
                'created_at' => '2023-08-24 16:48:58',
                'updated_at' => '2023-08-24 16:48:58',
            ),
            40 => 
            array (
                'id' => 41,
                'key' => 'browse_headquarters',
                'table_name' => 'headquarters',
                'created_at' => '2023-08-25 10:21:32',
                'updated_at' => '2023-08-25 10:21:32',
            ),
            41 => 
            array (
                'id' => 42,
                'key' => 'read_headquarters',
                'table_name' => 'headquarters',
                'created_at' => '2023-08-25 10:21:32',
                'updated_at' => '2023-08-25 10:21:32',
            ),
            42 => 
            array (
                'id' => 43,
                'key' => 'edit_headquarters',
                'table_name' => 'headquarters',
                'created_at' => '2023-08-25 10:21:32',
                'updated_at' => '2023-08-25 10:21:32',
            ),
            43 => 
            array (
                'id' => 44,
                'key' => 'add_headquarters',
                'table_name' => 'headquarters',
                'created_at' => '2023-08-25 10:21:32',
                'updated_at' => '2023-08-25 10:21:32',
            ),
            44 => 
            array (
                'id' => 45,
                'key' => 'delete_headquarters',
                'table_name' => 'headquarters',
                'created_at' => '2023-08-25 10:21:32',
                'updated_at' => '2023-08-25 10:21:32',
            ),
            45 => 
            array (
                'id' => 46,
                'key' => 'browse_permissions',
                'table_name' => 'permissions',
                'created_at' => '2023-08-25 11:03:01',
                'updated_at' => '2023-08-25 11:03:01',
            ),
            46 => 
            array (
                'id' => 47,
                'key' => 'read_permissions',
                'table_name' => 'permissions',
                'created_at' => '2023-08-25 11:03:01',
                'updated_at' => '2023-08-25 11:03:01',
            ),
            47 => 
            array (
                'id' => 48,
                'key' => 'edit_permissions',
                'table_name' => 'permissions',
                'created_at' => '2023-08-25 11:03:01',
                'updated_at' => '2023-08-25 11:03:01',
            ),
            48 => 
            array (
                'id' => 49,
                'key' => 'add_permissions',
                'table_name' => 'permissions',
                'created_at' => '2023-08-25 11:03:01',
                'updated_at' => '2023-08-25 11:03:01',
            ),
            49 => 
            array (
                'id' => 50,
                'key' => 'delete_permissions',
                'table_name' => 'permissions',
                'created_at' => '2023-08-25 11:03:01',
                'updated_at' => '2023-08-25 11:03:01',
            ),
            50 => 
            array (
                'id' => 51,
                'key' => 'filter_delegations_headquarters',
                'table_name' => 'headquarters',
                'created_at' => '2023-08-25 11:03:39',
                'updated_at' => '2023-08-25 11:03:39',
            ),
            51 => 
            array (
                'id' => 52,
                'key' => 'browse_audits',
                'table_name' => 'audits',
                'created_at' => '2023-08-25 14:59:38',
                'updated_at' => '2023-08-25 14:59:38',
            ),
            52 => 
            array (
                'id' => 53,
                'key' => 'read_audits',
                'table_name' => 'audits',
                'created_at' => '2023-08-25 14:59:38',
                'updated_at' => '2023-08-25 14:59:38',
            ),
            53 => 
            array (
                'id' => 54,
                'key' => 'edit_audits',
                'table_name' => 'audits',
                'created_at' => '2023-08-25 14:59:38',
                'updated_at' => '2023-08-25 14:59:38',
            ),
            54 => 
            array (
                'id' => 55,
                'key' => 'add_audits',
                'table_name' => 'audits',
                'created_at' => '2023-08-25 14:59:38',
                'updated_at' => '2023-08-25 14:59:38',
            ),
            55 => 
            array (
                'id' => 56,
                'key' => 'delete_audits',
                'table_name' => 'audits',
                'created_at' => '2023-08-25 14:59:38',
                'updated_at' => '2023-08-25 14:59:38',
            ),
            56 => 
            array (
                'id' => 57,
                'key' => 'logs',
                'table_name' => NULL,
                'created_at' => '2023-08-25 15:05:08',
                'updated_at' => '2023-08-25 15:05:08',
            ),
            57 => 
            array (
                'id' => 58,
                'key' => 'browse_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-25 15:14:12',
                'updated_at' => '2023-08-25 15:14:12',
            ),
            58 => 
            array (
                'id' => 59,
                'key' => 'read_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-25 15:14:12',
                'updated_at' => '2023-08-25 15:14:12',
            ),
            59 => 
            array (
                'id' => 60,
                'key' => 'edit_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-25 15:14:12',
                'updated_at' => '2023-08-25 15:14:12',
            ),
            60 => 
            array (
                'id' => 61,
                'key' => 'add_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-25 15:14:12',
                'updated_at' => '2023-08-25 15:14:12',
            ),
            61 => 
            array (
                'id' => 62,
                'key' => 'delete_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-25 15:14:12',
                'updated_at' => '2023-08-25 15:14:12',
            ),
            62 => 
            array (
                'id' => 63,
                'key' => 'generate_report_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-30 08:47:55',
                'updated_at' => '2023-08-30 08:47:55',
            ),
            63 => 
            array (
                'id' => 64,
                'key' => 'filter_headquarters_tree_plantations',
                'table_name' => 'tree_plantations',
                'created_at' => '2023-08-30 08:48:21',
                'updated_at' => '2023-08-30 08:48:21',
            ),
            64 => 
            array (
                'id' => 65,
                'key' => 'generate_report_audits',
                'table_name' => 'audits',
                'created_at' => '2023-08-30 08:55:23',
                'updated_at' => '2023-08-30 08:55:23',
            ),
            65 => 
            array (
                'id' => 66,
                'key' => 'browse_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:26:05',
                'updated_at' => '2023-08-30 15:26:05',
            ),
            66 => 
            array (
                'id' => 67,
                'key' => 'read_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:26:05',
                'updated_at' => '2023-08-30 15:26:05',
            ),
            67 => 
            array (
                'id' => 68,
                'key' => 'edit_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:26:05',
                'updated_at' => '2023-08-30 15:26:05',
            ),
            68 => 
            array (
                'id' => 69,
                'key' => 'add_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:26:05',
                'updated_at' => '2023-08-30 15:26:05',
            ),
            69 => 
            array (
                'id' => 70,
                'key' => 'delete_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:26:05',
                'updated_at' => '2023-08-30 15:26:05',
            ),
            70 => 
            array (
                'id' => 71,
                'key' => 'generate_report_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:49:03',
                'updated_at' => '2023-08-30 15:49:03',
            ),
            71 => 
            array (
                'id' => 72,
                'key' => 'filter_headquarters_co_responsibility_agreements',
                'table_name' => 'co_responsibility_agreements',
                'created_at' => '2023-08-30 15:49:16',
                'updated_at' => '2023-08-30 15:49:16',
            ),
        ));


        Permission::generateFor('menus');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('settings');
    }
}
