import { dataTable } from "../components/dataTable";
import first from "lodash/first";
import { FORMAT_DATE, URL, PROMOTIONSTATUS } from "../config/constants";
const url0 = "discount-code/datanotstart";
const columns0 = [
    {
        data: "id",
    },
    {
        data: "promotion_product",
        render: function (data) {
            return `
                <div class="d-flex">
                <div class="img-ma_giam_gia mr-2"><i class="fas fa-dollar-sign"></i></div>
                <div>
                <b class="d-block">${data.promotion_code}</b>
                <small class="text-warning">Chưa diễn ra</small>
                </div>
                </div>
            `;
        },
        orderable: false,
    },
    {
        data: "promotion_name",
    },
    {
        data: "promotion_datestart",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "promotion_dateend",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "promotion_datestart",
        render: function (data) {
            moment.locale("vi");
            return moment(data).fromNow(true);
        },
    },
    {
        data: null,
        render: function (data) {
            return `
            <a class="btn btn-info btn-sm" href="${
                URL.DISCOUNT_CODE.EDIT + data.id
            }"><i class="fas fa-pencil-alt mr-2"></i>Sửa</a>
            `;
        },
        orderable: false,
    },
];
dataTable(columns0, url0, "#dataTable0");
const url1 = "discount-code/data";
const columns1 = [
    {
        data: "id",
    },
    {
        data: "promotion_product",
        render: function (data) {
            return `
                <div class="d-flex">
                <div class="img-ma_giam_gia mr-2"><i class="fas fa-dollar-sign"></i></div>
                <div>
                <b class="d-block">${data.promotion_code}</b>
                <small class="text-success">Đang  diễn ra</small>
                </div>
                </div>
            `;
        },
        orderable: false,
    },
    {
        data: "promotion_name",
    },
    {
        data: "promotion_datestart",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "promotion_dateend",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "promotion_dateend",
        render: function (data) {
            moment.locale("vi");
            return moment(data).fromNow(true);
        },
    },
    {
        data: null,
        render: function (data) {
            return `
            <a class="btn btn-danger btn-action-end btn-sm" data-url="${
                URL.DISCOUNT_CODE.END + data.id
            }"><i class="fa fa-hourglass-end mr-2" aria-hidden="true"></i>Kết thúc </a>
            <a class="btn btn-info btn-sm" href="${
                URL.DISCOUNT_CODE.EDIT + data.id
            }"><i class="fas fa-pencil-alt mr-2"></i>Sửa</a>`;
        },
        orderable: false,
    },
];
dataTable(columns1, url1, "#dataTable");

const url2 = "discount-code/dataend";
const columns2 = [
    {
        data: "id",
    },
    {
        data: "promotion_product",
        render: function (data) {
            return `
                <div class="d-flex">
                <div class="img-ma_giam_gia mr-2"><i class="fas fa-dollar-sign"></i></div>
                <div>
                <b class="d-block">${data.promotion_code}</b>
                <small class="text-danger">Đã kết thúc</small>
                </div>
                </div>
            `;
        },
        orderable: false,
    },
    {
        data: "promotion_name",
    },
    {
        data: "promotion_datestart",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "promotion_dateend",
        render: function (data) {
            return moment(data).format(FORMAT_DATE);
        },
    },
    {
        data: "promotion_dateend",
        render: function (data) {
            moment.locale("vi");
            return moment(data).fromNow(true);
        },
    },
    {
        data: null,
        className: "editor-delete",
        render: function (data) {
            return `
            <a class="btn btn-danger btn-sm  btn-action-delete" data-url="${
                URL.DISCOUNT_CODE.DELETE + data.id
            }"><i class="fas fa-trash mr-2"></i>Xóa </a> `;
        },
        orderable: false,
    },
];
dataTable(columns2, url2, "#dataTable2");
