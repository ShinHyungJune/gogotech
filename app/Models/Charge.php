<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Charge extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ["price", "name", "reason", "state"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


