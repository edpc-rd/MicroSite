<?php

namespace App\Listeners\Frontend\Auth;

use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

/**
 * Class UserRegisteredListener
 * @package App\Listeners\Frontend\Auth
 */
class UserRegisteredListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event handler.
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
     * @param  UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        \Log::info('User Registered: ' . $event->user->user_name);
    }
}
