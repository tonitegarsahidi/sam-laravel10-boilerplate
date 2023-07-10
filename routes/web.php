<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\UserController;
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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


// SAMPLE PAGES FOR THIS BOILER PLATE THING....
// NO FUNCTIONALITY JUST FOR SOME DASHBOARD / CRUD PAGES REFERENCE
    // Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/sample/chart', [SampleController::class, 'chartPages'])->name('sampleChart');
        Route::get('/sample/table', [SampleController::class, 'tablePages'])->name('sampleTable');
        Route::get('/sample/form', [SampleController::class, 'formPages'])->name('sampleForm');
        Route::get('/sample/ui-button', [SampleController::class, 'uiButtonPages'])->name('sampleUiButton');
        Route::get('/sample/ui-typography', [SampleController::class, 'uiTypographyPages'])->name('sampleUiTypography');
        Route::get('/sample/documentation', [SampleController::class, 'documentationPages'])->name('sampleDocumentation');
    // });

    //This One is for Demo Middleware Routing, so that only who has role can access it
    Route::get('/admin-page',       [AdminController::class, 'index'])      ->name('admin-page')    ->middleware('role:ROLE_ADMIN');
    Route::get('/operator-page',    [OperatorController::class, 'index'])   ->name('operator-page') ->middleware('role:ROLE_OPERATOR');
    Route::get('/supervisor-page',    [SupervisorController::class, 'index'])   ->name('supervisor-page') ->middleware('role:ROLE_SUPERVISOR');
    Route::get('/user-page',        [UserController::class, 'index'])       ->name('user-page')     ->middleware('role:ROLE_USER');

    Route::get('/operator', function () {
        // Only users with the 'ROLE_ADMIN' or 'ROLE_OPERATOR' role can access this route
    })->middleware('role:ROLE_ADMIN', 'role:ROLE_OPERATOR');


});



require __DIR__.'/auth.php';
