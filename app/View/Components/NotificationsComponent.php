<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class NotificationsComponent extends Component
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
        $user = User::find(auth()->id());
        return view('components.notifications-component', [
            'notifications' => $user->notifications
        ]);
    }
}
