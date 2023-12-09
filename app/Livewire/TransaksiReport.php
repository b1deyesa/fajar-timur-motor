<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Transaksi;

class TransaksiReport extends Component
{    
    public $transaksis;
    public $filter = 'all';
    public $start = null;
    public $end = null;
    public $show = false;

    public function mount()
    {
        $this->transaksis = Transaksi::all();
    }

    public function updatedFilter($value)
    {
        if ($value == 'day') {
            $this->transaksis =  Transaksi::whereDay('created_at', Carbon::now()->day)->orderBy('created_at', 'asc')->get();
        } elseif ($value == 'month') {
            $this->transaksis =  Transaksi::whereMonth('created_at', Carbon::now()->month)->orderBy('created_at', 'asc')->get();
        } elseif ($value == 'year') {
        } else {
            $this->transaksis = Transaksi::orderBy('created_at', 'asc')->get();
        }
    }

    public function updatedStart($value)
    {
        $this->transaksis = Transaksi::whereBetween('created_at', [$value, $this->end])->orderBy('created_at', 'asc')->get();
    }

    public function updatedEnd($value)
    {
        $this->transaksis = Transaksi::whereBetween('created_at', [$this->start, Carbon::tomorrow()->$value])->orderBy('created_at', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.transaksi-report');
    }
}
