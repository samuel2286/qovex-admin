<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('',[DashboardController::class,'index']);
    Route::post('logout',[LoginController::class,'logout'])->name('logout');
    Route::get('login/locked', [LoginController::class,'locked'])->name('lockscreen');
    Route::post('login/locked', [LoginController::class,'unlock'])->name('login.unlock');

    Route::get('permissions',[PermissionController::class,'index'])->name('permissions');
    Route::post('permissions',[PermissionController::class,'store']);
    Route::put('permissions',[PermissionController::class,'update']);
    Route::delete('permission',[PermissionController::class,'destroy'])->name('permission.destroy');

    Route::get('profile',[UserController::class,'profile'])->name('profile');
    Route::post('profile/{user}/update-profile',[UserController::class,'updateProfile'])->name('profile.update');
    Route::post('profile/{user}/change-password',[UserController::class,'updatePassword'])->name('profile.updatePassword');
    Route::get('settings',[SettingController::class,'index'])->name('settings');

    Route::resource('roles', RoleController::class);
    Route::resource('users',UserController::class);

    Route::get('backup', [BackupController::class,'index'])->name('backup.index');
    Route::put('backup/create', [BackupController::class,'create'])->name('backup.store');
    Route::get('backup/download/{file_name?}', [BackupController::class,'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [BackupController::class,'destroy'])->where('file_name', '(.*)')->name('backup.destroy');
});


Route::middleware(['guest'])->group(function () {
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::post('login',[LoginController::class,'login']);
    Route::get('register',[RegisterController::class,'index'])->name('register');
    Route::post('register',[RegisterController::class,'store']);
    Route::get('forgot-password',[ForgotPasswordController::class,'index'])->name('forgot-password');
    Route::post('forgot-password',[ForgotPasswordController::class,'requestPassword']);
});
