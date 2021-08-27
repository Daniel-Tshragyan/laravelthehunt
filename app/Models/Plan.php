<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $fillable = [
        'title',
        'jobs_count',
        'expired_days',
        'featured_job',
        'job_listing',
        'manage_applications',
        'price'
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'id', 'plan_id');
    }



    public function payments()
    {
        return $this->hasMany(PlanPayment::class,'plan_id','id');
    }

}
