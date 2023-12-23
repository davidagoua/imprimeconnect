<?php

namespace App\Livewire\Components;

use Livewire\Component;

class NotificationWidget extends Component
{
    public $count = 0;

    public function increment()
    {
        auth()->user()->unreadNotifications->markAsRead();

    }

    public function render()
    {
        return view('livewire.components.notification-widget')->with([
            'notifications'=>auth()->user()->unreadNotifications
        ]);
    }
}
