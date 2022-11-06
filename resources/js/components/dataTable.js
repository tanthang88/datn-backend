import {
  DEFAULT_TITLE_TABLE,
  DEFAULT_PAGINATE,
  DEFAULT_MENU_RECOST
} from "../config/constants";

export function dataTable(columns, urlRequest) {
  $('#dataTable').DataTable({
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
      url: urlRequest
    },
    columns: columns,
    select: true,
  });
}
