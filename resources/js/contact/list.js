import { dataTable } from "../components/dataTable";
import get from "lodash/get";
import { FORMAT_DATE, URL, STATUS_BLOCK } from "../config/constants";
const url = "contact/data";
const columns = [
    {
        data: "id",
    },
    {
        data: "subject",
        render: function (data) {
            return data;
        },
    },
    {
        data: "customer_name",
        render: function (data) {
            return data;
        },
    },
    {
        data: "email",
        render: function (data) {
            return data;
        },
    },
    {
        data: "phone",
        render: function (data) {
            return data;
        },
    },
    {
        data: "sent_date",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "status",
        render: function (data) {
            return data === STATUS_BLOCK
                ? '<span class="badge badge-danger">Chưa đọc</span'
                : '<span class="badge badge-success">Đã đọc</span';
        },
    },
    {
        data: "id",
        render: function (data) {
            return `
            <a class="btn btn-info btn-sm" href="${
                URL.CONTACT.SHOW + data
            }"><i class="fas fa-folder mr-2"></i>Xem</a>
            <a class="btn btn-danger btn-sm  btn-action-delete" data-url="${
                URL.CONTACT.DELETE + data
            }"><i class="fas fa-trash mr-2"></i>Xóa </a> `;
        },
        orderable: false,
    },
];
dataTable(columns, url, "#dataTableContact");
