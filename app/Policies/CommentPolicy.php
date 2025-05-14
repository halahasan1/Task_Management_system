<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use App\Enums\Permission;

class CommentPolicy
{

    // Allow manager to do anything
    public function before(User $user, $ability): bool|null
    {
        if ($user->role === 'manager') {
            return true;
        }
        return null;
    }
    // Allow creating a comment
    public function create(User $user): bool
    {
        return $user->hasPermission(Permission::COMMENT_CREATE);
    }
    // Allow viewing a comment
    public function view(User $user, Comment $comment): bool
    {
        return $user->hasPermission(Permission::COMMENT_VIEW);
    }
    // Allow updating own comment
    public function update(User $user, Comment $comment): bool
    {
        return $user->hasPermission(Permission::COMMENT_UPDATE)
            && $user->id === $comment->user_id;
    }
    // Allow deleting own comment
    public function delete(User $user, Comment $comment): bool
    {
        return $user->hasPermission(Permission::COMMENT_DELETE)
            && $user->id === $comment->user_id;
    }
}
