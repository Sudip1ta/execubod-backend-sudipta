<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\admin\AppIntroManagementController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\PackagesController;
use App\Http\Controllers\admin\GoalController;
use App\Http\Controllers\admin\ExcerciseController;
use App\Http\Middleware\LoginCheck;

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

    Route::get('/', function () {
    // return view('welcome');
        return redirect(route('login'));
    });

    Route::get('login',[AdminController::class,'index'])->name('login');

    Route::post('verify',[AdminController::class,'login_verify']);
    
    Route::middleware([LoginCheck::class])->group(function () { 

        Route::get('dashboard',[AdminController::class,'dashboard']);

        /**** UserManagementController Route ****/
        Route::get('user-management',[UserManagementController::class,'index']);
        Route::post('user-edit-store',[UserManagementController::class,'user_update']);
        Route::get('user-add',[UserManagementController::class,'user_add']);
        Route::get('user-delete',[UserManagementController::class,'delete_user']);
        Route::get('user-status-update',[UserManagementController::class,'update_status']);
        Route::get('{id}/user-information',[UserManagementController::class,'user_information']);
        Route::get('logout',[AdminController::class,'logout']);
        
        Route::get('free-trial-join-list',[UserManagementController::class,'free_trial_user']);
        
        
        /**** AppIntroManagementController Route ****/
        Route::get('app-intro',[AppIntroManagementController::class,'app_intro_view']);
        Route::post('intro-update',[AppIntroManagementController::class,'app_intro_update']);
        Route::get('add-new-intro',[AppIntroManagementController::class,'add_intro']);
        Route::post('intro-delete',[AppIntroManagementController::class,'app_intro_delete']);
        Route::post('new-intro-submit',[AppIntroManagementController::class,'intro_store']);
        Route::post('intro-status-update',[AppIntroManagementController::class,'intro_status_update']);

        /**** CategoryController Route ****/
        Route::get('category',[CategoryController::class,'index']);
        Route::post('category-update',[CategoryController::class,'update']);
        Route::post('category-status-update',[CategoryController::class,'status_update']);
        Route::post('category-delete',[CategoryController::class,'delete']);
        Route::get('add-new-category',[CategoryController::class,'category_add']);
        Route::post('category-store',[CategoryController::class,'store']);


        /**** PackagesController Route ****/
        Route::get('all-packages',[PackagesController::class,'index']);
        Route::get('package-create',[PackagesController::class,'create']);
        Route::post('package-submit',[PackagesController::class,'store']);
        Route::post('fetch-excercise',[PackagesController::class,'get_excercise']);
        Route::post(' pack-status-update',[PackagesController::class,'status_update']);
        Route::post(' package-delete',[PackagesController::class,'delete']);
        Route::get('{id}/package-details',[PackagesController::class,'get_pack_info']);

        Route::get('package-add',[PackagesController::class,'create']);
        


        /**** GoalController Route ****/
        Route::get('goals',[GoalController::class,'index']);
        Route::post('goal-update',[GoalController::class,'update']);
        Route::post('goal-status-update',[GoalController::class,'status_update']);
        Route::post('goal-delete',[GoalController::class,'delete']);
        Route::get('add-new-goal',[GoalController::class,'goal_add']);
        Route::post('goal-store',[GoalController::class,'store']);


        /**** ExcerciseController Route ****/
        Route::get('excercise',[ExcerciseController::class,'index']);
        Route::get('new-excercise',[ExcerciseController::class,'create']);
        Route::post('excercise-store',[ExcerciseController::class,'store']);
        Route::post('excercise-update',[ExcerciseController::class,'update']);
        Route::post('excercise-status-update',[ExcerciseController::class,'status_update']);
        Route::post('excercise-delete',[ExcerciseController::class,'delete']); 
    });