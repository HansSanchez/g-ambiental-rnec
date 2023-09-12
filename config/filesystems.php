<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'users' => [
            'driver' => 'local',
            'root' => storage_path('app/public/users'),
            'url' => env('APP_URL') . '/storage/users',
            'visibility' => 'public',
        ],

        'audits' => [
            'driver' => 'local',
            'root' => storage_path('app/public/reports/audits'),
            'url' => env('APP_URL') . '/storage/reports/audits',
            'visibility' => 'public',
        ],

        'tree_plantations' => [
            'driver' => 'local',
            'root' => storage_path('app/public/reports/tree_plantations'),
            'url' => env('APP_URL') . '/storage/reports/tree_plantations',
            'visibility' => 'public',
        ],

        'evidences_tree_plantations' => [
            'driver' => 'local',
            'root' => storage_path('app/public/tree_plantations/evidences/images'),
            'url' => env('APP_URL') . '/storage/tree_plantations/evidences/images',
            'visibility' => 'public',
        ],

        'co_responsibility_agreements' => [
            'driver' => 'local',
            'root' => storage_path('app/public/reports/co_responsibility_agreements'),
            'url' => env('APP_URL') . '/storage/reports/co_responsibility_agreements',
            'visibility' => 'public',
        ],

        'evidences_co_responsibility_agreements' => [
            'driver' => 'local',
            'root' => storage_path('app/public/co_responsibility_agreements/evidences/documents'),
            'url' => env('APP_URL') . '/storage/co_responsibility_agreements/evidences/documents',
            'visibility' => 'public',
        ],

        'electrical_consumptions' => [
            'driver' => 'local',
            'root' => storage_path('app/public/reports/electrical_consumptions'),
            'url' => env('APP_URL') . '/storage/reports/electrical_consumptions',
            'visibility' => 'public',
        ],

        'evidences_electrical_consumptions' => [
            'driver' => 'local',
            'root' => storage_path('app/public/electrical_consumptions/evidences/files'),
            'url' => env('APP_URL') . '/storage/electrical_consumptions/evidences/files',
            'visibility' => 'public',
        ],

        'water_consumptions' => [
            'driver' => 'local',
            'root' => storage_path('app/public/reports/water_consumptions'),
            'url' => env('APP_URL') . '/storage/reports/water_consumptions',
            'visibility' => 'public',
        ],

        'evidences_water_consumptions' => [
            'driver' => 'local',
            'root' => storage_path('app/public/water_consumptions/evidences/files'),
            'url' => env('APP_URL') . '/storage/water_consumptions/evidences/files',
            'visibility' => 'public',
        ],

        'waste_management' => [
            'driver' => 'local',
            'root' => storage_path('app/public/reports/water_consumptions'),
            'url' => env('APP_URL') . '/storage/reports/water_consumptions',
            'visibility' => 'public',
        ],

        'evidences_waste_management' => [
            'driver' => 'local',
            'root' => storage_path('app/public/waste_management/evidences/files'),
            'url' => env('APP_URL') . '/storage/waste_management/evidences/files',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
