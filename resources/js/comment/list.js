import { dataTable } from "../components/dataTable";
import get from "lodash/get";
import { FORMAT_DATE, URL, STATUS_BLOCK } from "../config/constants";
const url = "comment/data";
const columns = [
    {
        data: "id",
    },
    {
        data: {
            product_image: "product_image",
            product_name: "product_name",
            id: "id",
        },
        render: function (data) {
            return `<a> ${data.product_name} </a> <br> <small> ${moment(
                data.created_at
            ).format(FORMAT_DATE)} </small>`;
        },
    },
    {
        data: "comment_name",
        render: function (data) {
            return data;
        },
    },
    {
        data: "comment_phone",
        render: function (data) {
            return data;
        },
    },
    {
        data: "comment_content",
        render: function (data) {
            return data;
        },
    },
    {
        data: "comment_display",
        render: function (data) {
            return data === STATUS_BLOCK
                ? '<span class="badge badge-danger">Chưa duyệt</span'
                : '<span class="badge badge-success">Đã duyệt</span';
        },
    },
    {
        data: "id",
        render: function (data) {
            return `
            <a class="btn btn-info btn-sm" href="${
                URL.COMMENT.SHOW + data
            }"><i class="fa fa-eye mr-2" aria-hidden="true"></i>Xem</a>
            <a class="btn btn-danger btn-sm  btn-action-delete" data-url="${
                URL.COMMENT.DELETE + data
            }"><i class="fas fa-trash mr-2"></i>Xóa </a> `;
        },
        orderable: false,
    },
];
dataTable(columns, url, "#dataTableContact");
