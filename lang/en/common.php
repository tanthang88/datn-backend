<?php
return [
    'validation' => [
        'email' => [
            'required' => 'Email address is required to enter',
            'unique' => 'This email address is already in use',
            'format' => 'Incorrect email format'
        ],
        'password' => [
            'required' => 'password is required',
        ],
    ]
];
