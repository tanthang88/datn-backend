<?php
return [
    'date_format' => 'd-m-Y',
    'auth' => [
        'passport_personal_access_client_id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
        'passport_personal_access_client_secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
    ],
    'regex' => [
        'password' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/',
        'phone' => '/^(((\+|)84)|0)(3|5|7|8|9)([0-9]{8})$/',
        'company_phone' => '/^(((\+|)84)|0)(2|3|5|7|8|9)([0-9]{8})$/',
        'fax' => '/^(((\+|)84))(8)([0-9]{8})$/',
    ],
    'pagination' => [
        'per_page' => 30
    ],
];
