import {
  DEFAULT_TITLE_TABLE,
  DEFAULT_PAGINATE,
  DEFAULT_MENU_RECOST
} from "../config/constants";

export function dataTable(columns, urlRequest,idName,paramsRequest=null,ajaxType=null) {
  $(idName).DataTable({
    lengthMenu: DEFAULT_MENU_RECOST,
    processing: true,
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
        "previous": DEFAULT_PAGINATE.PREVIOUS,
        "processing": 'Loading...',
      },
    },
    ajax:
    {
      url: urlRequest,
      type:ajaxType?ajaxType:'GET',
      data:paramsRequest?paramsRequest:''
    },
    columns: columns,
    select: true,
  });
}
