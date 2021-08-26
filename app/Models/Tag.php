<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'title',
    ];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, JobTag::class, 'tag_id', 'job_id');
    }
}
