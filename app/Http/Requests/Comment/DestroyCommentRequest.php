<?php

namespace App\Http\Requests\Comment;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DestroyCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $comment = new Comment();
        $fetched_comment = $comment->getComment($this->comment);

        if (!$fetched_comment || !$fetched_comment->post) {
            return false;
        }
        return $fetched_comment->user_id === Auth::user()->id || $fetched_comment->post->user->id === Auth::user()->id;
    }

}
