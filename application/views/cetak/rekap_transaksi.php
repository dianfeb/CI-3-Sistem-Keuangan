<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <title>Rekap Transaksi</title>
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
   <div class="page-body">
      <div class="container-xl">
         <div class="card card-lg">
            <div class="card-body">
               <div class="row">
                  <div class="col-6">
                     <p class="h3">Profile Nasabah</p>
                     <address>
                        <?= $bukti->row()->nama_lengkap; ?><br>
                        <?= $bukti->row()->kabupaten; ?><br>
                        <?= $bukti->row()->no_hp; ?><br>
                        <?= $bukti->row()->email; ?>
                     </address>
                  </div>

                  <div class="col-12 my-5">
                     <h1>Rekap Transaksi ID Nasabah : <?= $bukti->row()->id_pelanggan; ?></h1>
                  </div>
               </div>
               <table class="table table-transparent table-responsive">
                  <thead>
                     <tr>
                        <th>Jenis Transaksi</th>
                        <th class="text-center" style="width: 25%">Tanggal</th>
                        <th class="text-end" style="width: 25%">Nominal</th>
                     </tr>
                  </thead>
                  <?php foreach ($bukti->result() as $detail) : ?>
                     <?php $hasil_rupiah = "Rp " . number_format($detail->jumlah, 0, ',', '.'); ?> <tr>
                        <!-- <td>
                           
                           <div class="text-muted"><img style="width:200px;height:auto;" src="<?= base_url(); ?>assets/img/bukti/<?= $detail->bukti; ?>" alt=""></div>
                        </td> -->
                        <td>
                           <?php if ($detail->jenis == 'masuk') : ?>
                              Setor  <?=$detail->jenis_transaksi;?>

                           <?php else : ?>
                              Penarikan <?=$detail->jenis_transaksi;?>
                              <?php if ($detail->jenis_transaksi == 'transfer') : ?>
                                  ke rekening <?= $detail->nama_penerima; ?> (<?= $detail->rekening_penerima; ?>)
                              <?php endif; ?>
                           <?php endif; ?>
                        </td>
                        <td class="text-center">
                           <?= $detail->tgl; ?>
                        </td>
                        <td class="text-end"><?= $hasil_rupiah; ?></td>
                     </tr>
                  <?php endforeach; ?>
               </table>
               <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
            </div>
         </div>
      </div>
   </div>

</body>

</html>