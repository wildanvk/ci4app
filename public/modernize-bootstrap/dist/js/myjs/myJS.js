// Penggajian
$("#jumlahproduksi").on("input", function () {
  var jumlahProduksi = parseFloat($(this).val()); // Mengambil nilai jumlah produksi

  // Melakukan perhitungan total gaji berdasarkan jumlah produksi (Contoh perhitungan: total gaji = jumlah produksi * 1000)
  var totalGaji = jumlahProduksi * 1000;

  // Mengisi nilai total gaji ke dalam input total gaji
  $("#totalgaji").val(totalGaji);
});

// Penjualan
$("#jumlah_barang").on("input", function () {
  var jumlahBarang = parseFloat($(this).val());

  var totalHarga = jumlahBarang * 25000;

  $("#total_bayar").val(totalHarga);
});
