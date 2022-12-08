import { ajaxRequest } from "../components/AjaxRequest";
import { dataTable } from "../components/dataTable";
import { URL, FORMAT_MONEY } from "../config/constants";
const url = "dataSession";
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
const columns = [
    {
        data: "id",
    },
    {
        data: {
            product_image: "product_image",
            product_name: "product_name",
        },
        render: function (data) {
            return `
                    <div class="d-flex">
                        <img  style="width:50px;"  src="${data.product_image}" alt="">
                        <div  class="content-ten-sp ml-2">${data.product_name}</div>
                    </div>
                `;
        },
        orderable: false,
    },
    {
        data: "product_price",
        render: function (data) {
            return FORMAT_MONEY.format(data);
        },
    },
    {
        className:'dataMoney',
        data: "product_price",
        render: function (data) {
            return 0;
        },
    },
    {
        data: null,
        className: "delete_sp_giam_gia cursor-pointer",
        render: function (data) {
            return `
                <a href="${
                    URL.DISCOUNT.DELETE + data.id
                }"><i class="fas fa-trash-alt"></i></a>
            `;
        },
    },
];
if ($("#dataTableLoadSpSession").length > 0) {
    dataTable(columns, url, "#dataTableLoadSpSession");
    $(".loaigiamgiatien").change(function () {
        $(".mucgiam ").keyup(function () {
            loadMoney()
        });
    });
    $(".mucgiam ").keyup(function () {
        loadMoney()
    });
    function loadMoney(){
        var type = $(".loaigiamgiatien").val();
        var rate = $(".mucgiam").val();
        if (rate > 0) {
            ajaxRequest(
                "changeMoney",
                "GET",
                { type: new Number(type), rate: new Number(rate) },
                function (data) {
                    let arrMoney=$('#dataTableLoadSpSession tbody tr').children('td.dataMoney');
                    var i = 0;
                    for (var item of data) {
                        arrMoney[i].innerText =FORMAT_MONEY.format(item);
                      i++;
                    }
                }
            );
        }
    }
}

const columns0 = [
    {
        data: {
            id: "id",
            arrPromotion: "arrPromotion",
            arrSession: "arrSession",
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let disable = "";
            $.inArray(data.id, JSON.parse(data.arrPromotion)) >= 0 ||
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
            $.inArray(data.id, JSON.parse(data.arrPromotion)) < 0
                ? ""
                : (title = "Sản phẩm đã nằm trong chương trình khuyến mãi!");
            data.product_quantity > 0
                ? ""
                : (title = "Số lượng sản phẩm trong kho đã hết!");
            return `
             <img  style="width:60px;height:60px" title="${title}" src="${
                data.product_image
            }" alt="">
             <label for="product-${data.id}" id="" class="ml-2">
             <div  class="content-ten-sp ${
                 $.inArray(data.id, JSON.parse(data.arrPromotion)) >= 0 ||
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
            arrPromotion: "arrPromotion",
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let status = "";
            $.inArray(data.id, JSON.parse(data.arrPromotion)) >= 0 ||
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
