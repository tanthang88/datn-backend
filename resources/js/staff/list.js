import { dataTable } from "../components/dataTable";
import first from 'lodash/first';
import { FORMAT_DATE, GENDER, URL } from "../config/constants";

const url = 'staff/data';
const columns = [
    {
        data: 'id'
    },
    {
        data: 'name'
    },
    {
        data: 'email',
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
        data: 'tel',
    },
    {
        data: 'admin_roles_user',
        render: function (data) {
            return first(data).display_name;
        }
    },
    {
        data: null,
        className: 'editor',
        render: function (data) {
            return (`
        <a class="btn btn-sm btn-info"
            href="${URL.STAFF.EDIT + data.id}">
            <i class="fas fa-pencil-alt"></i> Sửa
        </a>
        <a
          data-url="${URL.STAFF.DELETE + data.id}"
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
