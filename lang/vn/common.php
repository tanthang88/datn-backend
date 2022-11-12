<?php
return [
    'validation' => [
        'email' => [
            'required' => 'Địa chỉ Email là bắt bược',
            'unique' => 'Email này đã được sử dụng',
            'format' => 'Định dạng Email không đúng',
            'max' => 'Email vượt quá số ký tự cho phép',
            'min' => 'Email phải có ít nhất 5 ký tự',
        ],
        'password' => [
            'required' => 'Mật khẩu không được để trống',
            'regex' => 'Mật khẩu không đúng định dạng',
            'max' => 'Mật khẩu vượt quá 16 ký tự cho phép',
            'min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ],
        'gender' => [
            'in' => 'Giới tính không phù hợp',
            'required' => 'Giới tính bắt buộc phải nhập',
        ],
        'name' => [
            'required' => 'Họ và tên là bắt buộc',
            'regex' => 'Tên không hợp lệ',
        ],
        'phone' => [
            'required' => 'Số điện thoại là bắt buộc',
            'regex' => 'Số điện thoại không đúng định dạng'
        ],
        'address' => [
            'required' => 'Địa chỉ là bắt buộc'
        ],
        'role' => [
            'name' => [
                'required' =>  'Tên phân quyền là bắt buộc'
            ],
            'display_name' => [
                'required' => 'Vui lòng nhập mô tả vai trò phân quyền'
            ],
            'permission' => [
                'required' => 'Vui lòng chọn phân quyền'
            ],
        ],
        'birthday' => [
            'required' => 'Vui lòng nhập ngày sinh'
        ],
    ],
    'table' =>
    [
        'no_rows' => 'Không có bản ghi nào'
    ]
];
