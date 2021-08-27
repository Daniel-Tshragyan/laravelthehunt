<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPayment extends Model
{
    use HasFactory;

    protected $fillable=[
        'company_id',
        'plan_id',
    ];

    public function comapny()
    {
        return $this->belongsTo(Company::class, 'user_id', 'id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
