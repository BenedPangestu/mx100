<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'cv',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function job() {
        return $this->belongsTo(Job::class);
    }
    
}
