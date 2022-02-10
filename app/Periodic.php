<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodic extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function boat() {
        return $this->belongsTo(Boat::class);
    }
}
