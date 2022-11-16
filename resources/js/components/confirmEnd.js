function actionEnd(event) {
  event.preventDefault();
  let urlRequest = $(this).data('url');
  let that = $(this);
  Swal.fire({
    title: 'Bạn có chắc chắn?',
    text: "Xác nhận kết thúc",
    showCancelButton: true,
    confirmButtonText: 'Vâng',
    cancelButtonText: 'Không'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: urlRequest,
        type: 'GET',
        success: function () {
          that.parent().parent().remove();
          Swal.fire(
            'Thành Công',
            '',
            'success'
          )
        },
        error: function () {
          Swal.fire({
            icon: 'error',
            text: 'Đã có lỗi xảy ra',
          })
        }
      });
    }
  })
}

$(function () {
  $(document).on('click', '.btn-action-end', actionEnd);
})
