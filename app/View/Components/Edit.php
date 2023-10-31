<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Edit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $title = null,
        public $navigation = null,
        public $route = false,
        public $button = false,
    )
    {
        $this->title = $title;
        $this->navigation = $navigation;
        $this->route = $route;
        $this->button = $button;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit');
    }
}
