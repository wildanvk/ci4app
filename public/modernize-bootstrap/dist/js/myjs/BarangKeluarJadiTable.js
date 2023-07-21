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
  initComplete: function () {
    refreshTombolAction();
  },
  drawCallback: function (settings) {
    var api = this.api();

    api
      .column(0, { search: "applied", order: "applied" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1;
      });
  },
});

// Remove Input invalid on change
function clearValidation(element) {
  element.removeClass("is-invalid");
  element.next(".invalid-feedback").text("");
}

$("#inputModal, #editModal")
  .find("#idTransaksi")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#idTransaksi");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#tanggal")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#tanggal");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#idSupplier")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#idSupplier");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#idBarangJadi")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#idBarangJadi");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#jumlah")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#jumlah");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#harga")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#harga");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#keterangan")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#keterangan");
    clearValidation(inputElement);
  });

function refreshTombolAction() {
  $("#tambahDataModalButton").on("click", function () {
    $.ajax({
      url: baseUrl + "/barangkeluarjadiapi/getNewIdTransaksi",
      type: "GET",
      dataType: "json",
      success: function (response) {
        $("#inputModal").find("#idTransaksi").val(response.idTransaksi);
        $("#inputModal").modal("show");
      },
      error: function (response) {
        console.log(response);
      },
    });
  });
  $(".btn-edit")
    .off("click")
    .on("click", function () {
      var rowIndex = $("#barangKeluarJadiTable")
        .DataTable()
        .row($(this).closest("tr"))
        .index();
      var row = $("#barangKeluarJadiTable").DataTable().row(rowIndex).data();
      $("#updateForm").find("#rowIndex").val(rowIndex);
      $("#updateForm").find("#idTransaksi").val(row.idTransaksi);
      $("#updateForm").find("#tanggal").val(row.tanggal);
      $("#updateForm").find("#idBarangJadi").val(row.idBarangJadi);
      $("#updateForm").find("#jumlah").val(row.jumlah);
      $("#updateForm")
        .find("#harga")
        .val(parseInt(row.harga.replace(/\D/g, "")));
      $("#updateForm").find("#keterangan").val();

      $("#editModal").modal("show");
    });
  $(".btn-delete")
    .off("click")
    .on("click", function () {
      var rowIndex = $("#barangKeluarJadiTable")
        .DataTable()
        .row($(this).closest("tr"))
        .index();
      var row = $("#barangKeluarJadiTable").DataTable().row(rowIndex).data();
      $("#deleteForm").find("#rowIndex").val(rowIndex);
      $("#deleteForm").find("#idTransaksi").val(row.idTransaksi);
      $("#deleteForm").find("#spanIdTransaksi").text(row.idTransaksi);

      $("#deleteModal").modal("show");
    });
}

// Submit form tambah data menggunakan Ajax
$("#inputForm").submit(function (e) {
  e.preventDefault();

  $.ajax({
    url: baseUrl + "/barangkeluarjadiapi/inputData",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({
      idTransaksi: $("#idTransaksi").val(),
      tanggal: $("#tanggal").val(),
      idBarangJadi: $("#idBarangJadi").val(),
      jumlah: $("#jumlah").val(),
      harga: $("#harga").val(),
      keterangan: $("#keterangan").val(),
    }),
    success: function (response) {
      // Reset form dan hapus pesan error
      $(".form-control, .form-select").removeClass("is-invalid");
      $(".invalid-feedback").text("");
      $("#inputForm")[0].reset();

      // Menambahkan baris baru ke tabel
      $("#barangKeluarJadiTable")
        .DataTable()
        .ajax.reload(function () {
          // Callback akan dijalankan setelah pembaruan data selesai
          refreshTombolAction();
        });

      // Tampilkan SweetAlert sukses
      Swal.fire("Sukses", response.message, "success");

      // Menghilangkan Modal Input
      $("#inputModal").modal("hide");
    },
    error: function (xhr, status, error) {
      // Tangani pesan kesalahan validasi
      console.log(xhr);
      if (xhr.status === 400) {
        var messages = xhr.responseJSON.messages;
        $.each(messages, function (field, message) {
          var input = $("#" + field);
          input.addClass("is-invalid");
          input.next(".invalid-feedback").text(message);
        });
      } else if (xhr.status === 500) {
        Swal.fire(
          "Gagal",
          "Terjadi kesalahan ketika menginput data ke server",
          "error"
        );
        $("#inputModal").modal("hide");
      } else {
        Swal.fire("Gagal", "Terdapat kesalahan pada server", "error");
        $("#inputModal").modal("hide");
      }
    },
  });
});

