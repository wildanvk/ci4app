<?php

use Carbon\Carbon;

function format_tanggal($tanggal)
{
  $date = Carbon::parse($tanggal);

  // Array yang berisi nama bulan dalam bahasa Indonesia
  $bulanIndonesia = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
  ];

  // Memformat tanggal ke dalam format yang diinginkan (21 Juli 2023)
  $formattedDate = $date->format('d ') . $bulanIndonesia[$date->month] . $date->format(' Y');
  return $formattedDate;
}

function format_bulan($bulan)
{
  $namaBulan = [
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember',
  ];

  if ($bulan >= 1 && $bulan <= 12) {
    return $namaBulan[$bulan - 1];
  } else {
    return 'Bulan tidak valid';
  }
}
