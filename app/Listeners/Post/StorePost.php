<?php

namespace App\Listeners\Post;

use App\Events\Post\PostAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StorePost implements ShouldQueue
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
     * @param  PostAdded  $event
     * @return void
     */
    public function handle(PostAdded $event)
    {
        if(true) {
            $this->release(30);
        }
    }

    /**
     * @param PostAdded $event
     * @param $exception
     * @return mixed
     */
    public function failed(PostAdded $event, $exception)
    {
        return $exception;
    }
}
