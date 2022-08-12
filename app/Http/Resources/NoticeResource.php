<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            "title" => $this->title,
            "count_view" => $this->count_view,
            "important" => $this->important,
            "description" => $this->description,
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i")
        ];
    }
}
