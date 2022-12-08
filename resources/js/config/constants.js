export const GENDER = {
  MALE: 0,
  FEMALE: 1
}
export const PROMOTIONSTATUS = {
    NOACTIVE: `<span class='text-warning'>Chưa diễn ra `,
    ACTIVE: `<span class='text-success'>Đang diễn ra `,
    END: `<span class='text-danger'>Đã kết thúc `,
  }
export const DEFAULT_MENU_RECOST = [[25, 50, 100, -1], [25, 50, 100, "All"]];
export const DEFAULT_TITLE_TABLE = {
  DEFAULT_LENGHT_RECOST: 'Hiển thị _MENU_ bản ghi',
  NO_ROW: 'Không tìm thấy',
  INFO: 'Hiển thị trang _PAGE_ / _PAGES_',
  INFO_EMPTY: 'Không có bản ghi nào',
  SEARCH: 'Tìm kiếm',
  INFO_FILTERED: '(Được lọc từ tổng số _MAX_ bản ghi)',
}

export const DEFAULT_PAGINATE = {
  FIRST: "Đầu",
  LAST: "Cuối",
  NEXT: "Tiếp",
  PREVIOUS: "Trước"
}

export const STATUS_BLOCK = 0;
export const FORMAT_DATE = 'DD/MM/YYYY HH:mm';
export const FORMAT_MONEY = new Intl.NumberFormat('vi-VN', {
    style: 'currency',
    currency: 'VND',
  });
export const URL = {
  ROLE: {
    LIST: 'role/data',
    ADD: '',
    EDIT: 'role/',
    DELETE: 'role/delete/'
  },
  USER: {
    LIST: 'user/data',
    ADD: '',
    EDIT: 'user/',
    DELETE: 'user/delete/'
  },
  STAFF: {
    LIST: 'staff/data',
    ADD: '',
    EDIT: 'staff/',
    DELETE: 'staff/delete/'
  },
  DISCOUNT_CODE: {
    LIST: 'discount-code/data',
    ADD: '',
    END: 'discount-code/end/',
    EDIT: 'discount-code/',
    DELETE: 'discount-code/delete/'
  },
  DISCOUNT: {
    DELETE: 'delete-dataSession/'
  },
  DEALSOCK: {
    DELETE: 'delete-dataSession/'
  },
  DEALSOCKCOMBO: {
    DELETE: 'delete-dataSessionCombo/'
  },
  FEESHIP: {
    EDIT: 'feeship/',
    DELETE: 'feeship/delete/'
  },
};
