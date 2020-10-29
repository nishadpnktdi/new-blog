<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NotifyAdminUserCreation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendAdminNewUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NotifyAdminUserCreation($event->user));
    }
}
