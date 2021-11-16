<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],
    'pusher' => [
        'public' => '7ce8750bc33a4faadefd',
        'secret' => '3a397bfd20e44a299c00',
        'app_id' => '1261117'
    ],
//     PUSHER_APP_ID=1261117
// PUSHER_APP_KEY=7ce8750bc33a4faadefd
// PUSHER_APP_SECRET=3a397bfd20e44a299c00
    // 'pusher' => [
    //     'public' => 'public_key',
    //     'secret' => 'secret_key',
    //     'app_id' => 'app_id'
    // ],
//       PUSHER_KEY=7ce8750bc33a4faadefd
// PUSHER_SECRET=3a397bfd20e44a299c00
// PUSHER_APP_ID=1261117
    

];
