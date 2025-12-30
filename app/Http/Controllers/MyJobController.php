<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAnyEmployer', JobPost::class);
        return view('my_job.index', [
            'jobPosts' => auth()->user()->employer
                ->jobPosts()
                ->with(['employer', 'jobApplications', 'jobApplications.user'])
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', JobPost::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        Gate::authorize('create', JobPost::class);
        auth()->user()->employer->jobPosts()->create($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job created successfully.');
    }

    public function edit(JobPost $myJob)
    {
        Gate::authorize('update', $myJob);
        return view('my_job.edit', ['jobPost' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, JobPost $myJob)
    {
        Gate::authorize('update', $myJob);
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $myJob)
    {
        Gate::authorize('delete', $myJob);
    }
}
