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
            'regex' => 'Password is not in the required format',
            'max' => 'Password exceeds 16 characters allowed',
            'min' => 'password length must be at least 6 characters',
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
        'birthday' => [
            'required' => 'birthday is required'
        ],
        'discoutcode_name' => [
            'required' => 'Please enter the name of the discount program',
            'unique' => 'program name already exists '
        ],
        'discoutcode_code' => [
            'required' => 'Please enter the discount code for the program',
            'min' => 'Coupon code length must be at least 6 characters',
            'unique' => 'Promotion code already exists'
        ],
        'discoutcode_daterange' => [
            'required' => 'Please choose a promotion period',
        ],
        'discoutcode_rate' => [
            'required' => 'Please enter the discount',
            'integer' => 'Please enter an integer',
            'min' => 'Please enter a number greater than 0'
        ],
        'discoutcode_ordervalue' => [
            'required' => 'Please enter the minimum order value',
            'integer' => 'Please enter an integer',
            'min' => 'Please enter a number greater than 0',
        ],
        'discoutcode_numberofuse' => [
            'required' => 'Please enter a limited number of codes',
            'integer' => 'Please enter an integer',
            'min' => 'Please enter a number greater than 0',
        ],
    ],
    'table' =>
    [
        'no_rows' => 'no rows'
    ],

];
