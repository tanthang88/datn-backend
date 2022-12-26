import { dataTable } from "../components/dataTable";

import {
  GENDER,
  STATUS_BLOCK,
  FORMAT_DATE,
  URL,
} from "../config/constants";

const url = URL.USER.LIST;
const columns = [
  {
    data: 'id'
  },
  {
    data: 'name'
  },
  {
    data: 'birthday',
    render: function (data) {
      return data ? moment(data).format(FORMAT_DATE) : ''
    }
  },
  {
    data: 'gender',
    render: function (data) {
      return data === GENDER.MALE ? 'Nam' : 'Nữ'
    }
  },
  {
    data: 'email'
  },
  {
    data: 'address'
  },
  {
    data: 'tel'
  },
  {
    data: 'status',
    render: function (data) {
      return data === STATUS_BLOCK ?
        '<span class="text-danger">Khoá</span' :
        '<span class="text-success">Hoạt động</span';
    }
  },
  {
    data: null,
    className: 'editor-edit',
    render: function (data) {
      return (`
        <a  class="btn btn-sm btn-info"
            href="${URL.USER.EDIT + data.id}">
            <i class="fas fa-pencil-alt"></i> Sửa
        </a>
        <a
            data-url="${URL.USER.DELETE + data.id}"
            class="btn-action-delete btn btn-sm btn-danger"
        >
            <i class="fas fa-trash"></i> Xóa
        </a>`
      );
    },
    orderable: false
  }
];
dataTable(columns, url, '#dataTable');
