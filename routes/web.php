<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\SupplierBarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
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

Route::get ("/", [AuthController::class, 'index'])->name('login');
Route::post("/", [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
  Route::get('kasir', [AuthController::class, 'kasir'])->name('kasir.index');
  Route::get('kasir/invoice/{id}', [AuthController::class, 'invoice'])->name('kasir.invoice');
  
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard.index');
  Route::get('dashboard/transaksi/report', [TransaksiController::class, 'report'])->name('transaksi.report');
  Route::post('dashboard/gudang/status/barang', [BarangController::class, 'info'])->name('barang.info');
  
  Route::resource('dashboard/gudang', GudangController::class);
  Route::resource('dashboard/supplier', SupplierController::class);
  Route::resource('dashboard/user', UserController::class);
  Route::resource('dashboard/gudang/{gudang}/barang', BarangController::class);
  Route::resource('dashboard/transaksi', TransaksiController::class);
  Route::resource('dashboard/transaksi/{transaksi}/detail-transaksi', DetailTransaksiController::class);
});