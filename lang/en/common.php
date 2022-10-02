<?php
return [
    'validation' => [
        'email' => [
            'required' => 'Email address is required to enter',
            'unique' => 'This email address is already in use',
            'format' => 'Incorrect email format',
            'max' => 'Email exceeds the allowed number of characters',
        ],
        'password' => [
            'required' => 'password is required',
        ],
    ]
];
