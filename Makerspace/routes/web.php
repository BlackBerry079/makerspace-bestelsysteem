<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrinterController;

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

// route naar de printerpagina
Route::get('/printer',[PrinterController::class, 'show'] )->name('printer');
// Printer routes hiermee kan je printers maken
Route::post('/create_printer',[PrinterController::class, 'create_printer'])->name('printer.create');





// Route::get('/dashboard' ,[DashboardController::class, 'show'])->name('dashboard');
// Route::get('/Dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard');

