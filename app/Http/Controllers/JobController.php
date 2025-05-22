<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    // List semua job yang dipublish (untuk freelancer)
    public function index()
    {
        $jobs = Job::where('status', 'published')->with('user')->get();
        return response()->json($jobs);
    }

    // Employer melihat job mereka sendiri
    public function myJobs()
    {
        $jobs = Auth::user()->jobs()->withCount('applications')->get();
        return response()->json($jobs);
    }

    // Employer membuat job (draft/published)
    public function store(Request $request)
    {
        $this->authorizeRole('employer');

        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        $job = Auth::user()->jobs()->create($validated);

        return response()->json($job, 201);
    }

    // Employer melihat CV yang masuk untuk job tertentu
    public function applications($id)
    {
        $job = Job::with('applications.user:id,name,email')
                  ->where('id', $id)
                  ->where('user_id', Auth::id())
                  ->firstOrFail();

        return response()->json($job->applications);
    }

    private function authorizeRole($role)
    {
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized.');
        }
    }
}