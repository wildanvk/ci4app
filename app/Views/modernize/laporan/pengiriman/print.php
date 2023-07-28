<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengiriman</title>
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
        <h3>Laporan Pengiriman</h3>
        <p>Periode: <?= $bulan ?></p>
    </div>
    <table>
        <thead class="">
            <tr>
                <th>No</th>
                <th>Tanggal Pengiriman</th>
                <th>ID Pengiriman</th>
                <th>ID Transaksi</th>
                <th>Resi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pengiriman as $key => $row) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row['tgl_pengiriman'] ?></td>
                    <td><?= $row['id_pengiriman'] ?></td>
                    <td><?= $row['id_transaksi'] ?></td>
                    <td><?= $row['resi'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>