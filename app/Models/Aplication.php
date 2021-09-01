<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplication extends Model
{
    protected $fillable = [
        'company_id',
        'text',
        'candidate_id'
    ];

    public function Company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
