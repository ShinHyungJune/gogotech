<?php

return [
    'ids' => [
        "letter_calculate" => env('TELEGRAM_LETTER_CALCULATE_ID', '-1001661923160'),
        "refund_store" => env('TELEGRAM_REFUND_STORE_ID', '-1001486594066'),
        "charge_store" => env('TELEGRAM_CHARGE_STORE_ID', '-1001524437931'),
        "user_store" => env('TELEGRAM_USER_STORE_ID', '-1001626928650'),
        "letter_store" => env('TELEGRAM_LETTER_STORE_ID', '-1001687155474'),
    ],
    'key' => env('TELEGRAM_KEY', '5373311625:AAH_7akHcCfT5A6OuK4tdnPtKX4Bt3CGfRg'),
    'domain' => env('TELEGRAM_DOMAIN', 'https://api.telegram.org/bot'),
];
