<?php

namespace App\Http\Controllers;

use App\Boat;
use App\Http\Resources\Boat as BoatResource;
use App\Http\Resources\Job as JobResource;
use App\Job;
use Illuminate\Http\Request;

class BoatController extends Controller
{
    public function index()
    {
        $boats = Boat::all();

        return BoatResource::collection($boats);
    }

    public function jobs(Boat $boat) {
        $jobs = Job::query()
            ->where('boat_id', '=', $boat->id)
            ->whereNotNull('completed_at')
            ->with('user:id,name', 'assignedUser:id,name', 'completedBy:id,name')
            ->orderBy('completed_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return JobResource::collection($jobs);
    }
}
