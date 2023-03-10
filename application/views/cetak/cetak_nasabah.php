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

<body>
   <div class="page-body">
      <div class="container-xl">
         <div class="card card-lg">
            <div class="card-body">
               <div class="row">
                  <div class="col-6">
                     <p class="h3">Pengirim</p>
                     <address>
                        <?= $bukti->nama_lengkap; ?><br>
                        <?= $bukti->kabupaten; ?><br>
                        <?= $bukti->no_hp; ?><br>
                        <?= $bukti->email; ?>
                     </address>
                  </div>
                  <?php if ($bukti->nama_penerima != '-') : ?>
                     <div class="col-6 text-end">
                        <p class="h3">Penerima</p>
                        <address>
                           <?= $bukti->nama_penerima; ?><br>
                           <?= $bukti->rekening_penerima; ?><br>
                           <?= $bukti->tgl_transfer; ?><br>
                        </address>
                     </div>
                  <?php endif; ?>
                  <div class="col-12 my-5">
                     <h1>Invoice <?= $bukti->id_keuangan; ?></h1>
                  </div>
               </div>
               <table class="table table-transparent table-responsive">
                  <thead>
                     <tr>
                        <th>Bukti Transaksi</th>
                        <th class="text-center" style="width: 1%">Tanggal</th>
                        <th class="text-end" style="width: 1%">Nominal</th>
                     </tr>
                  </thead>
                  <tr>
                     <td>

                        <div class="text-muted"><img style="width:200px;height:auto;" src="<?= base_url(); ?>assets/img/bukti/<?= $bukti->bukti; ?>" alt=""></div>
                     </td>
                     <td class="text-center">
                        <?= $bukti->tgl; ?>
                     </td>
                     <td class="text-end"><?= $bukti->jumlah; ?></td>
                  </tr>

               </table>
               <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
                  you again!</p>
            </div>
         </div>
      </div>
   </div>

</body>

</html>