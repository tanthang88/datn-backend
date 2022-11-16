import { dataTable } from "../components/dataTable";
import first from "lodash/first";
import { FORMAT_DATE, URL, PROMOTIONSTATUS } from "../config/constants";
const url0 = "discount-code/datanotstart";
const columns0 = [
    {
        data: "id",
    },
    {
        render: function () {
            return `<div class="img-ma_giam_gia mr-2"><i class="fas fa-dollar-sign"></i></div>`;
        },
        orderable: false,
    },
    {
        data: "promotion_product",
        render: function (data) {
            return first(data).promotion_code;
        },
    },
    {
        data: "promotion_name",
    },

    {
        data: "promotion_status",
        render: function (data) {
            if (data == 0) {
                return PROMOTIONSTATUS.NOACTIVE;
            } else if (data == 1) {
                return PROMOTIONSTATUS.ACTIVE;
            } else {
                return PROMOTIONSTATUS.END;
            }
        },
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
         moment.locale('vi')
          return  moment(data).fromNow(true);
        },
    },
    {

        data: null,
        className: "editor-edit",
        render: function (data) {
            return `
            <a
                href="${URL.DISCOUNT_CODE.EDIT + data.id}"
            >
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="cursor-pointer fas fa-edit"></i>
                </button>
            </a>`;
        },
        orderable: false,
    },
    {
        data: null,
        className: "editor-delete",
        render: function (data) {
            return `
            <a
                data-url="${URL.DISCOUNT_CODE.DELETE + data.id}"
                class="btn-action-delete"
            >
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-trash"></i>
                </button>
            </a>`;
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
        render: function () {
            return `<div class="img-ma_giam_gia mr-2"><i class="fas fa-dollar-sign"></i></div>`;
        },
        orderable: false,
    },
    {
        data: "promotion_product",
        render: function (data) {
            return first(data).promotion_code;
        },
    },
    {
        data: "promotion_name",
    },

    {
        data: "promotion_status",
        render: function (data) {
            if (data == 0) {
                return PROMOTIONSTATUS.NOACTIVE;
            } else if (data == 1) {
                return PROMOTIONSTATUS.ACTIVE;
            } else {
                return PROMOTIONSTATUS.END;
            }
        },
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
         moment.locale('vi')
          return  moment(data).fromNow(true);
        },
    },
    {
        data: null,
        className: "editor-end",
        render: function (data) {
            return `
            <a
                data-url="${URL.DISCOUNT_CODE.END + data.id}"
                class="btn-action-end"
            >
                <button type="button" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
                </button>
            </a>`;
        },
        orderable: false,
    },
    {
        data: null,
        className: "editor-edit",
        render: function (data) {
            return `
            <a
                href="${URL.DISCOUNT_CODE.EDIT + data.id}"
            >
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="cursor-pointer fas fa-edit"></i>
                </button>
            </a>`;
        },
        orderable: false,
    }
];
dataTable(columns1, url1, "#dataTable");

const url2 = "discount-code/dataend";
const columns2 = [
    {
        data: "id",
    },
    {
        render: function () {
            return `<div class="img-ma_giam_gia mr-2"><i class="fas fa-dollar-sign"></i></div>`;
        },
        orderable: false,
    },
    {
        data: "promotion_product",
        render: function (data) {
            return first(data).promotion_code;
        },
    },
    {
        data: "promotion_name",
    },

    {
        data: "promotion_status",
        render: function (data) {
            if (data == 0) {
                return PROMOTIONSTATUS.NOACTIVE;
            } else if (data == 1) {
                return PROMOTIONSTATUS.ACTIVE;
            } else {
                return PROMOTIONSTATUS.END;
            }
        },
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
         moment.locale('vi')
          return  moment(data).fromNow(true);
        },
    },
    {
        data: null,
        className: "editor-delete",
        render: function (data) {
            return `
            <a
                data-url="${URL.DISCOUNT_CODE.DELETE + data.id}"
                class="btn-action-delete"
            >
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-trash"></i>
                </button>
            </a>`;
        },
        orderable: false,
    },
];
dataTable(columns2, url2, "#dataTable2");
