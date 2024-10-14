<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
    ];

    /**
     * relation to user table
     * user_id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * relation to post table
     * post_id
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
