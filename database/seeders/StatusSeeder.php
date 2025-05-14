<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create([
            'name' => 'Open',
        ]);

        Status::create([
            'name' => 'In Progress',
        ]);

        Status::create([
            'name' => 'Completed',
        ]);

        Status::create([
            'name' => 'On Hold',
        ]);

        Status::create([
            'name' => 'Cancelled',
        ]);
    }
}

