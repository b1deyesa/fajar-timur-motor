<?php

namespace App\View\Components;

use App\Models\Transaksi;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class invoice extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Transaksi $transaksi,
        public $title = ['BON ASLI', 'BON COPY']
    )
    {
        $this->transaksi = $transaksi;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.invoice');
    }
}
