<?php

use Illuminate\Database\Seeder;

class PeriodicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Periodic::create([
            'user_id' => 1,
            'boat_id' => 1,
            'title' => 'Controleer blokken',
            'description' => 'Controleer blokken',
            'period' => 604800, // a week
        ]);
    }
}
