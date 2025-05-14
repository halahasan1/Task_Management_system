<?php

namespace App\Services;


use App\Models\Comment;

class CommentService
{
    /**
     * Create a new comment.
     */
    public function create(array $data): Comment
    {
        return Comment::create($data);
    }

    /**
     * Update an existing comment.
     */
    public function update(Comment $comment, array $data): Comment
    {
        $comment->update($data);
        return $comment;
    }

    /**
     * Delete a comment.
     */
    public function delete(Comment $comment): void
    {
        $comment->delete();
    }
}
