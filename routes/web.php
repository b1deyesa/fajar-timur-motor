<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KasirTransaksiController;
use App\Http\Controllers\RequisitionOrderController;
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
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');

  Route::group(['middleware' => ['kasir']], function () {
    Route::get('kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::get('kasir/nota', [KasirController::class, 'search'])->name('kasir.search');
    Route::get('kasir/transaksi', [KasirTransaksiController::class, 'index'])->name('kasir.transaksi.index');
  });

  Route::group(['middleware' => ['admin']], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard.index');
    Route::get('dashboard/transaksi/report', [TransaksiController::class, 'report'])->name('transaksi.report');
    Route::post('dashboard/gudang/status/barang', [BarangController::class, 'info'])->name('barang.info');
    Route::get('dashboard/requisition-order/{supplierBarang}/status-batalkan', [RequisitionOrderController::class, 'status_batalkan'])->name('requisition-order.status_batalkan');
    Route::get('dashboard/requisition-order/{supplierBarang}/status-proses', [RequisitionOrderController::class, 'status_proses'])->name('requisition-order.status_proses');
    Route::get('dashboard/requisition-order/{supplierBarang}/status-diterima', [RequisitionOrderController::class, 'status_diterima'])->name('requisition-order.status_diterima');
    Route::put('dashboard/requisition-order/{supplierBarang}/status-diterima', [RequisitionOrderController::class, 'status_diterima_update'])->name('requisition-order.status_diterima_update');
    
    Route::resource('dashboard/gudang', GudangController::class);
    Route::resource('dashboard/supplier', SupplierController::class);
    Route::resource('dashboard/user', UserController::class);
    Route::resource('dashboard/gudang/{gudang}/barang', BarangController::class);
    Route::resource('dashboard/transaksi', TransaksiController::class);
    Route::resource('dashboard/transaksi/{transaksi}/detail-transaksi', DetailTransaksiController::class);
    Route::resource('dashboard/requisition-order', RequisitionOrderController::class);
    Route::get('dashboard/transaksi/{transaksi}/invoice', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
  });
});