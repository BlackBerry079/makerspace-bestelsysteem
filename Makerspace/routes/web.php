<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderPageController;
use App\Http\Controllers\AuthPageController;

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

// Route::get('/', function () {
//     return view('login');
// });

// Dashboard regelt de display van printers, orders en nieuwsbrief,users
Route::get('/',[DashboardController::class, 'show'] )->name('dashboard');
Route::get('/',[DashboardController::class, 'show'] )->name('delete_printer');

Route::post('/',[MessageController::class,'create_nieuwsbrief']) ->name('create_nieuwsbrief');
Route::post('/delete_nieuwsbrief/{id}',[MessageController::class,'delete_nieuwsbrief']) ->name('delete_nieuwsbrief');

// route naar de printerpagina
Route::get('/printer',[PrinterController::class, 'show'] )->name('printer');
// Printer routes hiermee kan je printers maken
Route::post('/create_printer',[PrinterController::class, 'create_printer'])->name('printer.create');
// printers verwijderen
Route::get('/delete_printer/{id}', [PrinterController::class, 'delete_printer'])->name('delete_printer');
// Route::post('/printer', [PrinterController::class, 'store']);






// Route::get('/dashboard' ,[DashboardController::class, 'show'])->name('dashboard');
// Route::get('/Dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard');

// Nieuwe MVC routes voor verplaatste HTML-pagina's
Route::get('/bestellingen', [OrderPageController::class, 'index'])->name('orders.index');
Route::post('/bestellingen', [OrderPageController::class, 'store'])->name('orders.store');

Route::get('/login', [AuthPageController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthPageController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthPageController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthPageController::class, 'register'])->name('auth.register.submit');

