<?php

namespace App\Services;

use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;

class StatusService
{
    /**
     * Get all statuses.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Status::all();
    }

    /**
     * Create a new status.
     */
    public function create(array $data): Status
    {
        return Status::create($data);
    }

    /**
     * Update a status.
     */
    public function update(Status $status, array $data): Status
    {
        $status->update($data);
        return $status;
    }

    /**
     * Delete a status.
     */
    public function delete(Status $status): bool
    {
        return $status->delete();
    }
}
