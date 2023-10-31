<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\SupplierBarang;
use Illuminate\Support\Facades\Auth;

class CreateStok extends Component
{
    public Barang $barang;
    public Gudang $gudang;
    public $modal = false;
    public $disabled = false;
    public $data;
    public $supplier = [
        'id' => null,
        'nama' => null,
        'alamat' => null,
        'telp' => null,
        'stok' => null
    ];

    public function open()
    {
        $this->modal = true;
    }

    public function close()
    {
        $this->modal = false;
    }

    public function updatedData($id)
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
            'supplier.nama' => 'required',
            'supplier.stok' => 'required|numeric',
        ], [
            'supplier.nama.required' => 'Supplier tidak boleh kosong',
            'supplier.stok.required' => 'Stok tidak boleh kosong',
            'supplier.stok.numeric' => 'Stok harus berupa angka'
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

        // SupplierBarang store
        SupplierBarang::create([
            'supplier_id' => $supplier['id'],
            'barang_id' => $this->barang['id'],
            'stok' => $this->supplier['stok']
        ]);

        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah Stok Barang ('. $this->barang['kode'] .')'
        ]);
        
        return redirect()->route('barang.show', ['gudang' => $this->gudang, 'barang' => $this->barang])->with('message', 'Stok Berhasil di-Tambah');
    }
    
    public function render()
    {
        return view('livewire.create-stok', [
            'suppliers' => Supplier::orderBy('id', 'desc')->get(),
            'barang' => $this->barang,
            'gudang' => $this->gudang
        ]);
    }
}
