<?php

namespace App\Http\Controllers\Api;

use App\Models\Status;
use App\Enums\Permission;
use Illuminate\Http\Request;
use App\Services\StatusService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Status\StatusStoreRequest;
use App\Http\Requests\Status\StatusUpdateRequest;

class StatusController extends Controller
{
    protected StatusService $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * Display a listing of statuses.
     */
    public function index():JsonResponse
    {
        try {
            $statuses = $this->statusService->getAll();
            return $this->successResponse($statuses, 'Statuses retrieved successfully.');
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to load statuses.', 500, [$e->getMessage()]);
        }
    }
    /**
     * Store a newly created status.
     */
    public function store(StatusStoreRequest $request):JsonResponse
    {
        try {
            $status = $this->statusService->create($request->validated());
            return $this->successResponse($status, 'Status created successfully.', 201);
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to create status.', 500, [$e->getMessage()]);
        }
    }

    /**
     * Update the specified status.
     */
    public function update(StatusUpdateRequest $request, Status $status):JsonResponse
    {
        try {
            $updated = $this->statusService->update($status, $request->validated());
            return $this->successResponse($updated, 'Status updated successfully.');
        } catch (\Throwable $e) {
            return $this->errorResponse('Failed to update status.', 500, [$e->getMessage()]);
        }
    }

    /**
     * Remove the specified status.
     */
    public function destroy(Status $status):JsonResponse
    {
        if (Gate::denies(Permission::MANAGE_STATUSES->value)) {
            return $this->errorResponse('You do not have permission to delete this status.', 403);
        }

        $status->delete();

        return $this->successResponse(null, 'Status deleted successfully.');
    }

}
