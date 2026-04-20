<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NieuwsbriefController;
use App\Http\Controllers\NieuwsbriefAttachmentController;
use App\Http\Controllers\PrinterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group (['prefix' => 'nieuwsbrief'], function () {
    Route::get('/', [NieuwsbriefController::class, 'get']);
    Route::get('/{id}', [NieuwsbriefController::class, 'get_id']);
    Route::post('/', [NieuwsbriefController::class, 'create']);
    Route::put('/{id}', [NieuwsbriefController::class, 'update']);
    Route::delete('/{id}', [NieuwsbriefController::class, 'delete']);
});

Route::group (['prefix' => 'nieuwsbriefattachment'], function () {
    Route::get('/', [NieuwsbriefAttachmentController::class, 'get']);
    Route::get('/{id}', [NieuwsbriefAttachmentController::class, 'get_id']);
    Route::post('/', [NieuwsbriefAttachmentController::class, 'create']);
    Route::delete('/{id}', [NieuwsbriefAttachmentController::class, 'delete']);
});

Route::group(['prefix' => 'printer'], function () {
    Route::get('/', [PrinterController::class, 'get']);
    Route::get('/{id}', [PrinterController::class, 'get_id']);
    Route::post('/', [PrinterController::class, 'create']);
    Route::put('/{id}', [PrinterController::class, 'update']);
    Route::delete('/{id}', [PrinterController::class, 'delete']);
});