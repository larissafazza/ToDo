<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todos')->insert([
            [
                'title' => 'Clean the house',
                'description' => 'Do the dishes and wipe the floor',
                'user_id' => 1,
                'file_path' => '',
                'date' => '2023-10-06',
                'priority' => 'Important',
                'done' => 0,
                'completed' => null,
            ],
            [
                'title' => 'Organize the computer',
                'description' => 'Review files and folders',
                'user_id' => 1,
                'file_path' => '',
                'date' => '2023-12-31',
                'priority' => 'Not a priority',
                'done' => 0,
                'completed' => null,
            ],
            [
                'title' => 'Send the job application',
                'description' => 'Finish and send it',
                'user_id' => 1,
                'file_path' => '',
                'date' => '2023-08-29',
                'priority' => 'Important',
                'done' => 0,
                'completed' => null,
            ],
            [
                'title' => 'Work on my TCC',
                'description' => 'finish the college assay',
                'user_id' => 1,
                'file_path' => '',
                'date' => '2023-09-09',
                'priority' => 'Urgent',
                'done' => 1,
                'completed' => null,
            ],
            [
                'title' => 'Plan weekend',
                'description' => 'Plan the family travel',
                'user_id' => 1,
                'file_path' => '',
                'date' => '2023-09-30',
                'priority' => 'Important',
                'done' => 0,
                'completed' => null,
            ],
        ]);
    }
}
