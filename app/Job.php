<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function scopeIncompleteJobs($query) {
        return $query->where('completed_at', '=', null)->count();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function boat() {
        return $this->belongsTo(Boat::class);
    }

    public function assignedUser() {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function completedBy() {
        return $this->belongsTo(User::class, 'completed_by');
    }
}
