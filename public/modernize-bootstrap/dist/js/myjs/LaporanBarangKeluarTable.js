// Menentukan base URL
var baseUrl = "http://localhost:8080";

$("#barangKeluarJadiTable").DataTable({
  ajax: {
    url: baseUrl + "/barangkeluarjadiapi/getAllData",
    dataSrc: "barangkeluarjadi",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row, meta) {
        // Menggunakan nomor urut dari data index pada tabel
        return meta.row + 1;
      },
    },
    { data: "idTransaksi" },
    { data: "tanggal" },
    { data: "idBarangJadi" },
    { data: "namaBarangJadi" },
    { data: "jumlah" },
    { data: "harga" },
    {
      data: null,
      render: function (data, type, row) {
        // Menggunakan tombol sebagai output
        return (
          '<div class="btn-group">' +
          '<button type="submit" class="btn btn-sm btn-info btn-edit">' +
          '<i class="ti ti-edit"></i> Update' +
          "</button>" +
          '<button type="button" class="btn btn-sm btn-danger btn-delete">' +
          '<i class="ti ti-trash"></i> Hapus' +
          "</button>" +
          "</div>"
        );
      },
    },
  ],
  columnDefs: [
    {
      targets: -1, // Menargetkan kolom terakhir (index -1)
      className: "text-center", // Menambahkan kelas kustom
    },
  ],
  order: [[0, "asc"]],
  orderMulti: false,
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

$("#dateRange").daterangepicker(
  {
    ranges: {
      "Hari Ini": [moment(), moment()],
      Kemarin: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Satu minggu yang lalu": [moment().subtract(6, "days"), moment()],
      "30 hari terakhir": [moment().subtract(29, "days"), moment()],
      "Bulan ini": [moment().startOf("month"), moment().endOf("month")],
      "Bulan lalu": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
    },
    alwaysShowCalendars: true,
    locale: {
      format: "D MMMM YYYY",
      separator: " sampai dengan ",
      applyLabel: "Pilih",
      cancelLabel: "Batal",
      fromLabel: "Dari",
      toLabel: "Hingga",
      weekLabel: "Mg",
      customRangeLabel: "Pilih sendiri",
      daysOfWeek: ["Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sa"],
      monthNames: [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
      ],
    },
    applyMonthYear: "Pilih Bulan dan Tahun",
    opens: "right",
  },
  function (start, end, label) {
    console.log(
      "A new date selection was made: " +
        start.format("YYYY-MM-DD") +
        " to " +
        end.format("YYYY-MM-DD")
    );
  }
);

$("#dateRange").on("apply.daterangepicker", function (ev, picker) {
  var startDate = picker.startDate.format("YYYY-MM-DD");
  var endDate = picker.endDate.format("YYYY-MM-DD");

  // Set value ke tanggal hidden input
  $("#startDate").val(startDate);
  $("#endDate").val(endDate);

  // Panggil fungsi untuk refresh tabel menggunakan tanggal yang dipilih
  refreshTable(startDate, endDate);
});

function resetData() {
  // Reset tanggal datepicker ke tanggal hari ini
  $("#dateRange").data("daterangepicker").setStartDate(moment());
  $("#dateRange").data("daterangepicker").setEndDate(moment());

  // Reset tanggal hidden input
  $("#startDate").val("");
  $("#endDate").val("");

  // Refresh tabel saat tombol reset diklik
  $("#barangKeluarJadiTable").DataTable().ajax.reload();
}

function refreshTable(startDate, endDate) {
  $.ajax({
    url: baseUrl + "/barangmasukjadiapi/getDataByDate",
    method: "GET",
    data: {
      startDate: startDate,
      endDate: endDate,
    },
    success: function (data) {
      // Gunakan data yang diambil dari API untuk merefresh tabel
      $("#barangKeluarJadiTable")
        .DataTable()
        .clear()
        .rows.add(data.barangmasukmentah)
        .draw();
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}
