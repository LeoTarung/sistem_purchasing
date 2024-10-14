<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseOrderController;

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

Route::get('/get-price/{id}', [PurchaseOrderController::class, 'getPrice'])->name('getPrice');
Route::post('/acc-po/{po}', [PurchaseOrderController::class, 'accPO'])->name('accPO');
Route::post('/send-po-supp/{po}/{user}', [PurchaseOrderController::class, 'sendPOtoSupp'])->name('accPO');
Route::get('/alert/{id}', [PurchaseOrderController::class, 'getNotif'])->name('getPrice');
