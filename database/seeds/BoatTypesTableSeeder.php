<?php

use Illuminate\Database\Seeder;

class BoatTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BoatType::create([
            'code' => 'PV',
            'name' => 'Poly-Valk'
        ]);
        \App\BoatType::create([
            'code' => 'SL',
            'name' => 'Sloep'
        ]);
        \App\BoatType::create([
            'code' => 'CL',
            'name' => 'Clever 23'
        ]);
        \App\BoatType::create([
            'code' => 'FE',
            'name' => 'Feeling 226'
        ]);
        \App\BoatType::create([
            'code' => 'FX',
            'name' => 'Fox 22'
        ]);
        \App\BoatType::create([
            'code' => 'FS',
            'name' => 'Friendship 22'
        ]);
        \App\BoatType::create([
            'code' => 'FS',
            'name' => 'Friendship 26'
        ]);
        \App\BoatType::create([
            'code' => 'TI',
            'name' => 'Tirion'
        ]);
        \App\BoatType::create([
            'code' => 'NC',
            'name' => 'New Classic 700'
        ]);
    }
}
