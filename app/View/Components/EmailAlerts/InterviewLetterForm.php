<?php

namespace App\View\Components\EmailAlerts;

use Illuminate\View\Component;

class InterviewLetterForm extends Component
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
        return view('components.email-alerts.interview-letter-form');
    }
}
