<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\UserController;


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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/visits', [PengajuanController::class, 'index'])->name('visits.index');
Route::get('/visits/create', [PengajuanController::class, 'create'])->name('visits.create');
Route::post('/visits', [PengajuanController::class, 'store'])->name('visits.store');
Route::get('/visits/{id}/edit', [PengajuanController::class, 'edit'])->name('visits.edit');
Route::put('/visits/{id}', [PengajuanController::class, 'update'])->name('visits.update');
Route::delete('/visits/{id}', [PengajuanController::class, 'destroy'])->name('visits.destroy');

Route::get('/admin/requests', [AdminController::class, 'index'])->name('admin.requests.index');
Route::get('/admin/requests/{id}', [AdminController::class, 'show'])->name('admin.requests.show');
Route::post('/admin/requests/accept', [AdminController::class, 'accept'])->name('admin.requests.accept');
Route::post('/admin/requests/reject', [AdminController::class, 'reject'])->name('admin.requests.reject');


// Client routes
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', 'ClientController@dashboard')->name('client.dashboard');
    Route::get('/client/company-information', 'ClientController@companyInformation')->name('client.company');
    Route::get('/client/request-industrial-visit', 'ClientController@requestIndustrialVisit')->name('client.request');
    Route::get('/client/request-history', 'ClientController@requestHistory')->name('client.history');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Define your admin routes here
});


Route::get('/calendar', function () {
    return view('calendar');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/test', [UserController::class, 'test']);

// Calendar routes
Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
Route::post('postPengajuan', [CalendarController::class, 'storePengajuan'])->name('calendar.storePengajuan');
Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
Route::delete('pengajuan/destroy/{id}', [CalendarController::class, 'destroyPengajuan'])->name('calendar.destroyPengajuan');

Route::get('books', [BookController::class, 'index'])->name('books.index');
Route::post('books', [BookController::class, 'store'])->name('books.store');

Route::get('/export-db', function() {
    return "Exporting";
});


// Route::get('admin/calendar/index', [AdminController::class, 'index'])->name('admin.calendar.index');
// // Route::patch('calendar/change-status/{id}', [AdminController::class, 'changeBookingStatus'])->name('calendar.changeStatus');
// Route::get('calendar/show/{id}', [AdminController::class, 'changeStatus'])->name('calendar.show');
// // Route::post('admin/calendar/status', [AdminController::class, 'updateBookingStatus'])->name('admin.calendar.status');
Route::get('admin/calendar/index', [AdminController::class, 'index'])->name('admin.calendar.index');
Route::get('calendar/show/{id}', [AdminController::class, 'changeStatus'])->name('calendar.show');
Route::post('admin/calendar/status', [AdminController::class, 'updateBookingStatus'])->name('admin.calendar.status');
Route::post('/admin/calendar/update-booking-status', [AdminController::class, 'updateBookingStatus'])->name('admin.calendar.update-booking-status');