<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CalendarController;


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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticated']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Auth::routes();
// client
Route::group(['middleware' => ['auth', 'client']], function () {
    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
    // Route::post('postPengajuan', [CalendarController::class, 'storePengajuan'])->name('calendar.storePengajuan');
    // Route::post('postPengajuan', [CalendarController::class, 'storePengajuan'])->name('calendar.storePengajuan');
    Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
    // Route::delete('pengajuan/destroy/{id}', [CalendarController::class, 'destroyPengajuan'])->name('calendar.destroyPengajuan');
    // Route::get('calendar/check-accepted-bookings', [CalendarController::class, 'checkAcceptedBookings'])->name('calendar.check-accepted-bookings');
    // Route::get('calendar/check-weekend-date', [CalendarController::class, 'checkWeekendDate'])->name('calendar.check-weekend-date');
    Route::get('calendar/check', [CalendarController::class, 'checkBooking'])->name('calendar.check');
});

//admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('admin/calendar/index', [AdminController::class, 'index'])->name('admin.calendar.index');
    // Route::get('calendar/show/{id}', [AdminController::class, 'changeStatus'])->name('calendar.show');
    // Route::post('admin/calendar/status', [AdminController::class, 'updateBookingStatus'])->name('admin.calendar.status');
    // Route::post('/admin/calendar/update-booking-status', [AdminController::class, 'updateBookingStatus'])->name('admin.calendar.update-booking-status');
    Route::post('admin/calendar/status-accept', [AdminController::class, 'accept'])->name('admin.calendar.accept');
    Route::post('admin/calendar/status-reject', [AdminController::class, 'reject'])->name('admin.calendar.reject');
});