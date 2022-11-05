import {
  GENDER,
  DEFAULT_TITLE_TABLE,
  DEFAULT_PAGINATE,
  STATUS_BLOCK,
  FORMAT_DATE,
  DEFAULT_MENU_RECOST
} from "../config/constants";

$(document).ready(function () {
  const table = $('#tableUser').DataTable({
    lengthMenu: DEFAULT_MENU_RECOST,
    language: {
      "lengthMenu": DEFAULT_TITLE_TABLE.DEFAULT_LENGHT_RECOST,
      "zeroRecords": DEFAULT_TITLE_TABLE.NO_ROW,
      "info": DEFAULT_TITLE_TABLE.INFO,
      "infoEmpty": DEFAULT_TITLE_TABLE.INFO_EMPTY,
      "search": DEFAULT_TITLE_TABLE.SEARCH,
      "infoFiltered": DEFAULT_TITLE_TABLE.INFO_FILTERED,
      "paginate": {
        "first": DEFAULT_PAGINATE.FIRST,
        "last": DEFAULT_PAGINATE.LAST,
        "next": DEFAULT_PAGINATE.NEXT,
        "previous": DEFAULT_PAGINATE.PREVIOUS
      },
    },
    ajax:
    {
      url: "users/data"
    },
    columns: [
      {
        data: 'id'
      },
      {
        data: 'name'
      },
      {
        data: 'birthday',
        render: function (data) {
          return moment(data).format(FORMAT_DATE)
        }
      },
      {
        data: 'gender',
        render: function (data) {
          return data === GENDER.MALE ? 'Nam' : 'Nữ'
        }
      },
      {
        data: 'email'
      },
      {
        data: 'address'
      },
      {
        data: 'tel'
      },
      {
        data: 'status',
        render: function (data) {
          return data === STATUS_BLOCK ?
            '<span class="text-danger">Khoá</span' :
            '<span class="text-success">Hoạt động</span';
        }
      },
      {
        data: null,
        className: 'editor-edit',
        defaultContent: '<button type="button" class="btn btn-sm btn-outline-secondary"><i class="cursor-pointer fas fa-edit"></i></button>',
        orderable: false
      },
      {
        data: null,
        className: 'editor-delete',
        defaultContent: '<button type="button" class="btn btn-sm btn-outline-secondary"><i class="fas fa-trash"></i></button>',
        orderable: false
      }
    ],
    select: true,
  });

  // Edit record
  $('#tableUser').on('click', 'td.editor-edit', function (e) {
    e.preventDefault();
    window.location.href = `users/${table.row(this).data().id}`;
  });

  // Handle show model delete record
  let idRow = '';
  let thisRow = '';
  $('#tableUser').on('click', 'td.editor-delete', function (e) {
    e.preventDefault();
    idRow = table.row(this).data().id;
    thisRow = this;
    $('#deleteModal').modal('toggle');
    $("#content").html(`${table.row(this).data().name}`);
  });

  //handle Delete record
  $('#confirmDelete').on('click', function (e) {
    const url = `users/delete/${idRow}`;
    $.ajax({
      url: url,
      type: 'GET',
      success: function () {
        table.row(thisRow).remove().draw();
        $('#deleteModal').modal('hide');
        toastr.success('Xoá Thành Công');
      }
    });
  })
})
