<?php

use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Job::create([
            'user_id' => 1,
            'boat_id' => 3,
            'description' => 'Fix iets'
        ]);
        \App\Job::create([
            'user_id' => 1,
            'boat_id' => 4,
            'description' => 'Fix nog iets'
        ]);
        \App\Job::create([
            'user_id' => 1,
            'boat_id' => 7,
            'description' => 'Fix nog iets twee'
        ]);
    }
}
