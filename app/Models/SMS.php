<?php

namespace App\Models;

use App\Enums\Agent;
use App\Enums\MessageType;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class SMS
{
    public $agents = [
        "NPRO_SMALL" => [
            "MODULES" => [
                [
                    "DB" => "hisms_emfoplus21",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "BULK_ID",
                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "WAIT_CODE" => "1",
                    "STATE" => "CUR_STATE"
                ],
                "LMS" => [
                    "ID" => "BULK_ID",

                    "LMS_FILE" => "FILE_CNT",
                    "LMS_MESSAGE" => "MMS_BODY",
                    "LMS_SUBJECT" => "MMS_SUBJECT",
                    "LMS_PUSHED_AT" => "MMS_REQ_DATE",
                    "LMS_CONTENT_SEQUENCE" => "CONT_SEQ",

                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "STATE" => "CUR_STATE"
                ]
            ],

            "CODES" => [
                "SMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ],
                "LMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ]
            ]
        ],

        "NPRO" => [
            "MODULES" => [
                [
                    "DB" => "hisms_emfoplus1",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus2",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus3",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus4",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "BULK_ID",
                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "WAIT_CODE" => "1",
                    "STATE" => "CUR_STATE"
                ],
                "LMS" => [
                    "ID" => "BULK_ID",

                    "LMS_FILE" => "FILE_CNT",
                    "LMS_MESSAGE" => "MMS_BODY",
                    "LMS_SUBJECT" => "MMS_SUBJECT",
                    "LMS_PUSHED_AT" => "MMS_REQ_DATE",
                    "LMS_CONTENT_SEQUENCE" => "CONT_SEQ",

                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "STATE" => "CUR_STATE"
                ]
            ],

            "CODES" => [
                "SMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ],
                "LMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ]
            ]
        ],

        "NPRO2" => [
            "MODULES" => [
                [
                    "DB" => "hisms_emfoplus5",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus6",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus7",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus8",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "BULK_ID",
                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "WAIT_CODE" => "1",
                    "STATE" => "CUR_STATE"
                ],
                "LMS" => [
                    "ID" => "BULK_ID",

                    "LMS_FILE" => "FILE_CNT",
                    "LMS_MESSAGE" => "MMS_BODY",
                    "LMS_SUBJECT" => "MMS_SUBJECT",
                    "LMS_PUSHED_AT" => "MMS_REQ_DATE",
                    "LMS_CONTENT_SEQUENCE" => "CONT_SEQ",

                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "STATE" => "CUR_STATE"
                ]
            ],

            "CODES" => [
                "SMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ],
                "LMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ]
            ]
        ],

        "NPRO3" => [
            "MODULES" => [
                [
                    "DB" => "hisms_emfoplus9",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus10",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus11",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus12",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "BULK_ID",
                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "WAIT_CODE" => "1",
                    "STATE" => "CUR_STATE"
                ],
                "LMS" => [
                    "ID" => "BULK_ID",

                    "LMS_FILE" => "FILE_CNT",
                    "LMS_MESSAGE" => "MMS_BODY",
                    "LMS_SUBJECT" => "MMS_SUBJECT",
                    "LMS_PUSHED_AT" => "MMS_REQ_DATE",
                    "LMS_CONTENT_SEQUENCE" => "CONT_SEQ",

                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "STATE" => "CUR_STATE"
                ]
            ],

            "CODES" => [
                "SMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ],
                "LMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ]
            ]
        ],

        "NPRO4" => [
            "MODULES" => [
                [
                    "DB" => "hisms_emfoplus13",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus14",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus15",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus16",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "BULK_ID",
                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "WAIT_CODE" => "1",
                    "STATE" => "CUR_STATE"
                ],
                "LMS" => [
                    "ID" => "BULK_ID",

                    "LMS_FILE" => "FILE_CNT",
                    "LMS_MESSAGE" => "MMS_BODY",
                    "LMS_SUBJECT" => "MMS_SUBJECT",
                    "LMS_PUSHED_AT" => "MMS_REQ_DATE",
                    "LMS_CONTENT_SEQUENCE" => "CONT_SEQ",

                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "STATE" => "CUR_STATE"
                ]
            ],

            "CODES" => [
                "SMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ],
                "LMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ]
            ]
        ],

        "NPRO5" => [
            "MODULES" => [
                [
                    "DB" => "hisms_emfoplus17",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus18",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus19",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
                [
                    "DB" => "hisms_emfoplus20",
                    "SMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MSG_DATA",
                        "LOG" => "MSG_LOG",
                        "FILE" => "MMS_CONTENTS_INFO"
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "BULK_ID",
                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "WAIT_CODE" => "1",
                    "STATE" => "CUR_STATE"
                ],
                "LMS" => [
                    "ID" => "BULK_ID",

                    "LMS_FILE" => "FILE_CNT",
                    "LMS_MESSAGE" => "MMS_BODY",
                    "LMS_SUBJECT" => "MMS_SUBJECT",
                    "LMS_PUSHED_AT" => "MMS_REQ_DATE",
                    "LMS_CONTENT_SEQUENCE" => "CONT_SEQ",

                    "PUSHED_AT" => "REQ_DATE",
                    "SEND_STATE" => "CUR_STATE",
                    "MESSAGE_TYPE" => "MSG_TYPE",
                    "MESSAGE" => "SMS_TXT",
                    "SENDER" => "CALL_FROM",
                    "RECEIVER" => "CALL_TO",
                    "RESULT" => "RSLT_CODE2",
                    "SUCCESS_CODE" => "0",
                    "STATE" => "CUR_STATE"
                ]
            ],

            "CODES" => [
                "SMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ],
                "LMS" => [
                    "0" => "성공",
                    "1" => "실패 TIMEOUT",
                    "A" => "실패 핸드폰 호 처리중",
                    "B" => "실패 음영지역",
                    "C" => "실패 power off",
                    "D" => "실패 메시지 저장개수 초과",
                    "2" => "실패 잘못된 전화번호",
                    "a" => "실패 일시 서비스 정지",
                    "b" => "실패 기타 단말기 문제",
                    "c" => "실패 착신 거절",
                    "d" => "실패 기타",
                    "e" => "실패 이통사 SMC 형식 오류",
                    "s" => "실패 메시지 스팸차단",
                    "n" => "실패 수신번호 스팸차단",
                    "r" => "실패 회신번호 스팸차단",
                    "t" => "실패 스팸차단 중2개 이상 중복차단",
                ]
            ]
        ],

        "PINCO" => [
            "MODULES" => [
                [
                    "DB" => "pinco",
                    "SMS" => [
                        "SEND" => "SC_TRAN",
                        "LOG" => "SC_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "MMS_MSG",
                        "LOG" => "MMS_LOG",
                        "FILE" => ""
                    ],
                ],
                [
                    "DB" => "pinco",
                    "SMS" => [
                        "SEND" => "1_SC_TRAN",
                        "LOG" => "SC_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "1_MMS_MSG",
                        "LOG" => "MMS_LOG",
                        "FILE" => ""
                    ],
                ],
                [
                    "DB" => "pinco",
                    "SMS" => [
                        "SEND" => "2_SC_TRAN",
                        "LOG" => "SC_LOG",
                    ],
                    "LMS" => [
                        "SEND" => "2_MMS_MSG",
                        "LOG" => "MMS_LOG",
                        "FILE" => ""
                    ],
                ],
            ],

            "COLUMNS" => [
                "SMS" => [
                    "ID" => "TR_ID",
                    "PUSHED_AT" => "TR_SENDDATE",
                    "SEND_STATE" => "TR_SENDSTAT",
                    "MESSAGE_TYPE" => "TR_MSGTYPE",
                    "MESSAGE" => "TR_MSG",
                    "SENDER" => "TR_CALLBACK",
                    "RECEIVER" => "TR_PHONE",
                    "RESULT" => "TR_RSLTSTAT",
                    "STATE" => "TR_SENDSTAT",
                    "WAIT_CODE" => "1",
                    "SUCCESS_CODE" => "06",
                ],

                "LMS" => [
                    "ID" => "ID",
                    "SUBJECT" => "SUBJECT",
                    "PUSHED_AT" => "REQDATE",
                    "SEND_STATE" => "STATUS",
                    "MESSAGE_TYPE" => "TYPE",
                    "MESSAGE" => "MSG",
                    "SENDER" => "CALLBACK",
                    "RECEIVER" => "PHONE",
                    "RESULT" => "RSLT",
                    "STATE" => "STATUS",
                    "WAIT_CODE" => "2",
                    "SUCCESS_CODE" => "1000",
                ],
            ],

            "CODES" => [
                "SMS" => [
                    "06" => "성공",
                    "07" => "실패"
                ],
                "LMS" => [
                    "3006" => "실패",
                    "1000" => "성공"
                ]
            ]
        ]
    ];

    protected $letter;

    public function send($letter, $contacts)
    {
        $usingAgent = $this->agents[$letter->agent]; // 사용할 에이전트

        // 1. 발송 연락처를 3등분한다.
        $countModules = count($usingAgent["MODULES"]); // 모듈수

        $total = count($contacts); // 전체 연락처수

        $split = (int) floor($total / $countModules); // 몇등분할지

        $sections = []; // 섹션

        for($i=0; $i < $countModules;  $i++){
            $divide = $i == $countModules - 1 ? $total : $split;

            $sections[] = array_splice($contacts, 0, $divide);
        }

        for($i=0; $i< count($sections); $i++){
            $formedContacts = collect();
            $module = $usingAgent["MODULES"][$i];
            $column = $usingAgent["COLUMNS"][$letter->type];
            $contacts = $sections[$i];
            $lmsContentId = null; // 엠포플러스는 LMS 발송 시 별도처리 필요

            if(Agent::isNpro($letter->agent) && $letter->type == MessageType::LMS)
                $lmsContentId = DB::connection($module["DB"])->table($module[$letter->type]["FILE"])->insertGetId([
                    $column["LMS_FILE"] => 1,
                    $column["LMS_SUBJECT"] => $letter->title,
                    $column["LMS_MESSAGE"] => $letter->description,
                    $column["LMS_PUSHED_AT"] => $letter->pushed_at,
                ]);

            // 발송폼을 수정한다.
            foreach($contacts as $contact){
                $formedContacts->push($this->form($module, $column, $letter, $contact, $lmsContentId));
            }

            // 수정된 발송폼을 발송한다.
            if($formedContacts->count() > 0)
                $this->insert($module, $letter, $formedContacts);
        }
    }

    public function insert($module, $letter, $formedContacts)
    {
        foreach($formedContacts->chunk(1000) as $chunk){
            DB::connection($module["DB"])->table($module[$letter->type]["SEND"])->insert($chunk->toArray());
        }
    }

    public function form($module, $column, $letter, $contact, $lmsContentId)
    {
        // LMS
        if($letter->type == MessageType::LMS){
            if(Agent::isNpro($letter->agent)){
                return [
                    $column["LMS_CONTENT_SEQUENCE"] => $lmsContentId,
                    $column["ID"] => $letter->id,
                    $column["PUSHED_AT"] => $letter->pushed_at,
                    $column["SEND_STATE"] => "0",
                    $column["MESSAGE_TYPE"] => 6,
                    $column["RECEIVER"] => str_replace("-", "", is_object($contact) ? $contact->contact : $contact),
                    $column["SENDER"] =>  str_replace("-", "", $letter->user->contact),
                    $column["MESSAGE"] =>  $letter->description,
                ];
            }

            if($letter->agent == Agent::PINCO){
                return [
                    $column["ID"] => $letter->id,
                    $column["PUSHED_AT"] => $letter->pushed_at,
                    $column["SUBJECT"] => $letter->title,
                    $column["SEND_STATE"] => "0",
                    $column["MESSAGE_TYPE"] => "0",
                    $column["RECEIVER"] => str_replace("-", "", is_object($contact) ? $contact->contact : $contact),
                    $column["SENDER"] =>  str_replace("-", "", $letter->user->contact),
                    $column["MESSAGE"] =>  $letter->description,
                ];
            }
        }

        $messageType = 0;

        if(Agent::isNpro($letter->agent))
            $messageType = 4;

        // SMS
        return [
            $column["ID"] => $letter->id,
            $column["PUSHED_AT"] => $letter->pushed_at,
            $column["SEND_STATE"] => "0",
            $column["MESSAGE_TYPE"] => $messageType,
            $column["RECEIVER"] => str_replace("-", "", is_object($contact) ? $contact->contact : $contact),
            $column["SENDER"] =>  str_replace("-", "", $letter->user->contact),
            $column["MESSAGE"] =>  $letter->description,
        ];
    }
}
