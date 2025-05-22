<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Employers
        $employer1 = User::create([
            'name' => 'PT Teknologi Hebat',
            'email' => 'employer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'employer'
        ]);

        $employer2 = User::create([
            'name' => 'CV Kreatif Banget',
            'email' => 'employer2@example.com',
            'password' => Hash::make('password'),
            'role' => 'employer'
        ]);

        // Freelancers
        $freelancer1 = User::create([
            'name' => 'Freelancer A',
            'email' => 'freelancer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'freelancer'
        ]);

        $freelancer2 = User::create([
            'name' => 'Freelancer B',
            'email' => 'freelancer2@example.com',
            'password' => Hash::make('password'),
            'role' => 'freelancer'
        ]);

        // Jobs
        $job1 = Job::create([
            'user_id' => $employer1->id,
            'title' => 'Desain Poster Digital',
            'description' => 'Membuat desain poster event teknologi.',
            'status' => 'published'
        ]);

        $job2 = Job::create([
            'user_id' => $employer2->id,
            'title' => 'Data Entry Web Excel',
            'description' => 'Memasukkan data dari web ke excel.',
            'status' => 'published'
        ]);

        $job3 = Job::create([
            'user_id' => $employer1->id,
            'title' => 'Artikel SEO Draft',
            'description' => 'Membuat artikel SEO, belum di-publish.',
            'status' => 'draft'
        ]);

        // Applications
        Application::create([
            'job_id' => $job1->id,
            'user_id' => $freelancer1->id,
            'cv' => 'CV Freelancer A.pdf'
        ]);
    }
}
