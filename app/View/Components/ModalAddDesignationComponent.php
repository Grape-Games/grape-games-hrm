<?php

namespace App\View\Components;

use App\Models\ParentDesignation;
use Illuminate\View\Component;

class ModalAddDesignationComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view(
            'components.modal-add-designation-component',
            [
                'parent_designations' => ParentDesignation::all(),
            ]
        );
    }
}
