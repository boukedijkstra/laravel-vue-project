<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJob;
use App\Http\Resources\Job as JobResource;
use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('user:id,name', 'assignedUser:id,name', 'boat:id,name')
            ->with('boat.boatType')
            ->whereNull('completed_at')
            ->orderBy('priority', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return JobResource::collection($jobs);
    }

    public function store(StoreJob $request)
    {
        $job = Job::make($request->validated());
        $job->user_id = auth()->user()->id;
        $job->priority = $request->priority === true ? 1 : 0;
        $job->save();

        return new jobResource($job);
    }

    public function destroy(Job $job)
    {
        if($job->delete()) {
            return new JobResource($job);
        }
    }

    public function update(StoreJob $request, Job $job)
    {
        $job->update($request->validated());

        return new JobResource($job);
    }

    public function completeJob(StoreJob $request, Job $job) {
        $job->completed_note = $request->completed_note;
        $job->completed_at = now();
        $job->completed_by = auth()->user()->id;
        $job->save();
        return new JobResource($job);
    }
}
