<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    protected $filllable = [
        'name'
    ];

    /**
     * Get all tasks associated with this status
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks():HasMany
    {
        return $this->hasMany(Task::class);
    }
}
