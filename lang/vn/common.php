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
        'discoutcode_name' => [
            'required' => 'Vui lòng nhập tên chương trình giảm giá',
            'unique' => 'Tên chương trình đã tồn tại'
        ],
        'discoutcode_code' => [
            'required' => 'Vui lòng nhập mã giảm giá cho chuơng trình',
            'min' => 'Mã giảm giá ít nhất 4 ký tự',
            'unique' => 'Mã khuyến mãi đã tồn tại'
        ],
        'discoutcode_daterange' => [
            'required' => 'Vui lòng chọn thời gian khuyến mãi',
        ],
        'discoutcode_rate' => [
            'required' => 'Vui lòng nhập mức giảm',
            'integer' => 'Vui lòng nhập số nguyên',
            'min' => 'Vui lòng nhập số lớn hơn 0',
        ],
        'discoutcode_ordervalue' => [
            'required' => 'Vui lòng nhập giá trị đơn hàng tối thiểu',
            'integer' => 'Vui lòng nhập số nguyên',
            'min' => 'Vui lòng nhập số lớn hơn 0'
        ],
        'discoutcode_numberofuse' => [
            'required' => 'Vui lòng nhập giới hạn số lượng mã',
            'integer' => 'Vui lòng nhập số nguyên',
            'min' => 'Vui lòng nhập số lớn hơn 0'
        ],
        'subject' => [
            'required' => 'Vui lòng nhập tiêu đề',
        ],
        'content' => [
            'required' => 'Vui lòng nhập nội dung',
        ],
    ],
    'table' =>
    [
        'no_rows' => 'Không có bản ghi nào'
    ]
];
