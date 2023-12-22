<?php

namespace App\Livewire;

use App\Models\RO;
use App\Models\Log;
use Livewire\Component;
use App\Models\DetailRO;
use Illuminate\Support\Facades\Auth;

class DeleteDetailRO extends Component
{
    public DetailRO $detail_ro;
    public RO $ro;
    public $modal = false;

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(DetailRO $detail_ro)
    {
        // Delete data
        $detail_ro->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Barang di RO ('. $this->ro->kode .')'
        ]);
        
        return redirect()->route('ro.show', ['ro' => $this->ro])->with('message','Barang RO ('. $this->ro->kode .') Berhasil di Hapus');
    }
    
    public function render()
    {
        return view('livewire.delete-detail-r-o', [
            'ro' => $this->ro,
            'detail_ro' => $this->detail_ro
        ]);
    }
}
