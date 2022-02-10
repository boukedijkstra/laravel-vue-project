<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoatType extends Model
{
    protected $guarded = [];

    public function boats() {
        return $this->hasMany(Boat::class);
    }
}
