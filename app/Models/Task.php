<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status_id',
        'assigned_to',
        'created_by',
    ];

    /**
     * Get the user who created the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    /**
     * Get the user assigned to the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function assignee():BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Get the status of the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status():BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get all comments for the task.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
