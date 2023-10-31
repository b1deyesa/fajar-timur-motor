<?php

namespace App\Livewire;

use App\Models\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginKasir extends Component
{
    public $modal = false;
    public $failed = false;
    public $value = [];

    public function open()
    {
        return $this->modal = true;
    }
    
    public function close()
    {
        $this->failed = false;
        $this->value = [];
        return $this->modal = false;
    }

    public function message()
    {
        return $this->failed = true;
    }
    
    public function submit()
    {
        // Validate
        $this->validate([
            'value.username' => 'required',
            'value.password' => 'required',
        ], [
            'value.username.required' => 'ID tidak boleh kosong',
            'value.password.required' => 'Password tidak boleh kosong'
        ]);

        // Success username and password
        if (Auth::attempt($this->value)) {
            // Log
            Log::create([
                'user_id' => Auth::id(),
                'task' => 'Login Menu Transaksi'
            ]);

            return redirect()->route('kasir.index');
        }

        // Show failed message
        return $this->message();
    }
    
    public function render()
    {
        return view('livewire.login-kasir');
    }
}
