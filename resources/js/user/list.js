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
      return moment(data).format(FORMAT_DATE)
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
        <a
            href="${URL.USER.EDIT + data.id}">
            <button type="button" class="btn btn-sm btn-outline-secondary">
              <i class="cursor-pointer fas fa-edit"></i>
            </button>
        </a>`
      );
    },
    orderable: false
  },
  {
    data: null,
    className: 'editor-delete',
    render: function (data) {
      return (`
        <a
          data-url="${URL.USER.DELETE + data.id}"
          class="btn-action-delete"
        >
          <button type="button" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-trash"></i>
          </button>
        </a>`
      );
    },
    orderable: false
  }
];
dataTable(columns, url);
