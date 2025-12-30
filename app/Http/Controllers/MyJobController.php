<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\JobPost;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        auth()->user()->employer->jobPosts()->create($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobPost $myJob)
    {
        return view('my_job.edit', ['jobPost' => $myJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, JobPost $myJob)
    {
        $myJob->update($request->validated());

        return redirect()->route('my-jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
