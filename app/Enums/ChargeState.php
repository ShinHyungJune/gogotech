<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class ChargeState
{
    const SUCCESS = "SUCCESS"; // 성공
    const WAIT = "WAIT"; // 대기
    const FAIL = "FAIL"; // 실패

    public static function getValues()
    {
        return [self::SUCCESS, self::WAIT, self::FAIL];
    }
}
