<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penggajian</title>
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
        <h3>Laporan Penggajian</h3>
        <p>Periode: <?= $bulan ?></p>
    </div>
    <table>
        <thead class="">
            <tr>
                <th>No</th>
                <th>ID penggajian</th>
                <th>ID Karyawan</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jumlah produksi</th>
                <th>Total gaji</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($penggajian as $key => $row) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row['idpenggajian'] ?></td>
                    <td><?= $row['idkaryawan'] ?></td>
                    <td><?= $row['nama_karyawan'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['jumlahproduksi'] ?></td>
                    <td><?= $row['totalgaji'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tr>
            <th colspan="5">Total Jumlah Produksi</th>
            <th><?= $totalJumlahProduksi ?></th>
            <th></th>
        </tr>
        <tr>
            <th colspan="5">Total Jumlah Gaji</th>
            <th></th>
            <th><?= $totalJumlahGaji ?></th>
        </tr>
    </table>
</body>

</html>