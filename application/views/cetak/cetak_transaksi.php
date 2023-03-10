<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <title>Cetak Bukti Transaksi</title>
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

<?php $cfg = $this->db->get('tbl_identitas')->row();?>
<body>
   <div class="page-body">
      <div class="container-xl">
         <div class="card card-lg">
            <div class="card-body">
               <div class="row">

                  <div class="col-12 my-5">
                     <div class="row d-flex justify-content-center">
                        <img style="width:100px;height:auto; align:center;" src="<?=base_url();?>public/logo/<?=$cfg->logo;?>" alt="">
                     </div>
                     <div class="row">

                        <h1 class="text-center">Invoice </h1>
                     </div>
                     <div class="row">
                        <div style="font-size:14px;" class="text-center">Kode Transaksi : <i><?= $bukti->id_keuangan; ?></i></div>
                     </div>
                  </div>
               </div>
               <table class="table table-transparent table-responsive">
                  <thead class="fw-bold">
                     <tr class="fw-bold">
                        <th class="fw-bold">No.</th>
                        <th class="fw-bold text-center">Nama</th>
                        <th class="fw-bold text-center">Tanggal</th>
                        <th class="fw-bold text-center">Nominal</th>
                        <th class="fw-bold text-center">Jenis Transaksi</th>
                        <th class="fw-bold text-center">Rekening Pengirim</th>
                        <th class="fw-bold text-center">Bukti</th>
                     </tr>
                  </thead>
                  <?php
                  if ($bukti->jenis == "Deposit" && $bukti->jenis_transaksi == "tunai") {
                     $jns = "Setor Tunai";
                  } else if ($bukti->jenis == "Deposit" && $bukti->jenis_transaksi == "transfer") {
                     $jns = "Transfer";
                  }
                  if ($bukti->jenis == "Penarikan" && $bukti->jenis_transaksi == "tunai") {
                     $jns = "Penarikan Tunai";
                  } else if ($bukti->jenis == "Penarikan" && $bukti->jenis_transaksi == "transfer") {
                     $jns = "Penarikan ke Pembayaran";
                  }
                  ?>
                  <tr>
                     <td>1.</td>
                     <td class="text-center"><?= $bukti->nama_lengkap; ?></td>
                     <td class="text-center"><?= date('d-m-Y', strtotime($bukti->tgl)) ?></td>
                     <td class="text-center"><?= "Rp " . number_format($bukti->jumlah, 0, ',', '.');?></td>
                     <td class="text-center"><?= $jns; ?></td>
                     <td class="text-center"><?= $bukti->rekening_pengirim; ?></td>
                     <?php if ($bukti->bukti =='-') : ?>

                        <td class="text-center">-</td>
                        <?php else : ?>
                           <td class="text-center"><img style="height:50px;width:auto;" src="<?= base_url(); ?>assets/img/bukti/<?= $bukti->bukti; ?>" alt=""></td>
                     <?php endif; ?>

                  </tr>

               </table>
               <p class="text-muted text-center mt-5">-----Terimakasih-----</p>
            </div>
         </div>
      </div>
   </div>

</body>
<script>
   window.print();
</script>

</html>