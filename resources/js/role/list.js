import { dataTable } from '../components/dataTable';
import { URL } from '../config/constants';
const url = URL.ROLE.LIST;
const columns = [
    {
        data: 'id'
    },
    {
        data: 'name'
    },
    {
        data: 'display_name',
    },
    {
        data: null,
        className: 'editor',
        render: function (data) {
            return (`
        <a class="btn btn-sm btn-info"
            href="${URL.ROLE.EDIT + data.id}"
        >
            <i class="fas fa-pencil-alt"></i> Sửa
        </a>
        <a
            data-url="${URL.ROLE.DELETE + data.id}"
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
