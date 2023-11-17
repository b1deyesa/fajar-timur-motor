<?php

namespace App\Livewire;

use App\Models\Log;
use Livewire\Component;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DeleteDetailTransaksi extends Component
{
    public DetailTransaksi $detail_transaksi;
    public Transaksi $transaksi;
    public $modal = false;
    
    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(DetailTransaksi $detail_transaksi)
    {
        // Delete data
        $detail_transaksi->delete();
        $this->transaksi->update(['total' => $this->transaksi->sum() + $this->transaksi->harga_pengiriman]);
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Detail Transaksi'
        ]);
        
        return redirect()->route('detail-transaksi.index', ['transaksi' => $this->transaksi, 'detail_transaksi' => $this->detail_transaksi])->with('message','Detail Transaksi Berhasil di Hapus');
    }
    
    public function render()
    {
        return view('livewire.delete-detail-transaksi', [
            'detail_transaksi' => $this->detail_transaksi,
            'transaksi' => $this->transaksi,
        ]);
    }
}
