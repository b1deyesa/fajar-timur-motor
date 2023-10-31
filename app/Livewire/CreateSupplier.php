<?php

namespace App\Livewire;

use App\Models\Log;
use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class CreateSupplier extends Component
{
    public $modal = false;
    public $value = [
        'nama' => null,
        'alamat' => null,
        'telp' => null,
    ];

    public function open()
    {
        $this->modal = true;
    }

    public function close()
    {
        $this->modal = false;
        
        // Clear value
        $this->value = [];
    }

    public function submit()
    {        
        // Validate value request
        $this->validate([
            'value.nama' => 'required',
        ], [
            'value.nama.required' => 'Nama supplier tidak boleh kosong',
        ]);

        // Generate kode
        $kode = 'SUP-' . sprintf('%03d', Supplier::all()->max('id') + 1);
        
        // Store data
        Supplier::create([
            'kode' => $kode,
            'nama' => $this->value['nama'],
            'alamat' => $this->value['alamat'],
            'telp' => $this->value['telp'],
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah Supplier ('. $kode .')'
        ]);

        return redirect()->route('supplier.index')->with('message', 'Supplier ('. $kode .') Berhasil di Tambah!');
    }

    public function render()
    {
        return view('livewire.create-supplier');
    }
}
