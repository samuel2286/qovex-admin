<?php

use App\Http\Controllers\Admin\AppointmentsController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FilemanagerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TestOffersController;

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
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::get('', [DashboardController::class,'index']);


    Route::get('permissions', [PermissionController::class,'index'])->name('permissions');
    Route::post('permissions', [PermissionController::class,'store']);
    Route::put('permissions', [PermissionController::class,'update']);
    Route::delete('permission', [PermissionController::class,'destroy'])->name('permission.destroy');

    Route::get('test-offers', [TestOffersController::class,'index'])->name('test-offer');
    Route::post('test-offers', [TestOffersController::class,'store']);
    Route::put('test-offers', [TestOffersController::class,'update']);
    Route::delete('test-offers', [TestOffersController::class,'destroy'])->name('test-offer.destroy');

    Route::get('appointments', [AppointmentsController::class,'index'])->name('appointments');
    Route::post('appointments', [AppointmentsController::class,'store']);
    Route::put('appointments', [AppointmentsController::class,'update']);
    Route::delete('appointments', [AppointmentsController::class,'destroy'])->name('appointments.destroy');
    Route::post('appointment/update-status', [AppointmentsController::class, 'updateStatus'])->name('appointment.update-stat');
    Route::get('my-appointments', [AppointmentsController::class, 'userAppointment'])->name('user.appointments');

    Route::get('profile', [UserController::class,'profile'])->name('profile');
    Route::post('profile/{user}/update-profile', [UserController::class,'updateProfile'])->name('profile.update');
    Route::post('profile/{user}/change-password', [UserController::class,'updatePassword'])->name('profile.updatePassword');
    Route::get('settings', [SettingController::class,'index'])->name('settings');
    Route::post('settings', [SettingController::class,'store']);

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('filemanager', [FilemanagerController::class, 'index'])->name('filemanager');

    Route::get('backup', [BackupController::class,'index'])->name('backup.index');
    Route::put('backup/create', [BackupController::class,'create'])->name('backup.store');
    Route::get('backup/download/{file_name?}', [BackupController::class,'download'])->name('backup.download');
    Route::delete('backup/delete/{file_name?}', [BackupController::class,'destroy'])->where('file_name', '(.*)')->name('backup.destroy');
});
