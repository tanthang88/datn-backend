const chooseFile = (fileInput) => {
  if (fileInput.target.files && fileInput.target.files[0]) {
    var render = new FileReader();
    render.onload = function (e) {
      $('#showAvatar').attr('src', e.target.result);
    }
    render.readAsDataURL(fileInput.target.files[0]);
  }
}

const onChangeCity = (city) => {
  const $select = document.querySelector('#myDist'); {
    $.ajax({
      url: `dist/${city.target.value}`,
      type: 'GET',
      success: function (res) {
        const selectOption = $('#myDist');
        selectOption.html(' ');
        $.each(res, function (key, value) {
          selectOption.append($("<option></option>")
            .attr("value", value.id).text(value.name));
        });
      }
    });
  }
}

$(function () {
  $(document).on('change', '#city', onChangeCity);
  $(document).on('change', '#avatarFile', chooseFile);
})
