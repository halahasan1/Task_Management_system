<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskIndexRequest;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskUpdateRequest;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of tasks.
     */
    public function index(TaskIndexRequest $request)
    {
        try {
            $filters = $request->only(['title', 'priority', 'created_by', 'assigned_to']);
            $tasks = $this->taskService->getFilteredTasks($filters);
            return $this->successResponse($tasks, 'Filtered task list retrieved.');
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to fetch tasks.', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created task.
     */
    public function store(TaskStoreRequest $request): JsonResponse
    {
        try {
            $task = $this->taskService->create($request->validated());

            return $this->successResponse($task, 'Task created successfully.', 201);
        } catch (Throwable $e) {
            return $this->errorResponse('Task creation failed.', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task): JsonResponse
    {
        $this->authorize('view', $task);

        return $this->successResponse($task->load(['status', 'creator', 'assignee']), 'Task details retrieved.');
    }

    /**
     * Update the specified task.
     */
    public function update(TaskUpdateRequest $request, Task $task): JsonResponse
    {
        try {
            $updated = $this->taskService->update($task, $request->validated());

            return $this->successResponse($updated, 'Task updated successfully.');
        } catch (Throwable $e) {
            return $this->errorResponse('Task update failed.', 500, ['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified task.
     */
    public function destroy(Task $task): JsonResponse
    {
        try {
            $this->authorize('delete', $task);

            $this->taskService->delete($task);

            return $this->successResponse(null, 'Task deleted successfully.');
        } catch (Throwable $e) {
            return $this->errorResponse('Task deletion failed.', 500, ['error' => $e->getMessage()]);
        }
    }
}
