<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User as User;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = ['user_id', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}