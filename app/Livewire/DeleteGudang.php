<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Gudang;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteGudang extends Component
{
    public $modal = false;
    public Gudang $gudang;

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(Gudang $gudang)
    {
        // Delete data
        $gudang->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Gudang ('. $gudang->kode .')'
        ]);
        
        return redirect()->route('gudang.index')->with('message','Gudang ('. $gudang->kode .') Berhasil di Hapus');
    }
    
    public function render()
    {        
        return view('livewire.delete-gudang', [
            'gudang' => $this->gudang
        ]);
    }
}
