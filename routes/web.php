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
Route::post('/login', [AuthController::class, 'authenticated'])->name('login');

Route::get('/home', [PurchaseOrderController::class, 'home'])->name('home');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/data/user', [PurchaseOrderController::class, 'indexUser'])->name('indexUser');
Route::post('/add/user', [PurchaseOrderController::class, 'addUser'])->name('addUser');
Route::get('/modal/detail-user/{id}', [PurchaseOrderController::class, 'modalDetailUser'])->name('modalDetailUser');
Route::post('/update/user/{id}', [PurchaseOrderController::class, 'updateUser'])->name('updateUser');
Route::delete('/delete/user/{id}', [PurchaseOrderController::class, 'deleteUser']);
Route::get('/data/supplier', [PurchaseOrderController::class, 'indexSupplier'])->name('indexSupplier');
Route::post('/add/supplier', [PurchaseOrderController::class, 'addSupplier'])->name('addSupplier');
Route::get('/modal/detail-supplier/{id}', [PurchaseOrderController::class, 'modalDetailSupplier'])->name('modalDetailSupplier');
Route::post('/update/supplier/{id}', [PurchaseOrderController::class, 'updateSupplier'])->name('updateSupplier');
Route::delete('/delete/supplier/{id}', [PurchaseOrderController::class, 'deleteSupplier']);
Route::get('/data/material', [PurchaseOrderController::class, 'indexMaterial'])->name('indexMaterial');
Route::post('/add/material', [PurchaseOrderController::class, 'addMaterial'])->name('addMaterial');
Route::get('/modal/detail-material/{id}', [PurchaseOrderController::class, 'modalDetailMaterial'])->name('modalDetailMaterial');
Route::post('/update/material/{id}', [PurchaseOrderController::class, 'updateMaterial'])->name('updateMaterial');
Route::delete('/delete/material/{id}', [PurchaseOrderController::class, 'deleteMaterial']);
Route::get('/data/po', [PurchaseOrderController::class, 'indexPO'])->name('indexPO');
Route::get('/data/detail/po/{po}', [PurchaseOrderController::class, 'indexDetailPO'])->name('indexDetailPO');
Route::post('/add/po', [PurchaseOrderController::class, 'addPO'])->name('addPO');
Route::post('/add/notes-reject/{po}', [PurchaseOrderController::class, 'rejectPO'])->name('rejectPO');
Route::post('/edit/po/{po}', [PurchaseOrderController::class, 'editPO'])->name('editPO');
