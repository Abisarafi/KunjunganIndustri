<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use App\Http\Controllers\PengajuanController;


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