// Submit form edit data menggunakan Ajax
$("#updateForm").submit(function (e) {
  e.preventDefault();

  $.ajax({
    url: baseUrl + "/barangkeluarjadiapi/updateData",
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      idTransaksi: $("#updateForm").find("#idTransaksi").val(),
      tanggal: $("#updateForm").find("#tanggal").val(),
      idBarangJadi: $("#updateForm").find("#idBarangJadi").val(),
      jumlah: $("#updateForm").find("#jumlah").val(),
      harga: $("#updateForm").find("#harga").val(),
      keterangan: $("#updateForm").find("#keterangan").val(),
    }),
    success: function (response) {
      // Reset form dan hapus pesan error
      console.log(response);
      $(".form-control, .form-select").removeClass("is-invalid");
      $(".invalid-feedback").text("");

      // Update baris di tabel
      $("#barangKeluarJadiTable")
        .DataTable()
        .ajax.reload(function () {
          // Callback akan dijalankan setelah pembaruan data selesai
          refreshTombolAction();
        });

      // Tampilkan SweetAlert sukses
      Swal.fire("Sukses", response.message, "success");

      // Menghilangkan Modal Edit
      $("#editModal").modal("hide");
    },
    error: function (xhr, status, error) {
      // Tangani pesan kesalahan validasi
      console.log(xhr);
      if (xhr.status === 400) {
        var messages = xhr.responseJSON.messages;
        $.each(messages, function (field, message) {
          var input = $($("#editModal").find("#" + field));
          input.addClass("is-invalid");
          input.next(".invalid-feedback").text(message);
        });
      } else if (xhr.status === 500) {
        Swal.fire(
          "Gagal",
          "Terjadi kesalahan ketika mengupdate data ke server <br>",
          "error"
        );
        $("#editModal").modal("hide");
      } else {
        Swal.fire("Gagal", "Terdapat kesalahan pada server", "error");
        $("#editModal").modal("hide");
      }
    },
  });
});

$("#deleteForm").submit(function (e) {
  e.preventDefault();

  $.ajax({
    url: baseUrl + "/barangkeluarjadiapi/deleteData",
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      idTransaksi: $("#deleteForm").find("#idTransaksi").val(),
    }),
    success: function (response) {
      // Reset form dan hapus pesan error
      console.log(response);

      // Update baris di tabel
      $("#barangKeluarJadiTable")
        .DataTable()
        .ajax.reload(function () {
          // Callback akan dijalankan setelah pembaruan data selesai
          refreshTombolAction();
        });

      // Tampilkan SweetAlert toast sukses
      const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });

      Toast.fire({
        icon: "success",
        title: "Data berhasil dihapus",
      });

      // Menghilangkan Modal Edit
      $("#deleteModal").modal("hide");
    },
    error: function (xhr, status, error) {
      // Tangani pesan kesalahan validasi
      if (xhr.status === 500) {
        Swal.fire(
          "Gagal",
          "Terjadi kesalahan ketika menghapus data di server <br>",
          "error"
        );

        $("#deleteModal").modal("hide");
      } else {
        Swal.fire("Gagal", "Terdapat kesalahan pada server", "error");
        $("#deleteModal").modal("hide");
      }
    },
  });
});
