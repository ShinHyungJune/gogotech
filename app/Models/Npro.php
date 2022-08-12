<?php

namespace App\Models;

use App\Enums\Agent;
use App\Enums\MessageType;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class SMS
{
    protected $agent;

    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    public function send($letter, $type, $contacts, $sender, $pushedAt, $description)
    {
        $items = $this->form($letter, $type, $contacts, $sender, $pushedAt, $description);

        $this->insert($type, $items);
    }

    public function insert($type, $items)
    {
        $index = 1;

        foreach($items->chunk(1000) as $chunk){
            $table = $this->getTable($type, $index);

            DB::connection("npro")->table($table)->insert($chunk->toArray());

            $index++;
        }
    }

    public function form($letter, $type, $contacts, $sender, $pushedAt, $description)
    {
        if($type == MessageType::SMS){
            foreach($contacts as $contact){
                $items->push([
                    "BULK_ID" => $letter ? $letter->id : null,
                    "REQ_DATE" => $pushedAt,
                    "CUR_STATE" => "0",
                    "MSG_TYPE" => 4,
                    "CALL_TO" => str_replace("-", "", is_object($contact) ? $contact->contact : $contact),
                    "CALL_FROM" => str_replace("-", "", $sender),
                    "SMS_TXT" => $description,
                ]);
            };
        }

        if($type == MessageType::LMS){
            $id = DB::connection("npro")->table("MMS_CONTENTS_INFO")->insertGetId([
                "FILE_CNT" => 1,
                "MMS_BODY" => $description,
                "MMS_SUBJECT" => $letter->title,
                "MMS_REQ_DATE" => $pushedAt,
            ]);

            foreach($contacts as $contact){
                $items->push([
                    "CUR_STATE" => 0,
                    "REQ_DATE" => $pushedAt,
                    "CALL_TO" => str_replace("-", "", is_object($contact) ? $contact->contact : $contact),
                    "CALL_FROM" => str_replace("-", "", $sender),
                    "SMS_TXT" => $description,
                    "MSG_TYPE" => 6,
                    "CONT_SEQ" => $id,
                    "BULK_ID" => $letter ? $letter->id : null
                ]);
            };
        }
    }

    public function getTable($type, $index)
    {
        if($index % 3 == 1){
            return "MSG_DATA_0";
        }

        if($index % 3 == 2){
            return "MSG_DATA_1";
        }

        if($index % 3 == 0){
            return "MSG_DATA_2";
        }
    }
}
