<?php

namespace App\Listeners\User;

use App\Events\User\UserDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteUser implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  UserDeleted  $event
     * @return void
     */
    public function handle(UserDeleted $event)
    {
        if(true) {
            $this->release(30);
        }
    }

    public function failed(UserDeleted $event, $exception)
    {
        return $exception;
    }
}
