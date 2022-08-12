<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class Agent
{
    const PINCO = "PINCO"; // 핑크코브라
    const NPRO = "NPRO"; // 엔프로1
    const NPRO2 = "NPRO2"; // 엔프로2
    const NPRO3 = "NPRO3"; // 엔프로3
    const NPRO4 = "NPRO4"; // 엔프로4
    const NPRO5 = "NPRO5"; // 엔프로4
    const NPRO_SMALL = "NPRO_SMALL"; // 엔프로 소량발송용

    public static function getValues()
    {
        return [
            self::PINCO,
            self::NPRO,
            self::NPRO2,
            self::NPRO3,
            self::NPRO4,
            self::NPRO5,
            self::NPRO_SMALL,
        ];
    }

    public static function getCanSelectOptions()
    {
        return [
            Agent::NPRO => "엠포플러스1",
            Agent::NPRO2 => "엠포플러스2",
            Agent::NPRO3 => "엠포플러스3",
            Agent::NPRO4 => "엠포플러스4",
            Agent::NPRO5 => "엠포플러스5",
        ];
    }

    public static function getAllOptions()
    {
        return [
            Agent::NPRO => "엠포플러스1",
            Agent::NPRO2 => "엠포플러스2",
            Agent::NPRO3 => "엠포플러스3",
            Agent::NPRO4 => "엠포플러스4",
            Agent::NPRO5 => "엠포플러스5",
            Agent::NPRO_SMALL => "엠포플러스 소량"
        ];
    }

    public static function isNpro($agent)
    {
        return $agent == Agent::NPRO
            || $agent == Agent::NPRO2
            || $agent == Agent::NPRO3
            || $agent == Agent::NPRO4
            || $agent == Agent::NPRO5
            || $agent == Agent::NPRO_SMALL;
    }
}
