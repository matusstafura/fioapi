<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Fio Bank Api Token
    |--------------------------------------------------------------------------
    |
    |  The "Access Token" generated in admin area in Fio Bank.
    |  Settings > API > Add new token
    |
    */
    'token' => env('FIO_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Fio Bank Url Prefix
    |--------------------------------------------------------------------------
    |
    |  Url for API call
    |
    */
    'prefixUrl' => 'https://www.fio.cz/ib_api/rest/periods/',
];
