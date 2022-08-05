<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BreadCrumbComponent extends Component
{

    public $modal, $modalId, $modalType, $showClock;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modal = false, $modalType = null, $modalId = null, $showClock = "true")
    {
        if ($modalType == 'Leave' && auth()->user()->role == 'admin')
            $this->modal = false;
        else
            $this->modal = $modal;
        $this->modalId = $modalId;
        $this->modalType = $modalType;
        $this->showClock = $showClock;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.bread-crumb-component');
    }
}
