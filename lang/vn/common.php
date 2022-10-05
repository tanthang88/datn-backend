<?php
return [
    'validation' => [
        'email' => [
            'required' => 'Địa chỉ Email là bắt bược',
            'unique' => 'Email này đã được sử dụng',
            'format' => 'Định dạng Email không đúng',
            'max' => 'Email vượt quá số ký tự cho phép',
        ],
        'password' => [
            'required' => 'Mật khẩu không được để trống',
        ],
    ]
];
