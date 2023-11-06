<?php

namespace App\Livewire;

use App\Models\Barang;
use Livewire\Component;

class StatusBarang extends Component
{
    public $modal = false;
    public $data;
    
    public function open()
    {
        $this->modal = true;
    }

    public function close()
    {
        $this->modal = false;
    }

    public function render()
    {
        return view('livewire.status-barang', [
            'barangs' => Barang::all()
        ]);
    }
}
