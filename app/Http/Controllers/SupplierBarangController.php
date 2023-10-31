<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gudang;
use Illuminate\Http\Request;
use App\Models\SupplierBarang;

class SupplierBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Gudang $gudang, Barang $barang)
    {
        return view('dashboard.supplier-barang.index', [
            'barangs' => SupplierBarang::where('barang_id', $barang->id)->get()
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
    public function show(SupplierBarang $supplierBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierBarang $supplierBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierBarang $supplierBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierBarang $supplierBarang)
    {
        //
    }
}
