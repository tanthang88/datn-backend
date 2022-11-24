export function ajaxRequest(url,type,data,callback) {
    $.ajax({
        type: type,
        contentType: "application/json",
        url: url,
        data: data,
        dataType: 'json',
        cache: false,
        success: function (data) {
            callback(data);
        }
    })
}
