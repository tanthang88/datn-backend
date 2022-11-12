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
        className: 'editor-edit',
        render: function (data) {
            return (`
        <a
            href="${URL.STAFF.EDIT + data.id}">
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
          data-url="${URL.STAFF.DELETE + data.id}"
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
