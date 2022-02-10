<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    protected $guarded = [];

    public function boatType() {
        return $this->belongsTo(BoatType::class);
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }
}
