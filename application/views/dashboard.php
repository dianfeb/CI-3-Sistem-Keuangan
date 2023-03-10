<div class="container-xl">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-between">
      <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
          Overview
        </div>
        <h2 class="page-title">
          Dashboard
        </h2>
      </div>
      <div class="col justify-item-end">
        <div class="page-pretitle"></div>
        <div class="page-title">
          <!-- <?=date('d F Y');?> -->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row row-cards">
      <div class="col-lg-12">
        
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-3">
                <img src="<?= base_url() ?>public/img/hello.svg" alt="Welcome" class="rounded">
              </div>
              <div class="col">
                <h1 class="card-title mb-1">
                  <h1>Hallo!, <?= $this->session->userdata('nama_lengkap') ?></h1>
                </h1>
                <h5 class="text-muted">
                  Selamat Datang di Halaman <b><?= title() ?>. Silahkan kunjungi menu-menu yang ada untuk mengakes data yang anda inginkan.</b>
                </h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-green-lt avatar">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="18" y1="13" x2="12" y2="19"></line>
                    <line x1="6" y1="13" x2="12" y2="19"></line>
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="h1 mb-0 me-2font-weight-medium">
                  <span class="font-weight-medium text-green"><?="Rp " . number_format(($bulan_masuk), 0, ',', '.')?></span>
                </div>
                <div class="text-muted">
                  Deposit Bulan <?= getBln(date('m')) ?> <?=date('Y')?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-red-lt avatar">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="18" y1="11" x2="12" y2="5"></line>
                    <line x1="6" y1="11" x2="12" y2="5"></line>
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="h1 mb-0 me-2font-weight-medium">
                  <!-- <span class="font-weight-medium text-red"><?=rupiah($bulan_keluar)?></span> -->
                  <span class="font-weight-medium text-red"><?="Rp " . number_format(($bulan_keluar), 0, ',', '.')?></span>
                </div>
                <div class="text-muted">
                  Penarikan Bulan <?= getBln(date('m')) ?> <?=date('Y')?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-blue-lt avatar">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                    <path d="M12 3v3m0 12v3"></path>
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="h1 mb-0 me-2font-weight-medium">
                  <span class="font-weight-medium text-blue"><?="Rp " . number_format(($bulan_masuk - $bulan_keluar), 0, ',', '.')?></span>
                </div>
                <div class="text-muted">
                  Saldo Bulan <?= getBln(date('m')) ?> <?=date('Y')?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-green-lt avatar">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="18" y1="13" x2="12" y2="19"></line>
                    <line x1="6" y1="13" x2="12" y2="19"></line>
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="h1 mb-0 me-2font-weight-medium">
                  <span class="font-weight-medium text-green"><?="Rp " . number_format(($total_masuk),0, ',', '.')?></span>
                </div>
                <div class="text-muted">
                  Total Deposit
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-red-lt avatar">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="18" y1="11" x2="12" y2="5"></line>
                    <line x1="6" y1="11" x2="12" y2="5"></line>
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="h1 mb-0 me-2font-weight-medium">
                  <span class="font-weight-medium text-red"><?="Rp " . number_format(($total_keluar),0, ',', '.')?></span>
                </div>
                <div class="text-muted">
                  Total Penarikan
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-blue-lt avatar">
                  <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                    <path d="M12 3v3m0 12v3"></path>
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="h1 mb-0 me-2font-weight-medium">
                  <span class="font-weight-medium text-blue"><?="Rp " . number_format(($total_masuk - $total_keluar), 0, ',', '.')?></span>
                </div>
                <div class="text-muted">
                  Total Saldo
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>