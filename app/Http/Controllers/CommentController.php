<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\DestroyCommentRequest;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $validated_request = $request->validated();
        $comment = Comment::create($validated_request);

        return redirect()->route("posts.show", $comment->post->uuid);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyCommentRequest $request, string $id)
    {
        $comment = Comment::find($id);
        $post = Post::find($comment->post_id);

        $comment->delete();

        return redirect()->route('posts.show', $post->uuid);
    }
}
