<?php

namespace App\Models;

use App\Enums\MessageType;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    use SoftDeletes;

    protected $fillable = [
        "ids",
        'contact',
        "point",
        'name',
        'password',
        "verified_at",

        "social_id",
        "social_platform",

        "price_sms",
        "price_mms",
        "price_lms",

        "accept",
        "admin_id",
        "admin_ids",

        "agent",
        "memo"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth' => 'date',
    ];

    protected $appends = ["img", "count_sms", "count_lms"];

    public function registerMediaCollections():void
    {
        $this->addMediaCollection('img')->singleFile();
    }

    public function getImgAttribute()
    {
        if($this->hasMedia('img')) {
            $media = $this->getMedia('img')[0];

            return [
                "name" => $media->file_name,
                "url" => $media->getFullUrl()
            ];
        }

        return null;
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getCountSmsAttribute()
    {
        return $this->letters()->where("type", MessageType::SMS)->sum("count");
    }

    public function getCountLmsAttribute()
    {
        return $this->letters()->where("type", MessageType::LMS)->sum("count");
    }

    public function charges()
    {
        return $this->hasMany(Charge::class);
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function templates()
    {
        return $this->hasMany(Template::class);
    }

    public function letters()
    {
        return $this->hasMany(Letter::class);
    }

    public function qnas()
    {
        return $this->hasMany(Qna::class);
    }

    public function certification()
    {
        return $this->hasOne(Certification::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}
