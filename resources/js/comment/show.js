import { ajaxRequest } from "../components/AjaxRequest";
const url = `accept`;
$(".accept").click(function () {
    let id = $(this).data("id");
    let _token = document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content");
    let data = { id: id, _token };
    ajaxRequest(url, "POST", JSON.stringify(data), function (data) {
        if(data==1){
            $('.hiddenClassUsername').addClass('username')
            $('.hiddenClassCursor').removeClass('cursor-help')
            $('.accept').removeClass('accept')
            $('.btnReply').removeAttr('disabled')
        }
    });
});
