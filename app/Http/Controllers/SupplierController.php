<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.supplier.index', [
            'suppliers' => Supplier::all()
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
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('dashboard.supplier.edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validate data
        $request->validate([
            'nama' => 'required',
        ], [
            'nama.required' => 'Nama supplier tidak boleh kosong',
        ]);

        // Update data
        $supplier->update($request->all());

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data Supplier ('. $supplier->kode .')'
        ]);

        return redirect()->route('supplier.index')->with('message','Data Supplier ('. $supplier->kode .') Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
