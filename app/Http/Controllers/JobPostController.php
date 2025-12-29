<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', JobPost::class);
        $jobPosts = JobPost::query();
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category'
        );

        return view('job-posts.index', ['jobPosts' => JobPost::with('employer')->filter($filters)->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobPost $jobPost)
    {
        Gate::authorize('view', $jobPost);
        return view('job-posts.show', ['jobPost' => $jobPost->load('employer.jobPosts')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
