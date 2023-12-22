<?php

namespace App\Livewire;

use App\Models\Log;
use App\Models\Barang;
use App\Models\Gudang;
use Livewire\Component;
use App\Models\SupplierBarang;
use Illuminate\Support\Facades\Auth;

class DeleteSupplierBarang extends Component
{
    public Barang $barang;
    public Gudang $gudang;
    public SupplierBarang $supplier_barang;
    public $modal = false;

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(SupplierBarang $supplier_barang)
    {
        // Delete data
        $supplier_barang->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Stok Barang ('. $this->barang->kode .')'
        ]);
        
        return redirect()->route('barang.show', ['gudang' => $this->gudang, 'barang' => $this->barang])->with('message','Stok Barang ('. $this->barang->kode .') Berhasil di Hapus');
    }
    
    public function render()
    {
        return view('livewire.delete-supplier-barang', [
            'gudang' => $this->gudang,
            'barang' => $this->barang,
            'supplier_barang' => $this->supplier_barang,
        ]);
    }
}
