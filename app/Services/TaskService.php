<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    /**
     * Create a new task with the given data.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task
    {
        return Task::create([
            'title'        => $data['title'],
            'description'  => $data['description'] ?? null,
            'status_id'    => $data['status_id'],
            'created_by'   => Auth::id(),
            'assigned_to'  => $data['assigned_to'],
            'priority'     => $data['priority'] ,
        ]);
    }

    /**
     * Update an existing task with new data.
     *
     * @param Task  $task
     * @param array $data
     * @return Task
     */
    public function update(Task $task, array $data): Task
    {
        $task->update($data);

        return $task;
    }

    /**
     * Delete the specified task.
     *
     * @param Task $task
     * @return bool|null
     */
    public function delete(Task $task): ?bool
    {
        return $task->delete();
    }

    public function getFilteredTasks(array $filters)
    {
        $query = Task::query();

        // Search by title
        if (!empty($filters['search'])) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        // Filter by priority
        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        // Filter by creator
        if (!empty($filters['created_by'])) {
            $query->where('created_by', $filters['created_by']);
        }

        // Filter by assigned_to
        if (!empty($filters['assigned_to'])) {
            $query->where('assigned_to', $filters['assigned_to']);
        }

        // Filter by status
        if (!empty($filters['status_id'])) {
            $query->where('status_id', $filters['status_id']);
        }

        return $query->with(['status', 'creator', 'assignee'])->latest()->paginate(10);
    }
}
