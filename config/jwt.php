<?php

return [
    'jwt' => [
        'expiry' => env('JWT_EXPIRY', 1),
        'secret' => env('JWT_SECRET', 'secret'),
    ],
];
