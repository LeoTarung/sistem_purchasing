<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseOrderController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/data/user', [PurchaseOrderController::class, 'indexUser'])->name('indexUser');
Route::get('/data/supplier', [PurchaseOrderController::class, 'indexSupplier'])->name('indexSupplier');
Route::get('/data/material', [PurchaseOrderController::class, 'indexMaterial'])->name('indexMaterial');
Route::get('/data/po', [PurchaseOrderController::class, 'indexPO'])->name('indexPO');
Route::get('/data/detail/po', [PurchaseOrderController::class, 'indexDetailPO'])->name('indexDetailPO');
