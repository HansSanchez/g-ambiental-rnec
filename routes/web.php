<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Authentication
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name("register");
Route::post('register', [\App\Http\Controllers\Auth\RegisterController::class, 'create']);
Route::get('/forget-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])
    ->name('forget.password.get');
Route::post('/forget-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])
    ->name('forget.password.post');
Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])
    ->name('reset.password.get');
Route::post('/reset-password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])
    ->name('reset.password.post');

// Página principal del sitio
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Grupo de grupos de rutas
Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin'], function () {
        Voyager::routes();
    });

    Route::group(['prefix' => 'g-environmental-rnec'], function () {

        // GRUPO DE RUTAS PARA MÓDULO DE "PERMISOS"
        Route::group(['prefix' => 'home'], function () {
            Route::post('/permissions', [\App\Http\Controllers\HomeController::class, 'permissions']);
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "AUDITORIAS"
        Route::group(['prefix' => 'audits'], function () {
            Route::get('/getAudits', [\App\Http\Controllers\AuditController::class, 'getAudits']);
            Route::post('/generateReport', [\App\Http\Controllers\AuditController::class, 'generateReport']);
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "DELEGACIONES"
        Route::group(['prefix' => 'delegations'], function () {
            Route::get('/getDelegations', [\App\Http\Controllers\DelegationController::class, 'getDelegations']);
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "MUNICIPIOS"
        Route::group(['prefix' => 'municipalities'], function () {
            Route::get('/getMunicipalities', [\App\Http\Controllers\MunicipalityController::class, 'getMunicipalities']);
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "USUARIOS"
        Route::group(['prefix' => 'users'], function () {
            Route::post('/getAuthenticatedUser', [\App\Http\Controllers\UserController::class, 'getAuthenticatedUser']);
            Route::post('/getUsersInput', [\App\Http\Controllers\UserController::class, 'getUsersInput']);
            Route::get('/getUsers', [\App\Http\Controllers\UserController::class, 'getUsers']);
            Route::get('/getRoles', [\App\Http\Controllers\UserController::class, 'getRoles']);
            Route::post('/store', [\App\Http\Controllers\UserController::class, 'store']);
            Route::post('/{user}/update', [\App\Http\Controllers\UserController::class, 'update']);
            Route::post('/importUsers', [\App\Http\Controllers\UserController::class, 'importUsers'])->name('users.import');
            Route::post('/{user}/photoUpload', [\App\Http\Controllers\UserController::class, 'photoUpload']);
            Route::put('/updatePassword', [\App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');
            Route::get('/searchUser', [\App\Http\Controllers\UserController::class, 'searchUser'])->name('searchUser');
            Route::get('/usersSelectPassword', [\App\Http\Controllers\UserController::class, 'usersSelectPassword'])->name('usersSelectPassword');
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "PLANTACION DE ÁRBOLES"
        Route::group(['prefix' => 'tree-plantations'], function () {
            Route::get('/getTreePlantation', [\App\Http\Controllers\TreePlantationController::class, 'getTreePlantation']);
            Route::post('/store', [\App\Http\Controllers\TreePlantationController::class, 'store']);
            Route::get('/show/{treePlantation}', [\App\Http\Controllers\TreePlantationController::class, 'show']);
            Route::post('/{treePlantation}/update', [\App\Http\Controllers\TreePlantationController::class, 'update']);
            Route::delete('/{treePlantation}/destroy', [\App\Http\Controllers\TreePlantationController::class, 'destroy']);
            Route::post('/generateReport', [\App\Http\Controllers\TreePlantationController::class, 'generateReport']);

            // RUTAS PARA GESTIÓN DE EVIDENCIAS
            Route::group(['prefix' => 'evidences'], function () {
                Route::get('/evidenceTreePlantation/{treePlantation}', [\App\Http\Controllers\EvidenceTreePlantationController::class, 'evidenceTreePlantation']);
                Route::post('/storeImage', [\App\Http\Controllers\EvidenceTreePlantationController::class, 'storeImage']);
                Route::delete('/{evidenceTreePlantation}/destroyImage', [\App\Http\Controllers\EvidenceTreePlantationController::class, 'destroyImage']);
            });
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "ACUERDOS DE CORRESPONSABILIDAD"
        Route::group(['prefix' => 'co-responsibility-agreements'], function () {
            Route::get('/getCoResponsibilityAgreements', [\App\Http\Controllers\CoResponsibilityAgreementsController::class, 'getCoResponsibilityAgreements']);
            Route::post('/store', [\App\Http\Controllers\CoResponsibilityAgreementsController::class, 'store']);
            Route::get('/show/{coResponsibilityAgreement}', [\App\Http\Controllers\CoResponsibilityAgreementsController::class, 'show']);
            Route::post('/{coResponsibilityAgreement}/update', [\App\Http\Controllers\CoResponsibilityAgreementsController::class, 'update']);
            Route::delete('/{coResponsibilityAgreement}/destroy', [\App\Http\Controllers\CoResponsibilityAgreementsController::class, 'destroy']);
            Route::post('/generateReport', [\App\Http\Controllers\CoResponsibilityAgreementsController::class, 'generateReport']);

            // RUTAS PARA GESTIÓN DE EVIDENCIAS
            Route::group(['prefix' => 'evidences'], function () {
                Route::get('/evidenceCoResponsibilityAgreement/{coResponsibilityAgreement}', [\App\Http\Controllers\EvidenceCoResponsibilityAgreementController::class, 'evidenceCoResponsibilityAgreement']);
                Route::post('/storeDocument', [\App\Http\Controllers\EvidenceCoResponsibilityAgreementController::class, 'storeDocument']);
                Route::delete('/{id}/destroyDocument', [\App\Http\Controllers\EvidenceCoResponsibilityAgreementController::class, 'destroyDocument']);
            });
        });

        // GRUPO DE RUTAS PARA MÓDULO DE "CONSUMO ELÉCTRICO"
        Route::group(['prefix' => 'electrical-consumptions'], function () {
            Route::get('/getElectricalConsumptions', [\App\Http\Controllers\ElectricalConsumptionController::class, 'getElectricalConsumptions']);
            Route::post('/store', [\App\Http\Controllers\ElectricalConsumptionController::class, 'store']);
            Route::get('/show/{electricalConsumption}', [\App\Http\Controllers\ElectricalConsumptionController::class, 'show']);
            Route::post('/{electricalConsumption}/update', [\App\Http\Controllers\ElectricalConsumptionController::class, 'update']);
            Route::delete('/{electricalConsumption}/destroy', [\App\Http\Controllers\ElectricalConsumptionController::class, 'destroy']);
            Route::post('/generateReport', [\App\Http\Controllers\ElectricalConsumptionController::class, 'generateReport']);

            // RUTAS PARA GESTIÓN DE EVIDENCIAS
            Route::group(['prefix' => 'evidences'], function () {
                Route::get('/evidenceElectricalConsumption/{electricalConsumption}', [\App\Http\Controllers\EvidenceElectricalConsumptionController::class, 'evidenceElectricalConsumption']);
                Route::post('/storeEvidence', [\App\Http\Controllers\EvidenceElectricalConsumptionController::class, 'storeEvidence']);
                Route::delete('/{id}/destroyEvidence', [\App\Http\Controllers\EvidenceElectricalConsumptionController::class, 'destroyEvidence']);
            });
        });


        // GRUPO DE RUTAS PARA MÓDULO DE "CONSUMO HÍDRICO"
        Route::group(['prefix' => 'water-consumptions'], function () {
            Route::get('/getWaterConsumptions', [\App\Http\Controllers\WaterConsumptionController::class, 'getWaterConsumptions']);
            Route::post('/store', [\App\Http\Controllers\WaterConsumptionController::class, 'store']);
            Route::get('/show/{waterConsumption}', [\App\Http\Controllers\WaterConsumptionController::class, 'show']);
            Route::post('/{waterConsumption}/update', [\App\Http\Controllers\WaterConsumptionController::class, 'update']);
            Route::delete('/{waterConsumption}/destroy', [\App\Http\Controllers\WaterConsumptionController::class, 'destroy']);
            Route::post('/generateReport', [\App\Http\Controllers\WaterConsumptionController::class, 'generateReport']);

            // RUTAS PARA GESTIÓN DE EVIDENCIAS
            Route::group(['prefix' => 'evidences'], function () {
                Route::get('/evidenceWaterConsumption/{waterConsumption}', [\App\Http\Controllers\EvidenceWaterConsumptionController::class, 'evidenceWaterConsumption']);
                Route::post('/storeEvidence', [\App\Http\Controllers\EvidenceWaterConsumptionController::class, 'storeEvidence']);
                Route::delete('/{id}/destroyEvidence', [\App\Http\Controllers\EvidenceWaterConsumptionController::class, 'destroyEvidence']);
            });
        });

        // RUTA PARA OBTENCIÓN DE TOKEN
        Route::get('/csrf-token', function () {
            return csrf_token();
        });
    });

    // RUTA PARA GESTIÓN DE "LOGS"
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


    // OTROS
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return redirect()->to('/v/home');
    })->name('dashboard');

    Route::get('/v/{any?}/{any1?}/{any2?}/{any3?}/{any4?}', function ($any = null, $any1 = null, $any2 = null, $any3 = null, $any4 = null) {
        return view('layouts.coreui');
    })->where('vue', '.*')->name('rutas.vue');
});
