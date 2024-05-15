<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;



        // Route::get('login',[LoginController::class,'login'])->name('login');
        // Route::post('authenticate',[LoginController::class,'authenticate'])->name('authenticate');
        // Route::get('register',[LoginController::class,'register'])->name('register');
        // Route::post('register/user',[LoginController::class,'registerUser'])->name('registeruser');


        // Route::get('logout',[LoginController::class,'logout'])->name('logout');
        // Route::get('user/dashboard',[HomeController::class,'userDashboard'])->name('user.dashboard');

Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'guest'],function(){
        Route::get('login',[LoginController::class,'login'])->name('admin.login');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');
        Route::get('register',[LoginController::class,'register'])->name('admin.register');
        Route::post('register/user',[LoginController::class,'registerUser'])->name('admin.registeruser');
    });
    Route::group(['middleware'=>'auth'],function(){
        Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    });
});