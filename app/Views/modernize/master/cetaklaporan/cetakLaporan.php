<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>

    <style>
    </style>
</head>

<body onload="window.window.print()">
    <center>
        <table style="width: 100%; border-collapse: collapse; text-align: center;" border="0">
            <tr>
                <td>
                    <table style="width: 100%; text-align: center;" border="0">
                        <tr style="text-align: center;">
                            <td>
                                <h3>Laporan Penggajian <br> Konveksi Mahmud</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <table border="1" style="width: 90%; border-collapse: collapse; border: 1px solid #000;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Penggajian</th>
                                                <th>ID Karyawan</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
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
                                                    <td class="text-center"><?php echo $row['nama']; ?></td>
                                                    <td class="text-center"><?php echo $row['jenis_kelamin']; ?></td>
                                                    <td class="text-center"><?php echo $row['tanggal']; ?></td>
                                                    <td class="text-center"><?php echo $row['jumlahproduksi']; ?></td>
                                                    <td class="text-center"><?php echo $row['totalgaji']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </center>
                                <br>
                                <br>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>