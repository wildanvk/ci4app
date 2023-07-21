/*************************************************************************************/
// -->Template Name: Bootstrap Press Admin
// -->Author: Themedesigner
// -->Email: niravjoshi87@gmail.com
// -->File: datatable_basic_init
/*************************************************************************************/

/****************************************
 *         Table Responsive             *
 ****************************************/
$(function () {
  $("#config-table").DataTable({
    responsive: true,
  });
});

/****************************************
 *       Basic Table                   *
 ****************************************/
$("#myTable").DataTable();

/****************************************
 *       Default Order Table           *
 ****************************************/
$("#default_order").DataTable({
  ajax: {
    url: "http://localhost:8080/supplierapi/showData",
    dataSrc: "supplier",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row, meta) {
        // Mengambil nomor urut berdasarkan indeks data
        return meta.row + 1;
      },
      className: "text-center",
    },
    { data: "idSupplier", className: "text-center" },
    { data: "namaSupplier", className: "text-center" },
    { data: "alamat" },
    { data: "kontak", className: "text-center" },
    {
      data: "status",
      className: "text-center",
      render: function (data, type, row, meta) {
        // Mengambil nomor urut berdasarkan indeks data
        return data;
      },
    },
  ],
  order: [[1, "asc"]],
  responsive: true,
  lengthMenu: [
    [10, 25, 50, -1],
    [10, 25, 50, "All"],
  ],
  language: {
    lengthMenu: "Lihat :  _MENU_  Data",
    search: "Cari ",
    searchPlaceholder: "Ketikkan Kata Kunci",
  },
  dom: '<"d-flex justify-content-between px-4"fl>t<"d-flex justify-content-between px-4"ip>',
});

/****************************************
 *       Multi-column Order Table      *
 ****************************************/
$("#multi_col_order").DataTable({
  columnDefs: [
    {
      targets: [0],
      orderData: [0, 1],
    },
    {
      targets: [1],
      orderData: [1, 0],
    },
    {
      targets: [4],
      orderData: [4, 0],
    },
  ],
});

/****************************************
 *       Complex header Table          *
 ****************************************/
$("#complex_header").DataTable();

/****************************************
 *       DOM positioning Table         *
 ****************************************/
$("#DOM_pos").DataTable({
  dom: '<"top"i>rt<"bottom"flp><"clear">',
});

/****************************************
 *     alternative pagination Table    *
 ****************************************/
$("#alt_pagination").DataTable({
  pagingType: "full_numbers",
});

/****************************************
 *     vertical scroll Table    *
 ****************************************/
$("#scroll_ver").DataTable({
  scrollY: "300px",
  scrollCollapse: true,
  paging: false,
});

/****************************************
 * vertical scroll,dynamic height Table *
 ****************************************/
$("#scroll_ver_dynamic_hei").DataTable({
  scrollY: "50vh",
  scrollCollapse: true,
  paging: false,
});

/****************************************
 *     horizontal scroll Table    *
 ****************************************/
$("#scroll_hor").DataTable({
  scrollX: true,
});

/****************************************
 * vertical & horizontal scroll Table  *
 ****************************************/
$("#scroll_ver_hor").DataTable({
  scrollY: 300,
  scrollX: true,
});

/****************************************
 * Language - Comma decimal place Table  *
 ****************************************/
$("#lang_comma_deci").DataTable({
  language: {
    decimal: ",",
    thousands: ".",
  },
});

/****************************************
 *         Language options Table      *
 ****************************************/
$("#lang_opt").DataTable({
  language: {
    lengthMenu: "Display _MENU_ records per page",
    zeroRecords: "Nothing found - sorry",
    info: "Showing page _PAGE_ of _PAGES_",
    infoEmpty: "No records available",
    infoFiltered: "(filtered from _MAX_ total records)",
  },
});
