<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $tasks = Task::all();
        $users = User::all();

        Comment::create([
            'task_id' => $tasks->first()->id,
            'user_id' => $users->first()->id,
            'content' => 'This task looks good to go, let me know if you need anything.',
        ]);

        Comment::create([
            'task_id' => $tasks->first()->id,
            'user_id' => $users->firstWhere('role', 'team-lead')->id,
            'content' => 'I have started working on it. Will keep you posted.',
        ]);

        Comment::create([
            'task_id' => $tasks->firstWhere('title', 'Develop API Endpoints')->id,
            'user_id' => $users->firstWhere('role', 'member')->id,
            'content' => 'I am facing some issues with the authentication system.',
        ]);

        Comment::create([
            'task_id' => $tasks->firstWhere('title', 'Fix Bugs in Production')->id,
            'user_id' => $users->firstWhere('role', 'team-lead')->id,
            'content' => 'The bugs are now fixed and the release is ready.',
        ]);

        Comment::create([
            'task_id' => $tasks->firstWhere('title', 'Deploy to Production')->id,
            'user_id' => $users->firstWhere('role', 'member')->id,
            'content' => 'Deployment has been paused until further notice.',
        ]);
    }
}

