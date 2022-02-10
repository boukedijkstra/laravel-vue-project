<?php

namespace App\Http\Controllers;

use App\Periodic;
use App\Http\Resources\Periodic as PeriodicResource;
use Illuminate\Http\Request;

class PeriodicController extends Controller
{
    public function index()
    {
        $periodics = Periodic::with('user:id,name', 'boat:id,name')
            ->with('boat.boatType')
            ->get();

        return PeriodicResource::collection($periodics);
    }
}
