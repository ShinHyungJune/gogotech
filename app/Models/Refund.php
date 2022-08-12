<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = ["letter_id", "price"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function letter()
    {
        return $this->belongsTo(Letter::class);
    }
}
