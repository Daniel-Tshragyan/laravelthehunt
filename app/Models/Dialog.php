<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $fillable = [
      'user1_id',
      'user2_id',
    ];

    public function messages()
    {
        return $this->hasMany(DialogMessage::class,'dialog_id','id');
    }

    public function user1()
    {
        return $this->belongsTo(User::class,'user1_id','id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class,'user2_id','id');
    }
}
