<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\TokenController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['throttle:10:5'])->group(function (){
    //Get anonymous token
    Route::get('/anonymousToken', [TokenController::class, 'generateToken'])->middleware('api');


    Route::get('/testresult', [TestResultController::class, 'store'])->middleware('api');
    Route::post('/testresult', [TestResultController::class, 'store'])->middleware('api');
});


