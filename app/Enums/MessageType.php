<?php
/**
 * Created by PhpStorm.
 * User: master
 * Date: 2021-01-31
 * Time: 오후 4:04
 */

namespace App\Enums;


final class MessageType
{
    const SMS = "SMS"; // SMS
    const LMS = "LMS"; // LMS
    const MMS = "MMS"; // MMS

    public static function getValues()
    {
        return [self::SMS, self::LMS, self::MMS];
    }
}
