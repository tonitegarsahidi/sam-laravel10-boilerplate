<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    //============= REGISTER PAGE
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);


    //============= LOGIN PAGE
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.do');;


    //============= REGISTER CONFIRMATION : NEED ACTIVATION
    // this page will show user if manual activation is needed
    //register confirmation - need verification
    Route::get('need-activation', [RegisteredUserController::class, 'needActivation'])
        ->name('register.needactivation');

    //============= FORGOT PASSWORD
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    //RESET PASSWORD CONFIRMATION
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});



Route::get('email/verification-notification', [EmailVerificationNotificationController::class, 'showForm'])
    ->middleware('throttle:6,1')
    ->name('verification.sendForm');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

Route::get('email/verification-success', [EmailVerificationNotificationController::class, 'showVerificationSuccess'])
    ->middleware('throttle:6,1')
    ->name('verification.success');

Route::get('email/verification-failed', [EmailVerificationNotificationController::class, 'showVerificationFailed'])
    ->middleware('throttle:6,1')
    ->name('verification.failed');

Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->name('verification.notice');

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');


Route::middleware('auth')->group(function () {
    //logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
