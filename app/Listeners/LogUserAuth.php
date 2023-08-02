<?php

namespace App\Listeners;

use App\Events\UserAuthLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogUserAuth implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserAuthLogEvent $event): void
    {
        DB::table('user_history')->insert(
            [
                'username' => $event->user->username,
                'email' => $event->user->email,
                'created_at' => $event->created_at
            ],
        );
    }

    public $queue = 'listeners';
}
