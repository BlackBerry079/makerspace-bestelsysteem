<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderPageController;
use App\Http\Controllers\AuthController;
use App\Models\Order;

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


// --------------DASHBOARD ROUTES------------------
// Dashboard regelt de display van printers, orders en nieuwsbrief,users
Route::get('/', function () {
    return view('home', [
        'previewOrders' => Order::query()->latest()->take(3)->get(),
    ]);
})->name('home');
Route::get('/dashboard',[DashboardController::class, 'show'] )->name('dashboard');
Route::get('/Dashboard',[DashboardController::class, 'show'] );
// Route::get('/printer',[DashboardController::class, 'show'] )->name('printercount');


// --------------Nieuwsbrief ROUTES------------------
Route::post('/',[MessageController::class,'create_nieuwsbrief']) ->name('create_nieuwsbrief');
Route::delete('/delete_nieuwsbrief/{id}',[MessageController::class,'delete_nieuwsbrief']) ->name('delete_nieuwsbrief');


// --------------Inventaris routes--------------
Route::get('/inventory',[InventoryController::class, 'show'] )->name('inventory');






// --------------PRINTER ROUTES------------------
// route naar de printerpagina
Route::get('/printer',[PrinterController::class, 'index'] )->name('printer');
Route::delete('/',[DashboardController::class, 'show'] )->name('delete_printer');
// Printer routes hiermee kan je printers maken
// Route::get('/create',[PrinterController::class, 'create'])->name('printer.create'); veranderd naar post en store functie
Route::post('/printer', [PrinterController::class, 'store'])->name('printer.store');
// printers verwijderen
Route::delete('/delete/printer/{id}', [PrinterController::class, 'delete'])->name('delete_printer');


// --------------ORDER ROUTES------------------ // Nieuwe MVC routes voor verplaatste HTML-pagina's
Route::get('/orders', [OrderPageController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderPageController::class, 'store'])->name('orders.store');
Route::get('/api/nieuwsbrief/latest', [OrderPageController::class, 'latestNewsletter'])->name('newsletter.latest');

Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register.submit');






