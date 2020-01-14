<?php

declare(strict_types=1);

return [
    /*
     * API Details used for the internal client.
     */
    'api' => [
        'url'        => env('ROYALMAIL_API_URL', 'https://api.royalmail.net/shipping/v3/'),
        'timeout'    => env('ROYALMAIL_API_TIMEOUT', 5.0),
        'should_log' => env('ROYALMAIL_API_SHOULD_LOG', true),
    ],

    /*
     * Authentication details for a specific application.
     */
    'auth' => [
        'client_id'     => env('ROYALMAIL_AUTH_CLIENT_ID'),
        'client_secret' => env('ROYALMAIL_AUTH_CLIENT_SECRET'),
        'username'      => env('ROYALMAIL_AUTH_USERNAME'),
        'password'      => env('ROYALMAIL_AUTH_PASSWORD'),
    ],
];
