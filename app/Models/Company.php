<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tagline', 'location', 'city_id', 'image'];

    public function city()
    {
        return $this->belongsTo('cities', 'id', 'city_id');
    }

    public function user()
    {
        return $this->belongsTo('users', 'user_id', 'id');
    }

}
