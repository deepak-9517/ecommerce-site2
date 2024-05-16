<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\LoginController as ControllersLoginController;

Route::group(['prefix'=>'user'],function(){
    Route::group(['middleware'=>'guest'],function(){
        Route::get('login',[ControllersLoginController::class,'index'])->name('login');
        Route::post('authenticate',[ControllersLoginController::class,'authenticate'])->name('authenticate');
        Route::get('register',[ControllersLoginController::class,'register'])->name('register');
        Route::post('register/user',[ControllersLoginController::class,'registerUser'])->name('registeruser');
    });
    Route::group(['middleware'=>'auth'],function(){
        Route::get('logout',[ControllersLoginController::class,'logout'])->name('logout');
        Route::get('dashboard',[ControllersDashboardController::class,'index'])->name('dashboard');
    });
});
        

Route::group(['prefix'=>'admin'],function(){
    Route::group(['middleware'=>'admin.guest'],function(){
        Route::get('login',[LoginController::class,'login'])->name('admin.login');
        Route::post('authenticate',[LoginController::class,'authenticate'])->name('admin.authenticate');
        Route::get('register',[LoginController::class,'register'])->name('admin.register');
        Route::post('register/user',[LoginController::class,'registerUser'])->name('admin.registeruser');
    });
    Route::group(['middleware'=>'admin.auth'],function(){
        Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');
        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('category',[DashboardController::class,'category'])->name('admin.category');
    });
});

Route::get('/',[HomeController::class,'index'])->name('home');