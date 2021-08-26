<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ROLE_ADMIN = 0;
    const ROLE_COMPANY = 2;
    const ROLE_CANDIDATE = 1;

    use HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function company()
    {
        return $this->hasOne(Company::class, 'user_id', 'id');
    }

    public function candidate()
    {
        return $this->hasOne(Candidate::class, 'user_id', 'id');
    }


    public function job()
    {
        return $this->hasMany(Job::class,'company_id','id');
    }



    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

}
