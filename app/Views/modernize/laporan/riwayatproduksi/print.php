<!DOCTYPE html>
<html>

<head>
    <title>Laporan Riwayat Produksi</title>
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
        <h3>Laporan Riwayat Produksi</h3>
        <p>Periode: <?= $bulan ?></p>
    </div>
    <table>
        <thead class="">
            <tr>
                <th>No</th>
                <th>ID Riwayat Produksi</th>
                <th>ID Produksi</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Produksi</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($riwayatproduksi as $key => $row) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row['id_riwayat_produksi'] ?></td>
                    <td><?= $row['id_produksi'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['tgl_produksi'] ?></td>
                    <td><?= $row['tgl_selesai'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <th colspan="4">Total Jumlah</th>
            <th><?= $totalJumlah ?></th>
            <th colspan="2"></th>
        </tfoot>
    </table>
</body>

</html>