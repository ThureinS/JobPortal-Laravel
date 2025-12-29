<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobApplicationController extends Controller
{
    public function create(JobPost $jobPost)
    {
        Gate::authorize('apply', $jobPost);
        return view('job_application.create', ['jobPost' => $jobPost]);
    }

    public function store(JobPost $jobPost, Request $request)
    {
        Gate::authorize('apply', $jobPost);
        $jobPost->jobApplications()->create([
            'user_id' => $request->user()->id,
            ...$request->validate([
                'expected_salary' => 'required|min:1|max:1000000'
            ])
        ]);

        return redirect()->route('job-posts.show', $jobPost)
            ->with('success', 'Job application submitted.');
    }

    public function destroy(string $id)
    {
        //
    }
}
