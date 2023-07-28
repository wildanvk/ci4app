$(function () {
  baseUrl = "http://localhost:8080/api/gudang";
  //
  // Carousel
  //
  $(".counter-carousel").owlCarousel({
    loop: true,
    margin: 30,
    mouseDrag: true,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplaySpeed: 2000,
    nav: false,
    rtl: false,
    responsive: {
      0: {
        items: 2,
      },
      576: {
        items: 2,
      },
      768: {
        items: 3,
      },
      1200: {
        items: 5,
      },
      1400: {
        items: 6,
      },
    },
  });

  // // =====================================
  // // Stok
  // // =====================================
  $.ajax({
    url: baseUrl + "/dashboard/chartstok",
    type: "GET",
    dataType: "json",
    success: function (data) {
      data.series = data.series.map(function (value) {
        return parseInt(value, 10);
      });
      var stok = {
        color: "#adb5bd",
        series: data.series,
        labels: data.labels,
        chart: {
          width: 180,
          type: "donut",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        plotOptions: {
          pie: {
            startAngle: 0,
            endAngle: 360,
            donut: {
              size: "75%",
            },
          },
        },
        stroke: {
          show: false,
        },

        dataLabels: {
          enabled: false,
        },

        legend: {
          show: false,
        },
        colors: ["var(--bs-primary)", "var(--bs-success)"],

        responsive: [
          {
            breakpoint: 991,
            options: {
              chart: {
                width: 120,
              },
            },
          },
        ],
        tooltip: {
          theme: "dark",
          fillSeriesColor: false,
        },
      };

      var chart = new ApexCharts(document.querySelector("#stok"), stok);
      chart.render();
    },
    error: function (err) {
      console.log(err);
    },
  });

  // // =====================================
  // // Pengeluaran
  // // =====================================
  $.ajax({
    url: baseUrl + "/dashboard/chartpengeluaran",
    type: "GET",
    dataType: "json",
    success: function (data) {
      function getShortMonthName(month) {
        const months = [
          "Jan",
          "Jeb",
          "Mar",
          "Apr",
          "Mei",
          "Jun",
          "Jul",
          "Agu",
          "Sep",
          "Okt",
          "Nov",
          "Des",
        ];
        return months[month - 1];
      }

      var monthsToShow = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Ubah sesuai bulan yang ingin ditampilkan

      // Fungsi untuk mengisi data bulan yang kosong dengan nilai 0
      function fillEmptyMonthsData(data, monthsToShow) {
        var filledData = [];

        for (var i = 0; i < monthsToShow.length; i++) {
          var monthData = data.find((item) => item.bulan === monthsToShow[i]);

          if (monthData) {
            filledData.push(monthData);
          } else {
            filledData.push({
              bulan: monthsToShow[i],
              jumlah_pengeluaran: 0,
            });
          }
        }

        return filledData;
      }

      // Isi data bulan yang kosong dengan nilai 0
      var filledData = fillEmptyMonthsData(data, monthsToShow);
      var pengeluaran = {
        chart: {
          id: "sparkline3",
          type: "area",
          height: 50,
          sparkline: {
            enabled: true,
          },
          group: "sparklines",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        series: [
          {
            name: "Pengeluaran",
            color: "var(--bs-secondary)",
            data: filledData.map((item) => item.jumlah_pengeluaran),
          },
        ],
        stroke: {
          curve: "smooth",
          width: 2,
        },
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 0,
            inverseColors: false,
            opacityFrom: 0.15,
            opacityTo: 0,
            stops: [20, 180],
          },
          opacity: 0.5,
        },

        markers: {
          size: 0,
        },
        tooltip: {
          theme: "dark",
          fixed: {
            enabled: true,
            position: "right",
          },
          x: {
            show: false,
          },
        },
        yaxis: {
          forceNiceScale: true,
        },
      };
      new ApexCharts(
        document.querySelector("#pengeluaran"),
        pengeluaran
      ).render();
    },
    error: function (err) {
      console.log(err);
    },
  });

  // =====================================
  // Transaksi
  // =====================================
  $.ajax({
    url: baseUrl + "/dashboard/charttransaksi",
    type: "GET",
    dataType: "json",
    success: function (data) {
      console.log(data);
      function getShortMonthName(month) {
        const months = [
          "Jan",
          "Jeb",
          "Mar",
          "Apr",
          "Mei",
          "Jun",
          "Jul",
          "Agu",
          "Sep",
          "Okt",
          "Nov",
          "Des",
        ];
        return months[month - 1];
      }

      var monthsToShow = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Ubah sesuai bulan yang ingin ditampilkan

      // Fungsi untuk mengisi data bulan yang kosong dengan nilai 0
      function fillEmptyMonthsData(data, monthsToShow) {
        var filledData = [];

        for (var i = 0; i < monthsToShow.length; i++) {
          var monthData = data.find((item) => item.bulan === monthsToShow[i]);

          if (monthData) {
            filledData.push(monthData);
          } else {
            filledData.push({
              bulan: monthsToShow[i],
              jumlah_masuk: 0,
              jumlah_keluar: 0,
            });
          }
        }

        return filledData;
      }

      // Isi data bulan yang kosong dengan nilai 0
      var filledData = fillEmptyMonthsData(data, monthsToShow);
      var jumlahTransaksi = {
        series: [
          {
            name: "Transaksi Masuk",
            data: filledData.map((item) => ({
              x: getShortMonthName(item.bulan),
              y: item.jumlah_masuk,
            })),
          },
          {
            name: "Transaksi Keluar",
            data: filledData.map((item) => ({
              x: getShortMonthName(item.bulan),
              y: item.jumlah_keluar,
            })),
          },
        ],
        colors: ["var(--bs-primary)", "var(--bs-warning)"],
        chart: {
          toolbar: {
            show: false,
          },
          height: 260,
          type: "bar",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        plotOptions: {
          bar: {
            columnWidth: "50%",
          },
        },

        dataLabels: {
          enabled: false,
        },
        legend: {
          show: false,
        },
        grid: {
          yaxis: {
            lines: {
              show: false,
            },
          },
          xaxis: {
            lines: {
              show: false,
            },
          },
        },
        xaxis: {
          type: "category",
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
        },
        yaxis: {
          labels: {
            show: true,
          },
        },
        tooltip: {
          shared: true,
          intersect: false,
          theme: "dark",
        },
      };
      var chart = new ApexCharts(
        document.querySelector("#jumlahTransaksi"),
        jumlahTransaksi
      );
      chart.render();
    },
    error: function (err) {
      console.log(err);
    },
  });

  // =====================================
  // Barang
  // =====================================
  $.ajax({
    url: baseUrl + "/dashboard/chartbarang",
    type: "GET",
    dataType: "json",
    success: function (data) {
      function getShortMonthName(month) {
        const months = [
          "Jan",
          "Jeb",
          "Mar",
          "Apr",
          "Mei",
          "Jun",
          "Jul",
          "Agu",
          "Sep",
          "Okt",
          "Nov",
          "Des",
        ];
        return months[month - 1];
      }

      var monthsToShow = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Ubah sesuai bulan yang ingin ditampilkan

      // Fungsi untuk mengisi data bulan yang kosong dengan nilai 0
      function fillEmptyMonthsData(data, monthsToShow) {
        var filledData = [];

        for (var i = 0; i < monthsToShow.length; i++) {
          var monthData = data.find((item) => item.bulan === monthsToShow[i]);

          if (monthData) {
            filledData.push(monthData);
          } else {
            filledData.push({
              bulan: monthsToShow[i],
              jumlah_masuk: 0,
              jumlah_keluar: 0,
            });
          }
        }

        return filledData;
      }

      // Isi data bulan yang kosong dengan nilai 0
      var filledData = fillEmptyMonthsData(data, monthsToShow);
      var jumlahBarang = {
        series: [
          {
            name: "Barang Masuk",
            data: filledData.map((item) => ({
              x: getShortMonthName(item.bulan),
              y: item.jumlah_masuk,
            })),
          },
          {
            name: "Barang Keluar",
            data: filledData.map((item) => ({
              x: getShortMonthName(item.bulan),
              y: item.jumlah_keluar,
            })),
          },
        ],
        colors: ["var(--bs-primary)", "var(--bs-warning)"],
        chart: {
          toolbar: {
            show: false,
          },
          height: 260,
          type: "bar",
          fontFamily: "Plus Jakarta Sans', sans-serif",
          foreColor: "#adb0bb",
        },
        plotOptions: {
          bar: {
            columnWidth: "50%",
          },
        },

        dataLabels: {
          enabled: false,
        },
        legend: {
          show: false,
        },
        grid: {
          yaxis: {
            lines: {
              show: false,
            },
          },
          xaxis: {
            lines: {
              show: false,
            },
          },
        },
        xaxis: {
          type: "category",
          axisBorder: {
            show: false,
          },
          axisTicks: {
            show: false,
          },
        },
        yaxis: {
          labels: {
            show: true,
          },
        },
        tooltip: {
          shared: true,
          intersect: false,
          theme: "dark",
        },
      };
      var chart = new ApexCharts(
        document.querySelector("#jumlahBarang"),
        jumlahBarang
      );
      chart.render();
    },
    error: function (err) {
      console.log(err);
    },
  });
});
