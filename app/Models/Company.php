<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'comapnyname', 'tagline', 'location', 'city_id', 'image'];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function Aplication()
    {
        return $this->hasMany(Aplication::class,'company_id','id');
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
