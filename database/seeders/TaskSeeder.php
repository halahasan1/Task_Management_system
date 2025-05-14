<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Status;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $statuses = Status::all();
        $users = User::all();

        Task::create([
            'title' => 'Design New Website',
            'description' => 'Design the wireframe for the new website launch.',
            'status_id' => $statuses->firstWhere('name', 'Open')->id,
            'assigned_to' => $users->firstWhere('role', 'team-lead')->id,
            'priority' => 'high',
            'created_by' => $users->first()->id,
        ]);

        Task::create([
            'title' => 'Develop API Endpoints',
            'description' => 'Create necessary API endpoints for the application.',
            'status_id' => $statuses->firstWhere('name', 'In Progress')->id,
            'assigned_to' => $users->firstWhere('role', 'member')->id,
            'priority' => 'medium',
            'created_by' => $users->first()->id,
        ]);

        Task::create([
            'title' => 'Write Documentation',
            'description' => 'Write documentation for the project to ensure smooth handover.',
            'status_id' => $statuses->firstWhere('name', 'Completed')->id,
            'assigned_to' => $users->firstWhere('role', 'member')->id,
            'priority' => 'low',
            'created_by' => $users->first()->id,
        ]);

        Task::create([
            'title' => 'Fix Bugs in Production',
            'description' => 'Fix critical bugs reported by users in the production environment.',
            'status_id' => $statuses->firstWhere('name', 'In Progress')->id,
            'assigned_to' => $users->firstWhere('role', 'team-lead')->id,
            'priority' => 'high',
            'created_by' => $users->first()->id,
        ]);

        Task::create([
            'title' => 'Deploy to Production',
            'description' => 'Deploy the new release to production servers.',
            'status_id' => $statuses->firstWhere('name', 'On Hold')->id,
            'assigned_to' => $users->firstWhere('role', 'team-lead')->id,
            'priority' => 'medium',
            'created_by' => $users->first()->id,
        ]);
    }
}

