<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'github' => [
        'client_id' => 'eaa7aa528478de54830d',
        'client_secret' => 'b6fc01f89233c875f41053ed55cf6f2032751e74',
        'redirect' => 'http://mynote.com/socialite/callback/github',
    ],

    'gitee' => [
        'client_id' => '037710c5b3821079012b7b52cdc9a03172c8d5e5d99b68f0b07d7814e5e3ef2e',
        'client_secret' => '3e4359eccc41248cac42396dc95fb0deb6ed76d25813b5d839c9eecf0d4b375b',
        'redirect' => 'http://mynote.com/socialite/callback/gitee',
    ],

];
