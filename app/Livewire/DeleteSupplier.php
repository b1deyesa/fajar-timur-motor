<?php

namespace App\Livewire;

use App\Models\Log;
use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

class DeleteSupplier extends Component
{
    public Supplier $supplier;
    public $modal = false;

    public function open()
    {
        $this->modal = true;
    }
    
    public function close()
    {
        $this->modal = false;
    }
    
    public function delete(Supplier $supplier)
    {
        // Delete data
        $supplier->delete();
        
        // Log
        Log::create([
            'user_id' => Auth::id(),
            'task' => 'Hapus Supplier ('. $supplier->kode .')'
        ]);
        
        return redirect()->route('supplier.index')->with('message','Supplier ('. $supplier->kode .') Berhasil di Hapus');
    }
    
    public function render()
    {
        return view('livewire.delete-supplier', [
            'supplier' => $this->supplier
        ]);
    }
}
