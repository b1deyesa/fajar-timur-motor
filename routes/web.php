<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KasirDetailTransaksiController;
use App\Http\Controllers\KasirTransaksiController;
use App\Http\Controllers\ROController;
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
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');

  Route::group(['middleware' => ['kasir']], function () {
    Route::get('kasir', [KasirController::class, 'index'])->name('kasir.index');
    Route::get('kasir/nota', [KasirController::class, 'search'])->name('kasir.search');
    Route::get('kasir/transaksi', [KasirTransaksiController::class, 'index'])->name('kasir.transaksi.index');
    Route::delete('kasir/transaksi/{transaksi}', [KasirTransaksiController::class, 'destroy'])->name('kasir.transaksi.destroy');
    Route::get('kasir/transaksi/{transaksi}/detail-transaksi', [KasirDetailTransaksiController::class, 'index'])->name('kasir.detail-transaksi.index');
    Route::get('kasir/transaksi/{transaksi}/detail-transaksi/{detail_transaksi}/edit', [KasirDetailTransaksiController::class, 'edit'])->name('kasir.detail-transaksi.edit');
    Route::put('kasir/transaksi/{transaksi}/detail-transaksi/{detail_transaksi}/edit', [KasirDetailTransaksiController::class, 'update'])->name('kasir.detail-transaksi.update');
    Route::get('kasir/transaksi/{transaksi}/invoice', [KasirDetailTransaksiController::class, 'invoice'])->name('kasir.detail-transaksi.invoice');
  });

  Route::group(['middleware' => ['admin']], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard.index');
    Route::get('dashboard/transaksi/report', [TransaksiController::class, 'report'])->name('transaksi.report');
    Route::get('dashboard/transaksi/{transaksi}/invoice', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
    Route::get('dashboard/ro/{ro}/detail-ro/{detail_ro}/stok', [ROController::class, 'stok'])->name('ro.stok');
    Route::put('dashboard/ro/{ro}/detail-ro/{detail_ro}/stok', [ROController::class, 'stokUpdate'])->name('ro.stok-update');
    Route::post('dashboard/gudang/status/barang', [BarangController::class, 'info'])->name('barang.info');
    
    Route::resource('dashboard/gudang', GudangController::class);
    Route::resource('dashboard/supplier', SupplierController::class);
    Route::resource('dashboard/user', UserController::class);
    Route::resource('dashboard/gudang/{gudang}/barang', BarangController::class);
    Route::resource('dashboard/gudang/{gudang}/barang/{barang}/supplier-barang', SupplierBarangController::class);
    Route::resource('dashboard/transaksi', TransaksiController::class);
    Route::resource('dashboard/transaksi/{transaksi}/detail-transaksi', DetailTransaksiController::class);
    Route::resource('dashboard/ro', ROController::class);
  });
});