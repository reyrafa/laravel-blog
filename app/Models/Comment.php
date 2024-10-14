<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
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
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * get comment by id
     * @param mixed $id
     * @return TModel|\Illuminate\Database\Eloquent\Collection|null
     */
    public function getComment($id = null)
    {
        return $this->find($id);
    }
}
