import { ajaxRequest } from "../components/AjaxRequest";
import { URL_BACKEND } from "../config/constants";

const url = `${URL_BACKEND}/shop/contact/countNotification`;
function convert(data) {
    let day=data.search(/^[0-9]+ngày/);
    let hour=data.search(/^[0-9]+giờ/);
    let min=data.search(/^[0-9]+phút/);
    if(day!=-1||min!=-1){
       return (data.slice(0,6))+ ' trước';
    }else if(hour!=-1){
       return (data.slice(0,5))+ ' trước';
    }else{
        return ' ';
    }
}
ajaxRequest(url,'GET','',function(data){
    $('.countNotiAll').text(data.total)
    $('.countNotiContact').text(data.contact.count)
    $('.countNotiOrder').text(data.order.count)
    $('.countNotiComment').text(data.comment.count)
    $('.dateNotiContact').html((convert(data.contact.created_date)))
    $('.dateNotiOrder').html((convert(data.order.created_date)))
    $('.dateNotiComment').html((convert(data.comment.created_date)))
})
