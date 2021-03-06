<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['user_id', 'age', 'location', 'city_id', 'image', 'profession'];

    public function city()
    {
        return $this->belongsTo(City::class, 'id', 'city_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function job()
    {
        $this->belongsToMany(Job::class, CandidateJob::class, 'candidate_id', 'job_id');
    }

}
