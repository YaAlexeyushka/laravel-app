<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Resources\CommentResource;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['user', 'post'])
            ->approved()
            ->recent(50)
            ->paginate(20);

        return CommentResource::collection($comments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'is_approved' => 'boolean',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $comment = Comment::create($validated);

        if (isset($validated['tag_ids'])) {
            $comment->tags()->attach($validated['tag_ids']);
        }

        return new CommentResource($comment->load(['user', 'post', 'tags']));
    }

    public function show(Comment $comment)
    {
        return new CommentResource($comment->load(['user', 'post', 'tags']));
    }

    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => 'string',
            'is_approved' => 'boolean',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $comment->update($validated);

        if (isset($validated['tag_ids'])) {
            $comment->tags()->sync($validated['tag_ids']);
        }

        return new CommentResource($comment->load(['user', 'post', 'tags']));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function restore($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        $comment->restore();

        return new CommentResource($comment->load(['user', 'post', 'tags']));
    }

    public function forceDelete($id)
    {
        $comment = Comment::withTrashed()->findOrFail($id);
        $comment->forceDelete();

        return response()->json(['message' => 'Comment permanently deleted']);
    }
}
