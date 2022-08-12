<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinco extends Model
{
    protected $connection = "pinco";

    use HasFactory;

    protected $fillable = [
        "TR_NUM",
        "TR_SENDDATE",
        "TR_SENDSTAT",
        "TR_MSGTYPE",
        "TR_PHONE",
        "TR_CALLBACK",
        "TR_MSG",
    ];

    protected $table = "SC_TRAN";

    public $timestamps = false;
}
