<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\SupplierBarang;
use Illuminate\Support\Facades\Auth;

class CreateBarang extends Component
{
    public Gudang $gudang;
    public $modal = false;
    public $step = 1;
    public $disabled = false;
    public $datasup;
    public $supplier = [
        'id' => null,
        'nama' => null,
        'alamat' => null,
        'telp' => null
    ];
    public $barang = [
        'nama' => null,
        'merek' => null,
        'harga_beli' => null,
        'deskripsi' => null,
        'stok' => null
    ];
    
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
            'supplier.nama' => 'required',
        ], [
            'supplier.nama.required' => 'Supplier tidak boleh kosong'
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
            $this->disabled = true;
        } else {
            $this->supplier['id'] = null;
            $this->supplier['nama'] = null;
            $this->supplier['alamat'] = null;
            $this->supplier['telp'] = null;
            $this->disabled = false;
        }
    }

    public function submit()
    { 
        $this->validate([
            'barang.nama' => 'required',
            'barang.harga_beli' => 'required|numeric',
            'barang.stok' => 'required|numeric'
        ], [
            'barang.nama.required' => 'Nama barang tidak boleh kosong',
            'barang.harga_beli.required' => 'Harga beli tidak boleh kosong',
            'barang.harga_beli.numeric' => 'Harga beli harus berupa angka',
            'barang.stok.required' => 'Stok tidak boleh kosong',
            'barang.stok.numeric' => 'Stok harus berupa angka'
        ]);

        // Supplier
        if ($this->supplier['id'] == null) {
            // Generate kode
            $kode_supplier = 'SUP-' . sprintf('%03d', Supplier::all()->max('id') + 1);
            
            // Store data
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

        // Generate kode
        $kode_barang = 'BRG-' . sprintf('%05d', Barang::all()->max('id') + 1);

        // Store data
        $barang = Barang::create([
            'gudang_id' => $this->gudang->id,
            'kode' => $kode_barang,
            'nama' => $this->barang['nama'],
            'merek' => $this->barang['merek'],
            'harga_beli' => $this->barang['harga_beli'],
            'deskripsi' => $this->barang['deskripsi'],
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah Barang ('. $barang->kode .')'
        ]);
        
        // SupplierBarang store
        SupplierBarang::create([
            'supplier_id' => $supplier['id'],
            'barang_id' => $barang['id'],
            'stok' => $this->barang['stok']
        ]);
        
        return redirect()->route('barang.index', ['gudang' => $this->gudang])->with('message', 'Barang berhasil ditambahkan');
    }

    public function render()
    {
        return view('livewire.create-barang', [
            'suppliers' => Supplier::orderBy('id', 'desc')->get(),
            'gudang' => $this->gudang
        ]);
    }
}
