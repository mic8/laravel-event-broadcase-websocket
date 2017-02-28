<?php

namespace App\Jobs\Post;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Models\Post;

class CreatePostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $post;

    public $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, array $params)
    {
        $this->post = $post;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->post->create($this->params);
    }
}
