<?php

use Illuminate\Database\Seeder;

class PeriodicEntriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\PeriodicEntry::create([
            'user_id' => 1,
            'periodic_id' => 1,
        ]);
    }
}
