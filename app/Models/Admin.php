<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'contact',
        'password',
        'accepted',
        "master",
        "recommend_code"
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

    protected $appends = ["count_user", "price_performance"];

    public function getCountUserAttribute()
    {
        return $this->users()->count();
    }

    public function getPricePerformanceAttribute()
    {
        return $this->letters()->sum("total_price");
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function letters()
    {
        return $this->hasManyThrough(Letter::class, User::class);
    }

}
