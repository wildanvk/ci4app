// Menentukan base URL
var baseUrl = "http://localhost:8080/api/penggajian";

$("#laporanPenggajianTable").DataTable({
  ajax: {
    url: baseUrl + "/penggajian/getalldata",
    dataSrc: "penggajian",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row, meta) {
        // Menggunakan nomor urut dari data index pada tabel
        return meta.row + 1;
      },
    },
    { data: "idpenggajian" },
    { data: "idkaryawan" },
    { data: "nama_karyawan" },
    { data: "tanggal" },
    { data: "jumlahproduksi" },
    { data: "totalgaji" },
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
  $("#laporanPenggajianTable").DataTable().ajax.reload();
}

function refreshTable(bulan) {
  $.ajax({
    url: baseUrl + "/penggajian/getdatabydate",
    method: "GET",
    data: {
      bulan: bulan,
    },
    success: function (data) {
      // Gunakan data yang diambil dari API untuk merefresh tabel
      $("#laporanPenggajianTable")
        .DataTable()
        .clear()
        .rows.add(data.penggajian)
        .draw();
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}
