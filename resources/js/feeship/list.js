import { dataTable } from "../components/dataTable";
import get from 'lodash/get';
import { URL , FORMAT_MONEY} from "../config/constants";
const url = "feeship/data";
const columns = [
    {
        data: "id",
    },
    {
        data: "about_name",
        render: function (data) {
            return data;
        },
    },
    {
        data: "transport_fee",
        render: function (data) {
            let rs=get(data,'transport_fee','')==0?'Miễn phí ship': FORMAT_MONEY.format(get(data,'transport_fee',''));
            return rs;
        },
    },
    {

        data: "id",
        render: function (data) {
            return `
            <a class="btn btn-info btn-sm" href="${
                URL.FEESHIP.EDIT + data
            }"><i class="fas fa-pencil-alt mr-2"></i>Sửa</a>
            <a class="btn btn-danger btn-sm  btn-action-delete" data-url="${
                URL.FEESHIP.DELETE + data
            }"><i class="fas fa-trash mr-2"></i>Xóa </a> `;
        },
        orderable: false,
    },
];
dataTable(columns, url, "#dataTableFeeShip");
