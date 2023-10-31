<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DeleteBarang extends Component
{
    public $modal = false;
    public Barang $barang;
    public Gudang $gudang;

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(Barang $barang)
    {
        // Delete data
        $barang->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Barang ('. $barang->kode .')'
        ]);
        
        return redirect()->route('barang.index', ['gudang' => $this->gudang])->with('message','Barang ('. $barang->kode .') Berhasil di Hapus');
    }

    public function render()
    {
        return view('livewire.delete-barang', [
            'barang' => $this->barang,
        ]);
    }
}
