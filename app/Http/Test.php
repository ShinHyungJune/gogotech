<?php

namespace App\Models;

use App\Enums\Agent;
use App\Enums\MessageType;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class SMS
{
    protected $agent;

    protected $nprops = [
        [
            "SMS_TABLE" => ""
        ]
    ];

    protected $pincos;


    public function __construct($agent)
    {
        $this->agent = $agent;
    }

    public function send($letter, $type, $contacts, $sender, $pushedAt, $description)
    {
        $items = $this->form($letter, $type, $contacts, $sender, $pushedAt, $description);

        $this->insert($type, $items, $letter);
    }

    public function insert($type, $items, $letter)
    {
        $index = 1;

        if($this->agent == Agent::PINCO) {
            foreach($items->chunk(1000) as $chunk){
                $table = $this->getTable($type, $index);

                DB::connection("rds")->table($table)->insert($chunk->toArray());

                $index++;
            }
        }

        if($this->agent == Agent::NPRO) {
            foreach($items->chunk(1000) as $chunk){
                // $table = $this->getTable($type, $index);

                $db = "emfoplus";
                $table = "MSG_DATA_0";

                if($index == 1) {
                    $db = "emfoplus";
                    $table = "MSG_DATA_0";
                }

                if($index == 2) {
                    $db = "emfoplus2";
                    $table = "MSG_DATA2";
                }

                if($index == 3) {
                    $db = "emfoplus3";
                    $table = "MSG_DATA3";
                }

                if($letter->type == MessageType::LMS){
                    DB::connection("emfoplus")->table("MSG_DATA_0")->insert($chunk->toArray());
                }else{

                    DB::connection($db)->table($table)->insert($chunk->toArray());
                }

                $index++;
            }
        }
    }

    public function form($letter, $type, $contacts, $sender, $pushedAt, $description)
    {
        $items = collect();

        if($this->agent == Agent::PINCO){
            if($type == MessageType::SMS){
                foreach($contacts as $contact){
                    $items->push([
                        "TR_ID" => $letter ? $letter->id : null,
                        "TR_SENDDATE" => $pushedAt,
                        "TR_SENDSTAT" => "0",
                        "TR_MSGTYPE" => "0",
                        "TR_PHONE" => str_replace("-", "", is_object($contact) ? $contact->contact : $contact),
                        "TR_CALLBACK" => str_replace("-", "", $sender),
                        "TR_MSG" => $description,
                    ]);
                };
            }

            if($type == MessageType::LMS){
                foreach($contacts as $contact){
                    $items->push([
                        "ID" =>  $letter ? $letter->id : null,
                        "SUBJECT" => $letter->title,
                        "REQDATE" => $pushedAt,
                        "STATUS" => "0",
                        "TYPE" => "0",
                        "PHONE" => str_replace("-", "", $contact),
                        "CALLBACK" => str_replace("-", "", $sender),
                        "MSG" => $description,
                    ]);
                };
            }
        }

        if($this->agent == Agent::NPRO){
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
                $id = DB::connection("emfoplus")->table("MMS_CONTENTS_INFO")->insertGetId([
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

        return $items;
    }

    public function getTable($type, $index)
    {
        if($this->agent == Agent::PINCO){
            if($index % 3 == 1){
                return $type == MessageType::SMS ? "SC_TRAN" : "MMS_MSG";
            }

            if($index % 3 == 2){
                return $type == MessageType::SMS ? "1_SC_TRAN" : "1_MMS_MSG";
            }

            if($index % 3 == 0){
                return $type == MessageType::SMS ? "2_SC_TRAN" : "2_MMS_MSG";
            }
        }

        if($this->agent == Agent::NPRO){
            if($index % 3 == 1){
                return "MSG_DATA_0";
            }

            if($index % 3 == 2){
                return "MSG_DATA2";
            }

            if($index % 3 == 0){
                return "MSG_DATA3";
            }
        }
    }
}
