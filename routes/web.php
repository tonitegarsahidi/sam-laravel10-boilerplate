<?php

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SampleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.checkAuth');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');



Route::middleware('auth')->group(function () {

    //PROFILE SETTING
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile.index');
    Route::put('/profile', [UserProfileController::class, 'updateOrCreate'])->name('user.profile.update');


    // SAMPLE PAGES FOR THIS BOILER PLATE THING....
    // NO FUNCTIONALITY JUST FOR SOME DASHBOARD / CRUD PAGES REFERENCE
    // Route::middleware('verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //SAMPLE UI
    Route::prefix('/sample')
        ->middleware('role:ROLE_USER')
        ->group(function () {
            Route::get('cards',         [SampleController::class, 'cards'])             ->name('sample.cards');
            Route::get('table',         [SampleController::class, 'tablePage'])         ->name('sample.table');
            Route::get('form1',         [SampleController::class, 'formPage1'])         ->name('sample.form1');
            Route::get('form2',         [SampleController::class, 'formPage2'])         ->name('sample.form2');
            Route::get('textdivider',   [SampleController::class, 'textDivider'])       ->name('sample.textdivider');
            Route::get('blank',         [SampleController::class, 'blank'])             ->name('sample.blank');
        });


    //This One is for Demo Middleware Routing, so that only who has role can access it
    Route::get('/admin-page',           [AdminController::class, 'index'])      ->name('admin-page')        ->middleware('role:ROLE_ADMIN');
    Route::get('/operator-page',        [OperatorController::class, 'index'])   ->name('operator-page')     ->middleware('role:ROLE_OPERATOR');
    Route::get('/supervisor-page',      [SupervisorController::class, 'index']) ->name('supervisor-page')   ->middleware('role:ROLE_SUPERVISOR');
    Route::get('/user-page',            [UserController::class, 'userOnlyPage'])->name('user-page')         ->middleware('role:ROLE_USER');

    // Only users with the 'ROLE_ADMIN' can access this route group
    Route::prefix('/admin')
        ->middleware('role:ROLE_ADMIN')
        ->group(function () {

            // MANAGE USERS ON SYSTEM
            Route::get('/user',                     [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/user/add/new',             [UserController::class, 'create'])->name('admin.user.add');
            Route::post('/user/add/new',            [UserController::class, 'store'])->name('admin.user.store');

            Route::get('/user/detail/{id}',         [UserController::class, 'detail'])->name('admin.user.detail');
            Route::put('/user/edit/{id}',           [UserController::class, 'update'])->name('admin.user.update');
            Route::get('/user/edit/{id}',           [UserController::class, 'edit'])->name('admin.user.edit');
            Route::get('/user/delete/{id}',         [UserController::class, 'deleteConfirm'])->name('admin.user.delete');
            Route::delete('/user/delete/{id}',      [UserController::class, 'destroy'])->name('admin.user.destroy');
        });

    Route::prefix('/user-setting')
        ->middleware('role:ROLE_ADMIN,ROLE_OPERATOR,ROLE_SUPERVISOR,ROLE_USER')
        ->group(function () {
            // Only users with the 'ROLE_USER' or 'ROLE_OPERATOR' role can access this route
            Route::get('/', [UserSettingController::class, 'index'])->name('user.setting.index');
            Route::post('/', [UserSettingController::class, 'deactivateAccount'])->name('user.setting.deactivate');

            //change password section
            Route::get('/change-password', [UserSettingController::class, 'changePasswordPage'])->name('user.setting.changePassword');
            Route::post('/change-password', [UserSettingController::class, 'changePasswordDo'])->name('user.setting.changePassword.do');
        });


    Route::prefix('/demo')
        ->middleware('role:ROLE_USER')
        ->group(function () {
            // Only users which has the 'ROLE_USER'can access this route
            Route::get('/', [DemoController::class, 'index'])->name('demo');
            Route::get('/print', [DemoController::class, 'print'])->name('demo.print');
        });
});


require __DIR__ . '/auth.php';

if(config('saas.SAAS_ACTIVATED')){
    require __DIR__ . '/saas.php';
}

