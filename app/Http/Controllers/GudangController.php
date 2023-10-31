<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.gudang.index', [
            'gudangs' => Gudang::all()
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
    public function show(Gudang $gudang)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gudang $gudang)
    {
        return view('dashboard.gudang.edit', [
            'gudang' => $gudang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gudang $gudang)
    {
        // Validate data
        $request->validate([
            'nama' => 'required',
            'kapasitas' => 'required|numeric',
        ], [
            'nama.required' => 'Nama gudang tidak boleh kosong',
            'kapasitas.required' => 'Isi angka 0 bila kapasitas belum diketahui',
            'kapasitas.numeric' => 'Input kapasitas harus berupa angka',
        ]);

        // Update data
        $gudang->update($request->all());

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data Gudang ('. $gudang->kode .')'
        ]);

        return redirect()->route('gudang.index')->with('message','Data Gudang ('. $gudang->kode .') Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gudang $gudang)
    {
        // 
    }
}
