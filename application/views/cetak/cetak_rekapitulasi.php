<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <title>Rekapitulasi Transaksi</title>
   <link rel="icon" href="<?= base_url() ?>public/favicon/<?= favicon() ?>" type="image/x-icon" />
   <link rel="shortcut icon" href="<?= base_url() ?>public/favicon/<?= favicon() ?>" type="image/x-icon" />
   <!-- CSS files -->
   <link href="<?= base_url() ?>assets/css/tabler.min.css" rel="stylesheet" />
   <link href="<?= base_url() ?>assets/css/tabler-flags.min.css" rel="stylesheet" />
   <link href="<?= base_url() ?>assets/css/tabler-payments.min.css" rel="stylesheet" />
   <link href="<?= base_url() ?>assets/css/tabler-vendors.min.css" rel="stylesheet" />
   <link href="<?= base_url() ?>assets/css/demo.min.css" rel="stylesheet" />
   <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />

</head>

<body>
      <div class="container">
      <table id="tbl_general" class="table table-vcenter card-table table-striped" style="width: 100%;">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nasabah</th>
                <th scope="col">Jenis Transaski</th>
                <th scope="col">Metode</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jumlah (Rp)</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($rows as $row) : ?>
                <tr>

                    <td scope="col"><?php echo $no++; ?></td>
                    <td scope="col"><?php echo $row->nama_lengkap; ?></td>
                    <td scope="col"><?php echo $row->jenis; ?></td>
                    <td scope="col"><?php echo $row->jenis_transaksi; ?></td>
                    <td scope="col"><?php echo $row->tanggal; ?></td>
                    <td scope="col"><?php echo $row->jumlah; ?></td>
                   

                </tr>
            <?php endforeach; ?>


        </tbody>
        </table>
      </div>

   <script type="text/javascript">
        window.print();
    </script>

</body>

</html>