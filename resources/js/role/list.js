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
    className: 'editor-edit',
    render: function (data) {
      return (`
        <a
            href="role/${URL.ROLE.EDIT + data.id}"
        >
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
            data-url="${URL.ROLE.DELETE + data.id}"
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
dataTable(columns, url, '#dataTable');
