<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\RequisitionOrder;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\SupplierBarang;
use Illuminate\Support\Facades\Auth;

class CreateRequisitionOrder extends Component
{
    public $suppliers = null;
    public $barangs = null;
    public $gudangs = null;
    public $modal = false;
    public $step = 1;
    public $disabled = false;
    public $disabled_barang = false;
    public $datasup;
    public $databar;
    public $supplier = [
        'id' => null,
        'nama' => null,
        'alamat' => null,
        'telp' => null
    ];
    public $barang = [
        'id' => null,
        'nama' => null,
        'gudang_id' => null,
        'merek' => null,
        'harga_beli' => null,
        'deskripsi' => null,
        'stok' => null
    ];
    
    public function mount()
    {
        $this->suppliers = Supplier::orderBy('id', 'desc')->get();
        $this->barangs = Barang::orderBy('id', 'desc')->get();
        $this->gudangs = Gudang::orderBy('id', 'desc')->get();
    }

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
        $this->step = 1;
    }

    public function next()
    {
        $this->validate([
            'barang.nama' => 'required',
            'barang.gudang_id' => 'required',
            'barang.harga_beli' => 'required|numeric',
            'barang.stok' => 'required|numeric'
        ], [
            'barang.nama.required' => 'Nama barang tidak boleh kosong',
            'barang.gudang_id.required' => 'Pilih gudang',
            'barang.harga_beli.required' => 'Harga beli tidak boleh kosong',
            'barang.harga_beli.numeric' => 'Harga beli harus berupa angka',
            'barang.stok.required' => 'Stok tidak boleh kosong',
            'barang.stok.numeric' => 'Stok harus berupa angka'
        ]);

        return $this->step = 2;
    }

    public function previous()
    {
        return $this->step = 1;
    }

    public function updatedDatasup($id)
    {
        if ($id != null or $id != "") {
            $supplier = Supplier::find($id);
            $this->supplier['id'] = $supplier->id;
            $this->supplier['nama'] = $supplier->nama;
            $this->supplier['alamat'] = $supplier->alamat;
            $this->supplier['telp'] = $supplier->telp;
            return $this->disabled = true;
        } else {
            $this->supplier['id'] = null;
            $this->supplier['nama'] = null;
            $this->supplier['alamat'] = null;
            $this->supplier['telp'] = null;
            return $this->disabled = false;
        }
    }

    public function updatedDatabar($id)
    {
        if ($id != null or $id != "") {
            $barang = Barang::find($id);
            $this->barang['id'] = $barang->id;
            $this->barang['nama'] = $barang->nama;
            $this->barang['gudang_id'] = $barang->gudang_id;
            $this->barang['merek'] = $barang->merek;
            $this->barang['deskripsi'] = $barang->deskripsi;
            return $this->disabled_barang = true;
        } else {
            $this->barang['id'] = null;
            $this->barang['nama'] = null;
            $this->barang['gudang_id'] = null;
            $this->barang['merek'] = null;
            $this->barang['deskripsi'] = null;
            return $this->disabled_barang = false;
        }
    }

    public function submit()
    { 
        $this->validate([
            'supplier.nama' => 'required',
        ], [
            'supplier.nama.required' => 'Supplier tidak boleh kosong'
        ]);

        // Supplier
        if ($this->supplier['id'] == null) {            
            // Store data
            $kode_supplier = 'SUP-' . sprintf('%03d', Supplier::all()->max('id') + 1);
            $supplier = Supplier::create([
                'kode' => $kode_supplier,
                'nama' => $this->supplier['nama'],
                'alamat' => $this->supplier['alamat'],
                'telp' => $this->supplier['telp'],
            ]);

            // Log
            Log::create([
                'user_id' => Auth::id(),
                'task' => 'Tambah Supplier ('. $supplier->kode .')'
            ]);
        } else {
            $supplier = $this->supplier;
        }

        // Barang
        if ($this->barang['id'] == null) {
            $kode_barang = 'BRG-' . sprintf('%05d', Barang::all()->max('id') + 1);
            $barang = Barang::create([
                'gudang_id' => $this->barang['gudang_id'],
                'kode' => $kode_barang,
                'nama' => $this->barang['nama'],
                'merek' => $this->barang['merek'],
                'deskripsi' => $this->barang['deskripsi'],
            ]);
        } else {
            $barang = $this->barang;
        }
        
        // Store SupplierBarang
        $supplier_barang = SupplierBarang::create([
            'supplier_id' => $supplier['id'],
            'barang_id' => $barang['id'],
            'harga_beli' => $this->barang['harga_beli'],
            'stok' => $this->barang['stok'],
            'status' => 'Dalam Proses'
        ]);
        
        // Store requisition order
        $kode_requisition_order = 'REQ-' . sprintf('%05d', RequisitionOrder::all()->max('id') + 1);
        RequisitionOrder::create([
            'kode' => $kode_requisition_order,
            'user_id' => Auth::id(),
            'supplier_barang_id' => $supplier_barang->id,
            'stok_diterima' => 0
        ]);
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah RO'
        ]);
        
        return redirect()->route('requisition-order.index')->with('message', 'Request berhasil dibuat');
    }
    
    public function render()
    {
        return view('livewire.create-requisition-order');
    }
}
