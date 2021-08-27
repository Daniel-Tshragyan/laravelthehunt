<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $timestamps = false;


    protected $fillable = [
        'title',
        'location',
        'description',
        'closing_date',
        'price',
        'url',
        'company_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'company_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, CandidateJob::class, 'job_id', 'candidate_id')
            ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, JobTag::class, 'job_id', 'tag_id');
    }

}
