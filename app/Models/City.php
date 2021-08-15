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
        return $this->hasMany('companies','city_id','id');
    }

    public function candidat()
    {
        return $this->hasMany('condidats','city_id','id');
    }
}
