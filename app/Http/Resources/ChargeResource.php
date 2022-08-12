<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChargeResource extends JsonResource
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
            "price" => $this->price,
            "name" => $this->name,
            "state" => $this->state,
            "reason" => $this->reason,
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d"),
        ];
    }
}
