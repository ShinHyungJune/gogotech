<?php

namespace App\Http\Resources;

use App\Enums\MessageType;
use App\Models\Letter;
use App\Models\LetterLog;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class LetterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*
        $letterLog = new LetterLog();

        $logsInformation = $letterLog->getLogs(Letter::find($this->id));

        $countSuccess = $logsInformation["count_success"];
        $countFail = $logsInformation["count_fail"];
        */

        // $countSuccess = $this->finished ? $this->count_success : $letterLog->getSuccessCount();
        // $countFail = $this->finished ? $this->count_fail : $letterLog->getFailCount();
        /*
        if($count == $countSuccess + $countFail){
            Letter::find($this->id)->update([
                "finished" => 1,
                "count_success" => $countSuccess,
                "count_fail" => $countFail,
            ]);
        }
        */

        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "type" => $this->type,
            "pushed_at" => $this->pushed_at,
            "count" => $this->count,
            "count_success" => $this->count_success,
            // "count_success" => $countSuccess,
            "count_fail" => $this->count_fail,
            // "count_fail" => $countFail,
            "count_reject" => $this->count_reject,
            "price" => $this->price,
            "refunded" => $this->refunded,
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
        ];
    }
}
