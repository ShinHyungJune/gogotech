<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        "contact",
        "name",
        "CI",
        "DI",
        "sex_code",
        "birth",
        "comm_id",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
