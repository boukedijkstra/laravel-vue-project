<?php

use Illuminate\Database\Seeder;

class BoatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boatTypes = \App\BoatType::all();
        foreach($boatTypes as $boatType) {
            \App\Boat::create([
                'name' => $boatType->name . ' 1',
                'boat_type_id' => $boatType->id,
            ]);
            \App\Boat::create([
                'name' => $boatType->name . ' 2',
                'boat_type_id' => $boatType->id,
            ]);
        }
    }
}
