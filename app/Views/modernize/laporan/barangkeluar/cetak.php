<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Keluar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 2px solid #000;
        }

        .date-range {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Konveksi Mahmud</h1>
    </div>
    <div class="date-range">
        <h3>Laporan Barang Keluar</h3>
        <p>Periode: <?= $startDate ?> - <?= $endDate ?></p>
    </div>
    <table>
        <thead class="">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>ID Barang Jadi</th>
                <th>Nama Barang Jadi</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($barangkeluarjadi as $key => $row) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row['idTransaksi'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['idBarangJadi'] ?></td>
                    <td><?= $row['namaBarangJadi'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['harga'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total Jumlah</th>
                <th><?= $totalJumlah ?></th>
                <th></th>
            </tr>
            <tr>
                <th colspan="5">Total Harga</th>
                <th></th>
                <th><?= $totalHarga ?></th>
            </tr>
        </tfoot>
    </table>
</body>

</html>