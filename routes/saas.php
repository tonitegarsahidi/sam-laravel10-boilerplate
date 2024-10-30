<?php

use App\Http\Controllers\Saas\SubscriptionMasterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Saas Routes
|--------------------------------------------------------------------------
|
|   All routes relates to SaaS operation (not the main business operations)
|   is stored in here
|
*/

Route::middleware('auth')->group(function () {
    //PACKAGES RELATED
    Route::prefix('/packages')
        ->middleware('role:ROLE_ADMIN,ROLE_SUPERVISOR')
        ->group(function () {
            Route::get('/',     [SubscriptionMasterController::class, 'index'])         ->name('subscription.packages.index');

            Route::get('/add',  [SubscriptionMasterController::class, 'create'])        ->name('subscription.packages.add');
            Route::post('/add', [SubscriptionMasterController::class, 'store'])         ->name('subscription.packages.store');

            Route::get('/{id}', [SubscriptionMasterController::class, 'detail'])        ->name('subscription.packages.detail');

            Route::get('/edit/{id}', [SubscriptionMasterController::class, 'edit'])         ->name('subscription.packages.edit');
            Route::put('/edit/{id}', [SubscriptionMasterController::class, 'update'])         ->name('subscription.packages.update');

            Route::get('/delete/{id}', [SubscriptionMasterController::class, 'deleteConfirm'])         ->name('subscription.packages.delete');
            Route::delete('/delete/{id}', [SubscriptionMasterController::class, 'destroy'])         ->name('subscription.packages.destroy');
        });
});
