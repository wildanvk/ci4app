<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Penggajian</title>
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
        <p>Periode:</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Penggajian</th>
                <th>ID Karyawan</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jumlah Produksi</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($penggajian as $key => $row) : ?>
                <tr>
                    <td class="text-center"><?php echo $key + 1; ?></td>
                    <td class="text-center"><?php echo $row['idpenggajian']; ?></td>
                    <td class="text-center"><?php echo $row['idkaryawan']; ?></td>
                    <td class="text-center"><?php echo $row['nama_karyawan']; ?></td>
                    <td class="text-center"><?php echo $row['tanggal']; ?></td>
                    <td class="text-center"><?php echo $row['jumlahproduksi']; ?></td>
                    <td class="text-center"><?php echo $row['totalgaji']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>