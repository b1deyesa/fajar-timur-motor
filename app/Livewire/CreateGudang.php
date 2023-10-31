<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Gudang;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateGudang extends Component
{
    public $modal = false;
    public $value = [
        'nama' => null,
        'alamat' => null,
        'kapasitas' => null,
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
            'value.kapasitas' => 'required|numeric',
        ], [
            'value.nama.required' => 'Nama gudang tidak boleh kosong',
            'value.kapasitas.required' => 'Isi angka 0 bila kapasitas belum diketahui',
            'value.kapasitas.numeric' => 'Input kapasitas harus berupa angka',
        ]);

        // Generate kode
        $kode = 'GDG-' . sprintf('%03d', Gudang::all()->max('id') + 1);
        
        // Store data
        Gudang::create([
            'kode' => $kode,
            'nama' => $this->value['nama'],
            'alamat' => $this->value['alamat'],
            'kapasitas' => $this->value['kapasitas'],
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah Gudang ('. $kode .')'
        ]);

        return redirect()->route('gudang.index')->with('message', 'Gudang ('. $kode .') Berhasil di Tambah!');
    }
    
    public function render()
    {
        return view('livewire.create-gudang');
    }
}
