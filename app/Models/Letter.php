<?php

namespace App\Models;

use App\Enums\MessageType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "type",
        "description",
        "pushed_at",
        "price",
        "count",
        "count_fail",
        "count_reject",
        "count_success",
        "finished",
        "agent",
        "total_price",
        "refunded",
        "test",
        "total_success_price",
        "calculated_at",
        "count_calculate",
        "stop_calculate"
    ];

    protected $casts = ["pushed_at" => "datetime"];

    // protected $appends = ["count", "count_success", "count_fail"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function needCalculateLetters()
    {
        return $this->where("finished", 0)
            ->where(function($query){
                $query->where("calculated_at", null)
                    ->orWhere("calculated_at", "<=", Carbon::now()->subMinutes(5));

                // ->orWhere("calculated_at", "<=", Carbon::now()->subDay()->startOfDay());
            });
    }
}
