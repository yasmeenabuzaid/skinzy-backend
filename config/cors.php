<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:3000', // أثناء التطوير
        'https://skinzy-ecommerce-z4p6.vercel.app', // الموقع الفعلي
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // لازم true إذا تستخدم الكوكيز مع Sanctum

];
