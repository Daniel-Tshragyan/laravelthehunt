<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condidat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'age', 'location', 'city_id', 'image', 'profession'];

    public function city()
    {
        return $this->belongsTo('cities', 'id', 'city_id');
    }

    public function user()
    {
        return $this->belongsTo('users', 'id', 'user_id');
    }

}
