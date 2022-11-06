function removeRow(id)
{
    if(confirm('Bạn có chắc muốn xóa mục này không '+id+' ?')){
        $.ajax({
            type:'DELETE',
            datatype:'JSON',
            data:{ id },
            url:url,
            success: function (result){
                if(result.error==false){
                    location.reload();
                }else{
                    alert('Xóa thất bại!!');
                }
            }
        })
    }
}
