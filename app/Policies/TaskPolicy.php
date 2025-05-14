<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use App\Enums\Permission;
use Illuminate\Support\Facades\Log;

class TaskPolicy
{
    /**
     * Allow manager to perform all actions
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'manager') {
            return true;
        }

        return null;
    }

    /**
     * Log every policy decision
     */
    public function after(User $user, string $ability, ?bool $result): void
    {
        Log::info("Policy Check: {$user->name} tried {$ability} → " . ($result ? 'allowed' : 'denied'));
    }

    /**
     * Can the user view this task?
     */
    public function view(User $user, Task $task): bool
    {
        return $user->hasPermission(Permission::TASK_VIEW)
            && ($user->id === $task->created_by || $user->id === $task->assigned_to);
    }

    /**
     * Can the user create tasks?
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permission::TASK_CREATE);
    }

    /**
     * Can the user update this task?
     */
    public function update(User $user, Task $task): bool
    {
        return $user->hasPermission(Permission::TASK_UPDATE)
            && ($user->id === $task->created_by || $user->id === $task->assigned_to);
    }

    /**
     * Can the user delete this task?
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->hasPermission(Permission::TASK_DELETE)
            && $user->id === $task->created_by;
    }

}
