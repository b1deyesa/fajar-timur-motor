<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use Illuminate\Http\Request;
use App\Models\SupplierBarang;
use Illuminate\Support\Facades\Auth;

class SupplierBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(SupplierBarang $supplierBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gudang $gudang, Barang $barang, SupplierBarang $supplierBarang)
    {
        return view('dashboard.supplier-barang.edit', [
            'supplier_barang' => $supplierBarang,
            'gudang' => $gudang,
            'barang' => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gudang $gudang, Barang $barang, SupplierBarang $supplierBarang)
    {
        // Validate data
        $request->validate([
            'harga_beli' => 'required',
            'stok' => 'required',
        ], [
            'harga_beli.required' => 'Nama barang tidak boleh kosong',
            'stok.required' => 'Nama barang tidak boleh kosong',
        ]);

        // Update data
        $supplierBarang->update($request->all());

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data Barang (' . $barang->kode . ')'
        ]);

        return redirect()->route('barang.show', compact('gudang', 'barang'))->with('message', 'Data Barang (' . $barang->kode . ') Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierBarang $supplierBarang)
    {
        //
    }
}
