<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "ids" => $this->ids,
            "name" => $this->name,
            "contact" => $this->contact,
            "point" => $this->point,
            "price_sms" => $this->price_sms,
            "price_lms" => $this->price_lms,
            "price_mms" => $this->price_mms,
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
            "updated_at" => Carbon::make($this->updated_at)->format("Y-m-d H:i")
        ];
    }
}
