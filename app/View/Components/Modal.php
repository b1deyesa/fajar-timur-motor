<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $class = 'modal-form',
        public $label = null,
        public $color = null,
        public $title = null,
        public $navigation = null,
        public $modal = false
    )
    {
        $this->class = $class;
        $this->label = $label;
        $this->color = $color;
        $this->title = $title;
        $this->navigation = $navigation;
        $this->modal = $modal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
