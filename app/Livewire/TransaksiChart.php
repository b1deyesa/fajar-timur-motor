<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaksi;

class TransaksiChart extends Component
{
    public $count;
    public $total;
    public $filter = 'week';

    public function mount() 
    {
        // Render day of this week
        $this->count = now()->dayOfWeekIso;
    }

    public function updatedFilter()
    {
        if($this->filter == 'month') {
            // Set count to day of month
            $this->count = now()->day;
        } elseif ($this->filter == 'week') {
            // Set count to day of this week
            $this->count = now()->dayOfWeekIso;
        }
    }

    public function render()
    {
        return view('livewire.transaksi-chart', [
            'transaksis' => Transaksi::orderBy('id', 'desc')->get(),
        ]);
    }
}
