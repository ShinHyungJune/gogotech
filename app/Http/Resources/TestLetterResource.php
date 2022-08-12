<?php

namespace App\Http\Resources;

use App\Enums\Agent;
use App\Enums\MessageType;
use App\Models\Letter;
use App\Models\LetterLog;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TestLetterResource extends JsonResource
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

        $logs = $letterLog->getLogs()->get();

        $formedLogs = [];

        foreach($logs as $log){
            $log->setting($this);

            if($this->agent == Agent::PINCO){
                if($this->type == MessageType::SMS){
                    $formedLogs[] = [
                        "receiver" => $log->TR_PHONE,
                        "received_at" => $log->TR_RSLTDATE,
                        "resultCode" => $log->getResultCode(),
                        "resultMessage" => $log->getResult(),
                        "agency" => "" // 핑코 sms는 통신사 기록이 없음
                    ];
                }

                if($this->type == MessageType::LMS){
                    $formedLogs[] = [
                        "receiver" => $log->PHONE,
                        "received_at" => $log->RSLTDATE,
                        "resultCode" => $log->getResultCode(),
                        "resultMessage" => $log->getResult(),
                        "agency" => $log->TELCOINFO
                    ];
                }
            }

            if($this->agent == Agent::NPRO){
                $formedLogs[] = [
                    "receiver" => $log->CALL_TO,
                    "received_at" => $log->RSLT_DATE,
                    "resultCode" => $log->getResultCode(),
                    "resultMessage" => $log->getResult(),
                    "agency" => $log->RSLT_NET
                ];
            }
        }

        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "created_at" => Carbon::make($this->created_at)->format("Y-m-d H:i"),
            "logs" => $formedLogs,
            "finished" => $this->finished,
        ];
        */

        return [];
    }
}
