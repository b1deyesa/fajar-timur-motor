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
        'username' => null,
        'nama' => null,
        'alamat' => null,
        'telp' => null,
        'role' => null,
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
            'value.username' => 'required|regex:/^\S*$/u|unique:users,username|lowercase|min:3',
            'value.nama' => 'required',
            'value.role' => 'required',
            'value.password' => 'required|min:8',
        ], [
            'value.username.required' => 'Username tidak boleh kosong',
            'value.nama.required' => 'Nama admin tidak boleh kosong',
            'value.role.required' => 'Role harus dipilih',
            'value.password.required' => 'Password tidak boleh kosong',
            'value.password.min' => 'Password minimal 8 karakter',
            'value.username.regex' => 'Username tidak boleh ada spasi',
            'value.username.unique' => 'Username sudah ada, pilih yang lain',
            'value.username.lowercase' => 'Username harus huruf kecil',
            'value.username.min' => 'Username minimal 3 karakter',
        ]);

        // Store data
        $user = User::create([
            'username' => $this->value['username'],
            'nama' => $this->value['nama'],
            'alamat' => $this->value['alamat'],
            'telp' => $this->value['telp'],
            'role' => $this->value['role'],
            'password' => bcrypt($this->value['password']),
        ]);

        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Tambah Admin ('. $user->username .')'
        ]);

        return redirect()->route('user.index')->with('message', $user->role . ' ('. $user->username .') Berhasil di Tambah!');
    }
    public function render()
    {
        return view('livewire.create-user');
    }
}
