<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CreateUser extends Component
{
    public $modal = false;
    public $value = [
        'nama' => null,
        'alamat' => null,
        'telp' => null,
        'password' => null,
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
            'value.password' => 'required|min:8',
        ], [
            'value.nama.required' => 'Nama admin tidak boleh kosong',
            'value.password.required' => 'Password tidak boleh kosong',
            'value.password.min' => 'Password minimal 8 karakter',
        ]);

        // Generate kode
        $kode = 'USR' . sprintf('%03d', User::all()->max('id') + 1);
        
        // Store data
        User::create([
            'username' => $kode,
            'nama' => $this->value['nama'],
            'alamat' => $this->value['alamat'],
            'telp' => $this->value['telp'],
            'password' => bcrypt($this->value['password']),
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah Admin ('. $kode .')'
        ]);

        return redirect()->route('user.index')->with('message', 'Admin ('. $kode .') Berhasil di Tambah!');
    }
    public function render()
    {
        return view('livewire.create-user');
    }
}
