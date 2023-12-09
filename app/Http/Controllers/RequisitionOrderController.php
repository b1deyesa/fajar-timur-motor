<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\SupplierBarang;
use App\Models\RequisitionOrder;
use Illuminate\Support\Facades\Auth;

class RequisitionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        return view('dashboard.requisition-order.index', [
            'requisition_orders' => RequisitionOrder::orderBy('kode', 'desc')->get()
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
    public function show(RequisitionOrder $requisitionOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequisitionOrder $requisitionOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequisitionOrder $requisitionOrder)
    {
        dd($requisitionOrder);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequisitionOrder $requisitionOrder)
    {
        //
    }

    public function status_batalkan(SupplierBarang $supplierBarang)
    {
        // Update status
        $supplierBarang->update([
            'status' => 'Dibatalkan'
        ]);
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data RO ('. $supplierBarang->requisition_orders->first()->kode .')'
        ]);
        
        return redirect()->back();
    }

    public function status_proses(SupplierBarang $supplierBarang)
    {
        // Update status
        $supplierBarang->update([
            'status' => 'Dalam Proses'
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data RO ('. $supplierBarang->requisition_orders->first()->kode .')'
        ]);
        
        return redirect()->back();
    }

    public function status_diterima(SupplierBarang $supplierBarang)
    {
        return view('dashboard.requisition-order.stok', [
            'requisition_order' => $supplierBarang->requisition_orders->first()
        ]);
    }

    public function status_diterima_update(Request $request, SupplierBarang $supplierBarang)
    {
        // Update status
        if ($request->stok_diterima > 0) {
            $supplierBarang->update([
                'status' => 'Telah Dikirim',
            ]);
        } else {
            $supplierBarang->update([
                'status' => 'Dalam Proses',
            ]);
        }
        
        // Update supplier barang
        $supplierBarang->update([
            'stok' => $request->stok,
        ]);

        // Update requisition order
        $supplierBarang->requisition_orders->first()->update([
            'stok_diterima' => $request->stok_diterima,
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Update data RO ('. $supplierBarang->requisition_orders->first()->kode .')'
        ]);
        
        return redirect()->route('requisition-order.index')->with('message','Data RO ('. $supplierBarang->requisition_orders->first()->kode .') Berhasil di Update');
    }
}
