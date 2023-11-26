<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;

use App\Http\Controllers\Admin\DashboardController as DashboardAdminController;
use App\Http\Controllers\Admin\LaporanController as LaporanAdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();
// client
Route::group(['middleware' => ['auth', 'client']], function () {
    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
    Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    Route::get('calendar/check', [CalendarController::class, 'checkBooking'])->name('calendar.check');
});

//admin
Route::prefix('admin')
    ->middleware(['auth', 'admin']) 
    ->group(function(){
        Route::get('calendar/index', [AdminController::class, 'index'])->name('admin.calendar.index');
        Route::post('calendar/status-accept', [AdminController::class, 'accept'])->name('admin.calendar.accept');
        Route::post('calendar/status-reject', [AdminController::class, 'reject'])->name('admin.calendar.reject');
        //
        Route::resource('dashboard', DashboardAdminController::class);

        Route::get('laporan', [LaporanAdminController::class, 'index'])->name('admin.laporan');
        Route::get('exportlaporan', [LaporanAdminController::class, 'export'])->name('admin.export');
        // route download file proposal dari client
        Route::get('download-file/{id}', [AdminController::class, 'downloadFile'])->name('admin.downloadFile');

});


