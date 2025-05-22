<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Freelancer apply ke pekerjaan (hanya sekali)
    public function store(Request $request, $jobId)
    {
        $this->authorizeRole('freelancer');

        $job = Job::where('status', 'published')->findOrFail($jobId);

        $exists = Application::where('job_id', $job->id)
                             ->where('user_id', Auth::id())
                             ->exists();

        if ($exists) {
            return response()->json(['message' => 'You have already applied for this job.'], 409);
        }

        $request->validate([
            'cv' => 'required|string', // CV bisa berupa path file atau isi
        ]);

        $application = Application::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'cv' => $request->cv,
        ]);

        return response()->json($application, 201);
    }

    // Freelancer melihat semua job yang sudah mereka apply
    public function myApplications()
    {
        $applications = Application::with('job')->where('user_id', Auth::id())->get();
        return response()->json($applications);
    }

    private function authorizeRole($role)
    {
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized.');
        }
    }
}