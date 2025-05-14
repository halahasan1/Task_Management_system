<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Permission;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the tasks created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdTasks():HasMany
    {
        return $this->hasMany(Task::class,'created_by');
    }
    /**
     * Get the tasks assigned to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedTasks():HasMany
    {
        return $this->hasMany(Task::class,'assigned_to');
    }


    /**
     * Get all comments written by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Determine whether the user has a given permission based on their role.
     *
     * Managers have all permissions by default.
     * Team leads and members have limited access according to their roles.
     *
     * @param  \App\Enums\Permission  $permission
     * @return bool  True if the user has the specified permission, false otherwise.
     */
    public function hasPermission(Permission $permission): bool
    {
        return match ($this->role) {
            'manager' => true,

            'team-lead' => in_array($permission, [
                Permission::TASK_CREATE,
                Permission::TASK_VIEW,
                Permission::TASK_UPDATE,
                Permission::COMMENT_CREATE,
                Permission::COMMENT_VIEW,
                Permission::COMMENT_UPDATE,
                Permission::COMMENT_DELETE,
            ]),

            'member' => in_array($permission, [
                Permission::TASK_VIEW,
                Permission::COMMENT_CREATE,
                Permission::COMMENT_VIEW,
                Permission::COMMENT_UPDATE,
                Permission::COMMENT_DELETE,
            ]),

            default => false,
        };
    }
}
