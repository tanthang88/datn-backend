<?php
return [
    'validation' => [
        'email' => [
            'required' => 'Email address is required to enter',
            'unique' => 'This email address is already in use',
            'format' => 'Incorrect email format',
            'max' => 'Email exceeds the allowed number of characters',
            'min' => 'Email must be at least characters'
        ],
        'password' => [
            'required' => 'password is required',
            'regex' => 'Password is not in the required format'
        ],
        'gender' => [
            'in' => 'Gender mismatch',
            'required' => 'Gender is required',
        ],
        'name' => [
            'required' => 'Full name is required to enter',
            'regex' => 'Full name is not valid',
        ],
        'phone' => [
            'required' => 'Phone is required to enter',
            'regex' => 'Incorrect phone format'
        ],
        'address' => [
            'required' => 'Address is required to enter'
        ],
        'role' => [
            'name' => [
                'required' =>  'role name is required'
            ],
            'display_name' => [
                'required' => 'display name is required'
            ],
            'permission' => [
                'required' => 'permission is required'
            ],
        ],
    ],
    'table' =>
    [
        'no_rows' => 'no rows'
    ]
];
