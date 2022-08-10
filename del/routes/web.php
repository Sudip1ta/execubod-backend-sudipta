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
    return view('welcome');
});

    Route::get('admin/login',[AdminController::class,'index']);
    Route::post('admin/verify',[AdminController::class,'login_verify']);
    
    Route::middleware([LoginCheck::class])->group(function () { 

        Route::get('admin/dashboard',[AdminController::class,'dashboard']);

        /**** UserManagementController Route ****/
        Route::get('admin/user-management',[UserManagementController::class,'index']);
        Route::post('admin/user-edit-store',[UserManagementController::class,'user_update']);
        Route::get('admin/user-add',[UserManagementController::class,'user_add']);
        Route::get('admin/user-delete',[UserManagementController::class,'delete_user']);
        Route::get('admin/user-status-update',[UserManagementController::class,'update_status']);
        Route::get('admin/{id}/user-information',[UserManagementController::class,'user_information']);
        Route::get('admin/logout',[UserManagementController::class,'logout']);
        
        Route::get('admin/free-trial-join-list',[UserManagementController::class,'free_trial_user']);
        
        


        /**** AppIntroManagementController Route ****/
        Route::get('admin/app-intro',[AppIntroManagementController::class,'app_intro_view']);
        Route::post('admin/intro-update',[AppIntroManagementController::class,'app_intro_update']);
        Route::get('admin/add-new-intro',[AppIntroManagementController::class,'add_intro']);
        Route::post('admin/intro-delete',[AppIntroManagementController::class,'app_intro_delete']);
        Route::post('admin/new-intro-submit',[AppIntroManagementController::class,'intro_store']);
        Route::post('admin/intro-status-update',[AppIntroManagementController::class,'intro_status_update']);

        /**** CategoryController Route ****/
        Route::get('admin/category',[CategoryController::class,'index']);
        Route::post('admin/category-update',[CategoryController::class,'update']);
        Route::post('admin/category-status-update',[CategoryController::class,'status_update']);
        Route::post('admin/category-delete',[CategoryController::class,'delete']);
        Route::get('admin/add-new-category',[CategoryController::class,'category_add']);
        Route::post('admin/category-store',[CategoryController::class,'store']);


        /**** PackagesController Route ****/
        Route::get('admin/all-packages',[PackagesController::class,'index']);
        Route::get('admin/package-create',[PackagesController::class,'create']);
        Route::post('admin/package-submit',[PackagesController::class,'store']);
        Route::post('admin/fetch-excercise',[PackagesController::class,'get_excercise']);
        Route::post(' admin/pack-status-update',[PackagesController::class,'status_update']);
        Route::post(' admin/package-delete',[PackagesController::class,'delete']);
        Route::get('admin/{id}/package-details',[PackagesController::class,'get_pack_info']);
        


        /**** GoalController Route ****/
        Route::get('admin/goals',[GoalController::class,'index']);
        Route::post('admin/goal-update',[GoalController::class,'update']);
        Route::post('admin/goal-status-update',[GoalController::class,'status_update']);
        Route::post('admin/goal-delete',[GoalController::class,'delete']);
        Route::get('admin/add-new-goal',[GoalController::class,'goal_add']);
        Route::post('admin/goal-store',[GoalController::class,'store']);


        /**** ExcerciseController Route ****/
        Route::get('admin/excercise',[ExcerciseController::class,'index']);
        Route::get('admin/new-excercise',[ExcerciseController::class,'create']);
        Route::post('admin/excercise-store',[ExcerciseController::class,'store']);
        Route::post('admin/excercise-update',[ExcerciseController::class,'update']);
        Route::post('admin/excercise-status-update',[ExcerciseController::class,'status_update']);
        Route::post('admin/excercise-delete',[ExcerciseController::class,'delete']);
        
        
        
    });

