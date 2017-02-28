<?php

namespace App\Listeners\User;

use App\Events\User\UserAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreUser implements ShouldQueue
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
     * @param  UserAdded  $event
     * @return void
     */
    public function handle(UserAdded $event)
    {
        if(true) {
            $this->release(30);
        }
    }

    public function failed(UserAdded $event, $exception)
    {
        return $exception;
    }
}
