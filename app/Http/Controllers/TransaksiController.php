<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Log;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transaksi.index', [
            'transaksis' => Transaksi::orderBy('id', 'desc')->get()
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
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        // Delete data
        $transaksi->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Transaksi ('. $transaksi->kode .')'
        ]);
        
        return redirect()->route('user.index')->with('message','Transaksi ('. $transaksi->kode .') Berhasil di Hapus');
    }

    public function report()
    {
        // Load invoice view
        $pdf = PDF::loadView('dashboard.transaksi.report', [
            'transaksis' => Transaksi::orderBy('id', 'desc')->get()
        ]);

        // Download invoice
        return $pdf->download('Laporan Transaksi ['. now()->format('d-m-Y H:i:s') .'].pdf');
    }
}
