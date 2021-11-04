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
    'google' => [
        'client_id' => '522592769587-2jnd5u8cgdl7vnooh47g6qgqsohiplbm.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],
    'paypal' => [
        'client_id' => 'AUKA2v4t2BvbxVHRr5Ls9nKqDn8a0l3LaMeIAqdW407gFbQUXDKDbiU-MB8X3DqbE6uGHyPzRSFF8G6I',
        'client_secret' => 'EBg5CR327dx_9SttuERIjjlsyfYEHUoPJ91LToB6NkuNWHqNyOMdnGHZu4LG5vAwFE6TZPcWq2LGQCSG',
        'redirect' => 'https://localhost/mulilang_shop/public/',
    ],
];
