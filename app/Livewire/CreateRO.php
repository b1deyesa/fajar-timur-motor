<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use App\Models\DetailRO;
use App\Models\Gudang;
use App\Models\RO;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\SupplierBarang;
use Illuminate\Support\Facades\Auth;

class CreateRO extends Component
{
    public $step = 1;
    public $disabled_supplier = false;
    public $disabled_barang = false;
    public $datasup;
    public $suppliers;
    public $barangs;
    public $supplier = [
        'id' => null,
        'nama' => null,
        'alamat' => null,
        'telp' => null,
    ];
    public $barang = [
        0 => null
    ];
    public $values = [
        [
            'id' => null,
            'nama' => null,
            'merek' => null,
            'deskripsi' => null,
            'harga_beli' => null,
            'stok_diminta' => null,
        ]
    ];


    public function mount()
    {
        $this->suppliers = Supplier::orderBy('id', 'desc')->get();
        $this->barangs = Barang::orderBy('id', 'desc')->get();
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
        $this->step = 1;
    }

    public function tambah()
    {
        $this->barang[] = null;
        $this->values[] = [
            'id' => null,
            'nama' => null,
            'merek' => null,
            'deskripsi' => null,
            'harga_beli' => null,
            'stok_diminta' => null,
        ];
    }

    public function hapus($key)
    {
        unset($this->values[$key]);
        $this->values = array_values($this->values);

        unset($this->barang[$key]);
        $this->barang = array_values($this->barang);
    }

    public function submit()
    {
        $this->validate([
            'values.*.nama' => 'required',
            'values.*.harga_beli' => 'required|numeric',
            'values.*.stok_diminta' => 'required|numeric'
        ], [
            'values.*.nama.required' => 'Nama barang tidak boleh kosong',
            'values.*.harga_beli.required' => 'Harga beli tidak boleh kosong',
            'values.*.harga_beli.numeric' => 'Harga beli harus berupa angka',
            'values.*.stok_diminta.required' => 'Stok tidak boleh kosong',
            'values.*.stok_diminta.numeric' => 'Stok harus berupa angka'
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
                'task' => 'Tambah Supplier (' . $supplier->kode . ')'
            ]);
        } else {
            $supplier = $this->supplier;
        }

        // RO 
        $kode_ro = 'RO-' . sprintf('%05d', RO::all()->max('id') + 1);

        $ro = RO::create([
            'kode' =>  $kode_ro,
            'user_id' => Auth::id(),
            'supplier_id' => $supplier['id']
        ]);
        
        // Barang
        foreach ($this->values as $value) {
            if ($value['id'] == null) {
                // Generate kode
                $kode_barang = 'BRG-' . sprintf('%05d', Barang::all()->max('id') + 1);

                // Store data
                $barang = Barang::create([
                    'gudang_id' => Gudang::first()->id,
                    'kode' => $kode_barang,
                    'nama' => $value['nama'],
                    'merek' => $value['merek'],
                    'deskripsi' => $value['deskripsi'],
                ]);

                // Log
                Log::create([
                    'user_id' => Auth::id(),
                    'task' => 'Tambah Barang (' . $barang->kode . ')'
                ]);
            } else {
                $barang = $value;
            }

            $supplier_barang = SupplierBarang::create([
                'supplier_id' => $supplier['id'],
                'barang_id' => $barang['id'],
                'harga_beli' => $value['harga_beli'],
                'stok' => 0,
            ]);

            DetailRO::create([
                'r_o_id' => $ro['id'],
                'supplier_barang_id' => $supplier_barang['id'],
                'status' => 'Dalam Proses',
                'stok_diminta' => $value['stok_diminta'],
            ]);
        }

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Buat Request Order ('. $ro->kode .')'
        ]);

        return redirect()->route('ro.index')->with('message', 'RO berhasil dibuat');
    }

    public function updatedDatasup($id)
    {
        if ($id != null or $id != "") {
            $supplier = Supplier::find($id);
            $this->supplier['id'] = $supplier->id;
            $this->supplier['nama'] = $supplier->nama;
            $this->supplier['alamat'] = $supplier->alamat;
            $this->supplier['telp'] = $supplier->telp;
            $this->disabled_supplier = true;
        } else {
            $this->supplier['id'] = null;
            $this->supplier['nama'] = null;
            $this->supplier['alamat'] = null;
            $this->supplier['telp'] = null;
            $this->disabled_supplier = false;
        }
    }

    public function updatedBarang($id, $key)
    {
        if ($id != '') {
            $barang = Barang::find($id);
            $this->values[$key]['id'] = $barang->id;
            $this->values[$key]['nama'] = $barang->nama;
            $this->values[$key]['merek'] = $barang->merek;
            $this->values[$key]['deskripsi'] = $barang->deskripsi;
        } else {
            $this->values[$key]['id'] = null;
            $this->values[$key]['nama'] = null;
            $this->values[$key]['merek'] = null;
            $this->values[$key]['deskripsi'] = null;
        }
    }

    public function render()
    {
        $this->dispatch('selectl');
        return view('livewire.create-r-o');
    }
}
