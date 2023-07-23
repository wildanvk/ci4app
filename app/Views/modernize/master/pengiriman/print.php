<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Pengiriman</title>
    <style>
        body {
            display: flex;
            margin: auto;
        }

        .judul {
            text-align: center;
            border-bottom: 2px;
            border-color: black;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="judul">
            <h2>LAPORAN PENGIRIMAN</h2>
            <h4>Konveksi Mahmud</h4>
        </div>
        <table class="table">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Tanggal Pengiriman</th>
                    <th class="text-center">ID Pengiriman</th>
                    <th class="text-center">ID Transaksi</th>
                    <th class="text-center">Resi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($Pengiriman)) { ?>
                    <tr>
                        <td class="text-center" colspan="7">Tidak ada data</td>
                    </tr>
                <?php } else { ?>
                    <?php foreach ($Pengiriman as $key => $row) : ?>
                        <tr>
                            <td class="text-center"><?php echo $key + 1; ?></td>
                            <td class="text-center"><?php echo $row['tgl_pengiriman']; ?></td>
                            <td class="text-center"><?php echo $row['id_pengiriman']; ?></td>
                            <td class="text-center"><?php echo $row['id_transaksi']; ?></td>
                            <td class="text-center"><?php echo $row['resi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>