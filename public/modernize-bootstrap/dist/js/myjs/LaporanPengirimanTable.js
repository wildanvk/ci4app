// Menentukan base URL
var baseUrl = "http://localhost:8080/api/penjualan";

$("#laporanPengirimanTable").DataTable({
  ajax: {
    url: baseUrl + "/pengiriman/getalldata",
    dataSrc: "pengiriman",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row, meta) {
        // Menggunakan nomor urut dari data index pada tabel
        return meta.row + 1;
      },
    },
    { data: "tgl_pengiriman" },
    { data: "id_pengiriman" },
    { data: "id_transaksi" },
    { data: "resi" },
  ],
  order: [[0, "asc"]],
  responsive: true,
  lengthMenu: [
    [5, 10, 25, -1],
    [5, 10, 25, "All"],
  ],
  language: {
    lengthMenu: "Lihat :  _MENU_  Data",
    search: "Cari ",
    searchPlaceholder: "Ketikkan Kata Kunci",
  },
  dom: 't<"d-flex justify-content-between px-4"ip>',
});

$("#bulan").on("change", function () {
  var bulan = $("#bulan").val();

  // Refresh tabel dengan data yang sudah difilter
  refreshTable(bulan);
});

function resetData() {
  // Reset tanggal hidden input
  $("#bulan").val("");

  // Refresh tabel saat tombol reset diklik
  $("#laporanPengirimanTable").DataTable().ajax.reload();
}

function refreshTable(bulan) {
  $.ajax({
    url: baseUrl + "/pengiriman/getdatabydate",
    method: "GET",
    data: {
      bulan: bulan,
    },
    success: function (data) {
      // Gunakan data yang diambil dari API untuk merefresh tabel
      $("#laporanPengirimanTable")
        .DataTable()
        .clear()
        .rows.add(data.pengiriman)
        .draw();
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}
