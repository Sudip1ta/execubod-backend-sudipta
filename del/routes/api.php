<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;


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

    
    Route::post('login', [AuthController::class,'login']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('verify', [AuthController::class,'userName_email_verify']);

    Route::post('app-intro', [AppController::class,'get_app_intro']);


    Route::group(['middleware' => 'auth:api'], function() {

        /*** User Oparetion Related */

            Route::post('logout', [AuthController::class,'logout']);
            Route::post('users', [UserController::class,'users']);
            Route::post('user-info-store', [UserController::class,'info_store']);

        /*** App Use Route for App related work */

            Route::post('all-category', [AppController::class,'get_category']);
            Route::post('fetch-packages', [AppController::class,'fetch_programs_by_category']);
            Route::post('packages-details', [AppController::class,'programme_details']);
            
            
    });
    
