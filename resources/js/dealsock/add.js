import { ajaxRequest } from "../components/AjaxRequest";
import { dataTable } from "../components/dataTable";
import { URL, FORMAT_MONEY } from "../config/constants";
const url = "dataSession";
const urlCombo = "dataSessionCombo";
const url0 = "dataProductAll";
const url1 = "dataProductAllCombo";
const urlAddSesion = "addDataSession";
const urlAddSesionCombo = "addDataSessionCombo";

$("#submitAddProductSession").click(function () {
    let jsonIdProduct = $("input[type=radio]:checked").val();
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
        className:"mucgiam",
        render: function () {
            return `
            <input type="number" value="1" class="tiente mucgiam form-control" id="mucgiam" name="mucgiam" placeholder="% or VND" >
            `;
        },
    },
    {
        data: null,
        className: "delete_sp_giam_gia cursor-pointer",
        render: function (data) {
            return `
                <a href="${
                    URL.DEALSOCK.DELETE + data.id
                }"><i class="fas fa-trash-alt"></i></a>
            `;
        },
    },
];
if ($("#dataTableLoadSpSession").length > 0) {
    dataTable(columns, url, "#dataTableLoadSpSession");
}
//combo
$("#submitAddProductSessionCombo").click(function () {
    let jsonIdProduct = [];
    $(":checkbox.check_id_sp_combo:not(:disabled):checked").each(function () {
        jsonIdProduct.push(this.value);
    });
    let _token = document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content");
    let data = { idProduct: jsonIdProduct, _token };
    ajaxRequest(
        urlAddSesionCombo,
        "POST",
        JSON.stringify(data),
        function (data) {
            location.reload();
        }
    );
});
const columnscombo = [
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
        render: function () {
            return `
            <input type="number" class="tiente mucgiam form-control" name="mucgiamcombo[]" value="1"  placeholder="% or VND" >
            `;
        },
    },
    {
        data: null,
        className: "delete_sp_giam_gia cursor-pointer",
        render: function (data) {
            return `
                <a href="${
                    URL.DEALSOCKCOMBO.DELETE + data.id
                }"><i class="fas fa-trash-alt"></i></a>
            `;
        },
    },
];
if ($("#dataTableLoadSpSessionCombo").length > 0) {
    dataTable(columnscombo, urlCombo, "#dataTableLoadSpSessionCombo");
}
// end combo session
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
            return `<input type="radio" ${disable} ${checked} name="check_id_sp" class="check_id_sp" id="product-${data.id}" value="${data.id}">`;
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
const columns1 = [
    {
        data: {
            id: "id",
            arrSession: "arrSession",
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let disable = "";
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
            return `<input type="checkbox" ${disable} ${checked} name="check_id_sp_combo[]" class="check_id_sp_combo" id="product-${data.id}" value="${data.id}">`;
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
            data.product_quantity > 0
                ? ""
                : (title = "Số lượng sản phẩm trong kho đã hết!");
            return `
             <img  style="width:60px;height:60px" title="${title}" src="${
                data.product_image
            }" alt="">
             <label for="product-${data.id}" id="" class="ml-2">
             <div  class="content-ten-sp ${
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
            product_quantity: "product_quantity",
        },
        render: function (data) {
            let status = "";
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
dataTable(columns1, url1, "#dataTableProductAllCombo");
