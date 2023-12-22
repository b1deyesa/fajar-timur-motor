<?php

namespace App\Http\Controllers;

use App\Models\RO;
use App\Models\Log;
use App\Models\DetailRO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ROController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.ro.index', [
            'ros' => RO::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.ro.create');
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
    public function show(RO $ro)
    {
        return view('dashboard.ro.show', [
            'ro' => $ro,
            'detail_ros' => $ro->detail_ros
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RO $rO)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RO $rO)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RO $ro)
    {
        // Delete data
        $ro->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus RO ('. $ro->kode .')'
        ]);
        
        return redirect()->route('ro.index')->with('message','RO ('. $ro->kode .') Berhasil di Hapus');
    }

    public function stok(RO $ro, DetailRO $detail_ro)
    {
        return view('dashboard.ro.stok', [
            'ro' => $ro,
            'detail_ro' => $detail_ro
        ]);
    }

    public function stokUpdate(Request $request, RO $ro, DetailRO $detail_ro)
    {
        $detail_ro->supplier_barang->update(['stok' => $request->stok]);
        
        if($request->stok >= $detail_ro->stok_diminta) {
            $detail_ro->update(['status' => 'Selesai']);
        } else {
            $detail_ro->update(['status' => 'Dalam Proses']);
        }
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update Barang di RO ('. $ro->kode .')'
        ]);

        return redirect()->route('ro.show', compact('ro'))->with('message','Stok Barang ('. $ro->kode .') Berhasil di Update');
    }
}
