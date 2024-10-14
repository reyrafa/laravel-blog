<?php

namespace App\Http\Requests\Comment;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $post = $this->getPost();

        if (!$post) {
            return false;
        }

        return Auth::user()->id !== $post->user->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
            ],
            'post_id' => [
                'required',
                'exists:posts,id',
            ],
            'content' => [
                'required',
                'string',
                'max:255',
            ],

        ];
    }

    public function prepareForValidation()
    {
        $post = $this->getPost();
        $this->merge([
            'user_id' => Auth::user()->id,
            'post_id' => $post ? $post->id : null,
        ]);
    }

    private function getPost()
    {
        $post = Post::where('uuid', $this->post_uuid)->first();
        return $post;
    }
}
