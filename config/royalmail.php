<?php

declare(strict_types=1);

return [
    /*
     * API Details used for the internal client.
     */
    'api' => [
        'url'        => env('ROYALMAIL_API_URL', 'https://api.royalmail.net/shipping/v3/'),
        'timeout'    => (float) env('ROYALMAIL_API_TIMEOUT', 10.0),
        'should_log' => env('ROYALMAIL_API_SHOULD_LOG', true),

        /*
         * Settings for keeping the tokens alive.
         * Please note this is just to store the cache, if the token becomes invalid after
         * any timeframe it will automatically be regenerated and added back with a fresh TTL.
         *
         * Set to null to disable.
         */
        'token_cache_ttl' => (int) (60 * 3.5), // Attempt to keep it for 3:30 hrs if possible.
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
