<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->name('reservation-home');
Route::post('/', [ReservationController::class, 'store'])->name('reservation-store');
Route::post('/dashboard', [ReservationController::class, 'store'])->name('check-tracking-code');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/tracking/{tracking_code}', [TrackingController::class, 'showTracking'])->name('tracking');
Route::match(['get', 'post'], '/check-tracking-code', [InvoiceController::class, 'checkTrackingCode'])->name('check-tracking-code');
Route::put('/invoice/update/{id}', [InvoiceController::class, 'updateInvoice'])->name('update-invoice');
Route::match(['get', 'post'], '/invoice/delete/{id}', [InvoiceController::class, 'deleteInvoice'])->name('delete-invoice');
Route::get('/invoice/edit/{id}', [InvoiceController::class, 'editInvoice'])->name('edit-invoice');
Route::get('login', [AuthController::class, 'showLogin'])->name('show-login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'showRegister'])->name('show-register');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('users', UserController::class)->middleware('auth');
Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
Route::middleware(['auth', 'role:super-admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{user}', [AdminController::class, 'userRequests'])->name('admin.user.requests');
});
