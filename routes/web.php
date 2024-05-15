<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login',[HomeController::class,'login'])->name('admin.login');