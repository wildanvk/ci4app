// Menentukan base URL
var baseUrl = "http://localhost:8080";

$("#barangMentahTable").DataTable({
  ajax: {
    url: baseUrl + "/barangmentahapi/getAllData",
    dataSrc: "barangmentah",
  },
  columns: [
    {
      data: null,
      render: function (data, type, row, meta) {
        // Menggunakan nomor urut dari data index pada tabel
        return meta.row + 1;
      },
    },
    { data: "idBarangMentah" },
    { data: "namaBarangMentah" },
    {
      data: null,
      render: function (data, type, row) {
        return row.status == "Active"
          ? '<span class="badge bg-light-success text-success fw-semibold fs-2">Active</span>'
          : '<span class="badge bg-light-danger text-danger fw-semibold fs-2">Inactive</span>';
      },
    },
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
    var startIndex = api.context[0]._iDisplayStart + 1;

    api
      .column(0, { search: "applied", order: "applied" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = startIndex + i;
      });
  },
});

// Remove Input invalid on change dan modal close
function clearValidation(element) {
  element.removeClass("is-invalid");
  element.next(".invalid-feedback").text("");
}

$("#inputModal, #editModal")
  .find("#idBarangMentah")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#idBarangMentah");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#namaBarangMentah")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#namaBarangMentah");
    clearValidation(inputElement);
  });
$("#inputModal, #editModal")
  .find("#status")
  .on("input change", function () {
    clearValidation($(this));
  })
  .closest(".modal")
  .on("hidden.bs.modal", function () {
    var inputElement = $(this).find("#status");
    clearValidation(inputElement);
  });

function refreshTombolAction() {
  $("#tambahDataModalButton").on("click", function () {
    $.ajax({
      url: baseUrl + "/barangmentahapi/getnewidbarangmentah",
      type: "GET",
      dataType: "json",
      success: function (response) {
        console.log(response);
        $("#inputModal").find("#idBarangMentah").val(response.idBarangMentah);
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
      var rowIndex = $("#barangMentahTable")
        .DataTable()
        .row($(this).closest("tr"))
        .index();
      var row = $("#barangMentahTable").DataTable().row(rowIndex).data();
      $("#editModal").find("#rowIndex").val(rowIndex);
      $("#editModal").find("#idBarangMentah").val(row.idBarangMentah);
      $("#editModal").find("#namaBarangMentah").val(row.namaBarangMentah);
      $("#editModal").find("#status").val(row.status);

      $("#editModal").modal("show");
    });
  $(".btn-delete")
    .off("click")
    .on("click", function () {
      var rowIndex = $("#barangMentahTable")
        .DataTable()
        .row($(this).closest("tr"))
        .index();
      var row = $("#barangMentahTable").DataTable().row(rowIndex).data();
      $("#deleteForm").find("#rowIndex").val(rowIndex);
      $("#deleteForm").find("#idBarangMentah").val(row.idBarangMentah);
      $("#deleteForm").find("#spanIdBarangMentah").text(row.idBarangMentah);
      $("#deleteForm").find("#spanNamaBarangMentah").text(row.namaBarangMentah);

      $("#deleteModal").modal("show");
    });
}

// Submit form tambah data menggunakan Ajax
$("#inputForm").submit(function (e) {
  e.preventDefault();

  $.ajax({
    url: baseUrl + "/barangmentahapi/inputData",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify({
      idBarangMentah: $("#idBarangMentah").val(),
      namaBarangMentah: $("#namaBarangMentah").val(),
      status: $("#status").val(),
    }),
    success: function (response) {
      // Reset form dan hapus pesan error
      console.log(response);
      $(".form-control, .form-select").removeClass("is-invalid");
      $(".invalid-feedback").text("");
      $("#inputForm")[0].reset();

      // Menambahkan baris baru ke tabel
      $("#barangMentahTable")
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
    url: baseUrl + "/barangmentahapi/updateData",
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      idBarangMentah: $("#updateForm").find("#idBarangMentah").val(),
      namaBarangMentah: $("#updateForm").find("#namaBarangMentah").val(),
      status: $("#updateForm").find("#status").val(),
    }),
    success: function (response) {
      // Reset form dan hapus pesan error
      console.log(response);
      $(".form-control, .form-select").removeClass("is-invalid");
      $(".invalid-feedback").text("");

      // Update baris di tabel
      $("#barangMentahTable")
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
    url: baseUrl + "/barangmentahapi/deleteData",
    type: "PUT",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({
      idBarangMentah: $("#deleteForm").find("#idBarangMentah").val(),
    }),
    success: function (response) {
      // Reset form dan hapus pesan error
      console.log(response);

      // Update baris di tabel
      $("#barangMentahTable")
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
