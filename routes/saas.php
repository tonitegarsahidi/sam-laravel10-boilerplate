<?php

use App\Http\Controllers\Saas\SubscriptionMasterController;
use App\Http\Controllers\Saas\SubscriptionUserController;
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
    Route::prefix('/subscription')
        ->middleware('role:ROLE_ADMIN,ROLE_SUPERVISOR')
        ->group(function () {


            Route::prefix('/package')
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
            //SUBSCRIPTION RELATED
            Route::prefix('/user')
            ->group(function () {
                Route::get('/',     [SubscriptionUserController::class, 'index'])         ->name('subscription.user.index');



                // No you can't delete here
                // delete mean unsubscribe
                Route::get('/subscribe', [SubscriptionUserController::class, 'create'])         ->name('subscription.user.add');
                Route::post('/subscribe', [SubscriptionUserController::class, 'store'])         ->name('subscription.user.store');

                Route::get('/unsubscribe/{id}', [SubscriptionUserController::class, 'unsubscribe'])         ->name('subscription.user.unsubscribe');
                Route::get('/suspend/{id}', [SubscriptionUserController::class, 'suspend'])         ->name('subscription.user.suspend');
                Route::get('/unsuspend/{id}', [SubscriptionUserController::class, 'unsuspend'])         ->name('subscription.user.unsuspend');

                Route::get('/resubscribe/{id}', [SubscriptionUserController::class, 'resubscribe'])         ->name('subscription.user.resubscribe');

                Route::get('/{id}', [SubscriptionUserController::class, 'detail'])        ->name('subscription.user.detail');
            });

        });


});
