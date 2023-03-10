<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Bukti Transaksi</title>
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
        <div class="col-12 my-5 text-center">
            <td class="text-center"><img style="height:50px;width:auto;" src="<?= base_url() ?>public/logo/<?= logo() ?>" alt=""></td>
            <h1 class="mt-2">Bukti Transaksi</h1>
            <!-- <div class="fs-4">Periode : <?=$_GET['tgl1'];?> s/d <?=$_GET['tgl2'];?></div> -->
            <!-- <div class="fs-4">Periode : <?php echo date('d-m-Y', strtotime($_GET['tgl1']))  ?> s/d <?php echo date('d-m-Y', strtotime($_GET['tgl2']))  ?></div> -->

        </div>
        <table id="tbl_general" class="table table-vcenter card-table table-striped nowrap" style="width: 100%;">
            <thead class="">
                <tr>
                
                    <th scope="col">Nasabah</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Kode Transaksi</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Jenis Transaksi</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Bukti</th>

                </tr>
            </thead>

            <tbody>
               
                <!-- <?php $tgl= explode(' ',$rows->tanggal);?> -->
                    <tr>

                  
                        <td scope="col"><?php echo $rows->nama_lengkap; ?></td>
                        <td scope="col"><?php echo date('d-m-Y', strtotime($tgl[0]))  ?></td>
                        <td scope="col"><?php echo $rows->id_keuangan; ?></td>
                        <td scope="col"><?php echo $rows->jenis; ?></td>
                        <?php
                        if ($rows->jenis == "Deposit" && $rows->jenis_transaksi == "tunai") {
                            $jns = "Setor Tunai";
                        } else if ($rows->jenis == "Deposit" && $rows->jenis_transaksi == "transfer") {
                            $jns = "Transfer";
                        }
                        if ($rows->jenis == "Penarikan" && $rows->jenis_transaksi == "tunai") {
                            $jns = "Penarikan Tunai";
                        } else if ($rows->jenis == "Penarikan" && $rows->jenis_transaksi == "transfer") {
                            $jns = "Penarikan ke Pembayaran";
                        }
                        ?>
                        <td scope="col"><?= $jns; ?></td>
                        <td scope="col"><?php echo "Rp " . number_format($rows->jumlah, 0, ',', '.'); ?></td>

                        <?php if ($rows->bukti == '-') : ?>
                            <td>-</td>
                        <?php else : ?>

                            <td scope="col"><img style="height:50px;width:50px;" src="<?= base_url(); ?>assets/img/bukti/<?= $rows->bukti; ?>" alt=""></td>
                        <?php endif; ?>



                    </tr>
            


            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>