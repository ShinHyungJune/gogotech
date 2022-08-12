<?php

namespace App\Models;

use App\Enums\Agent;
use App\Enums\MessageType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LetterLog extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function getLogs(Letter $letter)
    {
        $sms = new SMS();

        $usingAgent = $sms->agents[$letter->agent]; // 사용할 에이전트

        $logs = collect();

        $countSuccess = 0;
        $countFail = 0;

        $column = $usingAgent["COLUMNS"][$letter->type];

        if(Agent::isNpro($letter->agent)){
            for($i=0; $i<count($usingAgent["MODULES"]); $i++){
                $module = $usingAgent["MODULES"][$i];

                $logs = $logs->merge(DB::connection($module["DB"])
                    ->table($module[$letter->type]["LOG"]."_".Carbon::make($letter->pushed_at)->format("Ym"))
                    ->where($column["ID"], $letter->id)
                    ->get());
            }
        }

        // PINCO는 발송테이블은 나뉘지만, 로그테이블은 1개 공용으로 쓰기때문에 모듈마다 조회하면 중복됨
        if($letter->agent == Agent::PINCO){
            $module = $usingAgent["MODULES"][0];

            $logs = $logs->merge(DB::connection($module["DB"])
                ->table($module[$letter->type]["LOG"]."_".Carbon::make($letter->pushed_at)->format("Ym"))
                ->where($column["ID"], $letter->id)
                ->get());
        }

        $countSuccess += $logs->where($column["RESULT"], $column["SUCCESS_CODE"])->count();

        if($letter->agent == Agent::PINCO)
            $countFail += $logs->where($column["STATE"],"!=", $column["WAIT_CODE"])->where($column["RESULT"], "!=", $column["SUCCESS_CODE"])->count();

        if(Agent::isNpro($letter->agent))
            $countFail += $logs->where($column["RESULT"], "!=", $column["SUCCESS_CODE"])->count();

        return [
            "count_success" => $countSuccess,
            "count_fail" => $countFail,
            "items" => $logs,
        ];
    }
}
