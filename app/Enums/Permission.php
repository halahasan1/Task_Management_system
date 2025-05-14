<?php

namespace App\Enums;

enum Permission: string
{
    // Status management
    case MANAGE_STATUSES = 'manage-statuses';

    // Task permissions
    case TASK_CREATE = 'task-create';
    case TASK_VIEW   = 'task-view';
    case TASK_UPDATE = 'task-update';
    case TASK_DELETE = 'task-delete';

    // Comment permissions
    case COMMENT_CREATE = 'comment-create';
    case COMMENT_VIEW   = 'comment-view';
    case COMMENT_UPDATE = 'comment-update';
    case COMMENT_DELETE = 'comment-delete';
}
