<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteUser extends Component
{
    public User $user;
    public $modal = false;

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(User $user)
    {
        // Delete data
        $user->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Admin ('. $user->username .')'
        ]);
        
        return redirect()->route('user.index')->with('message','Admin ('. $user->username .') Berhasil di Hapus');
    }

    public function render()
    {
        return view('livewire.delete-user');
    }
}
