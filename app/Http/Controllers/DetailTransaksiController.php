<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Transaksi $transaksi)
    {
        $detail_transaksis = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();

        return view('dashboard.detail-transaksi.index', [
            'detail_transaksis' => $detail_transaksis,
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi, DetailTransaksi $detailTransaksi)
    {
        return view('dashboard.detail-transaksi.edit', [
            'detail_transaksi' => $detailTransaksi,
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi, DetailTransaksi $detailTransaksi)
    {        
        // Validate data
        $request->validate([
            'jumlah' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ], [
            'jumlah.required' => 'Quantity tidak boleh kosong',
            'harga_jual.required' => 'Harga jual tidak boleh kosong',
            'jumlah.numeric' => 'Quantity harus berupa angka',
            'harga_jual.numeric' => 'Harga jual harus berupa angka',
        ]);

        // Update data
        $detailTransaksi->update($request->all());
        $transaksi->update(['total' => $transaksi->sum() + $transaksi->harga_pengiriman]);
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data Transaksi ('. $transaksi->kode .')'
        ]);

        return redirect()->route('detail-transaksi.index', compact('transaksi', 'detailTransaksi'))->with('message','Data Transaksi ('. $transaksi->kode .') Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }
}
