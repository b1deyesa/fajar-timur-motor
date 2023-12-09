<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use Illuminate\Http\Request;
use App\Imports\BarangImport;
use App\Models\SupplierBarang;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Gudang $gudang)
    {
        $barangs = Barang::where('gudang_id', $gudang->id)->orderBy('id', 'desc')->get();
        
        return view('dashboard.barang.index', [
            'barangs' => $barangs,
            'gudang' => $gudang,
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
    public function show(Gudang $gudang, Barang $barang)
    {
        return view('dashboard.barang.show', [
            'supplier_barangs' => SupplierBarang::where('barang_id', $barang->id)->orderBy('id', 'desc')->get(),
            'barang' => $barang,
            'gudang' => $gudang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gudang $gudang, Barang $barang)
    {
        return view('dashboard.barang.edit', [
            'barang' => $barang,
            'gudang' => $gudang,
            'gudangs' => Gudang::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gudang $gudang, Barang $barang)
    {
        // Validate data
        $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama barang tidak boleh kosong',
        ]);
        
        // Kode barang baru
        if ($barang->kode == 'Barang Baru') {
            $request['kode'] = 'BRG-' . sprintf('%05d', Barang::latest()->first()->id + 1);
        }
        
        // Update data
        $barang->update($request->all());

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data Barang ('. $barang->kode .')'
        ]);

        return redirect()->route('barang.index', compact('gudang'))->with('message','Data Barang ('. $barang->kode .') Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }

    public function info(Request $request)
    {
        $barangs = Barang::find($request->barang);

        return view('dashboard.barang.info', [
            'barangs' => $barangs
        ]);
    }
}
