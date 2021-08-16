<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    use HasFactory;

    protected $fillable = ['name'];

    public function company()
    {
        return $this->hasMany(Company::class,'city_id','id');
    }

    public function candidate()
    {
        return $this->hasMany(Candidate::class,'city_id','id');
    }
}
