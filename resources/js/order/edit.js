import { defaultsDeep } from "lodash";
import { ajaxRequest } from "../components/AjaxRequest";
import { dataTable } from "../components/dataTable";
import { URL, FORMAT_MONEY } from "../config/constants";
const url0 = "dataProductAll";
const urlAddSesion = "addDataSession";

$("#submitAddProductSession").click(function () {
    let jsonIdProduct = [];
    $(":checkbox.check_id_sp:not(:disabled):checked").each(function () {
        jsonIdProduct.push(this.value);
    });
    let _token = document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content");
    let data = { idProduct: jsonIdProduct, _token };
    ajaxRequest(urlAddSesion, "POST", JSON.stringify(data), function (data) {
        location.reload();
    });
});
$('#city_id').change(function() {
    let id = $(this).val();
    ajaxRequest('/order/selectDist/'+id,"GET",{id:id},function(data) {
        $('#dist_id').html('');
        data.forEach(element => {
            $('#dist_id').append(`<option value= '${element.id}'>${element.name}</option`);
        });
    })
})
let id_bill=$('#id_bill').val();
ajaxRequest(
    'dataSession','GET',{edit:id_bill},function(){
    }
)
const columns0 = [
    {
        data: {
            id: "id",
            arrOrder: "arrOrder",
            arrSession: "arrSession",
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let disable = "";
            $.inArray(data.id, JSON.parse(data.arrOrder)) >= 0 ||
            data.product_quantity <= 0
                ? (disable = "disabled")
                : (disable = "");
            let checked = "";
            if (
                data.arrSession != "" ||
                data.arrSession != null ||
                data.arrSession != undefined
            ) {
                checked =
                    $.inArray(data.id, JSON.parse(data.arrSession)) >= 0
                        ? "checked"
                        : "";
            }
            return `<input type="checkbox" ${disable} ${checked} name="check_id_sp[]" class="check_id_sp" id="product-${data.id}" value="${data.id}">`;
        },
        orderable: false,
    },
    {
        data: {
            product_image: "product_image",
            product_name: "product_name",
            id: "id",
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let title = "";
            $.inArray(data.id, JSON.parse(data.arrOrder)) < 0
                ? ""
                : (title = "Sản phẩm đã nằm trong đơn hàng!");
            data.product_quantity > 0
                ? ""
                : (title = "Số lượng sản phẩm trong kho đã hết!");
            return `
             <img  style="width:100px" title="${title}" src="${
                data.product_image
            }" alt="">
             <label for="product-${data.id}" id="" class="ml-2">
             <div  class="content-ten-sp ${
                 $.inArray(data.id, JSON.parse(data.arrOrder)) >= 0 ||
                 data.product_quantity <= 0
                     ? "cursor-help text-secondary text-decoration-line-through"
                     : ""
             } ">${data.product_name}</div>
             <div class="content-id_sp text-secondary">Mã: ${data.id}</div>
             </label>
            `;
        },
        orderable: false,
    },
    {
        data: {
            id: "id",
            arrOrder: "arrOrder",
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let status = "";
            $.inArray(data.id, JSON.parse(data.arrOrder)) >= 0 ||
            data.product_quantity <= 0
                ? (status = '<small class="text-danger">Không khả dụng</small>')
                : (status = '<small class="text-success">Khả dụng</small>');
            return `${status}`;
        },
    },
    {
        data: "product_price",
        render: function (data) {
            return FORMAT_MONEY.format(data);
        },
    },
    {
        data: "product_quantity",
    },
];
dataTable(columns0, url0, "#dataTableProductAll");
