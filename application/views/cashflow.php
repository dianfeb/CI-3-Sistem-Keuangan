<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Informasi
                </h2>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#pemasukan" value="masuk" onclick="jenis('cashflow')" class="nav-link active" data-bs-toggle="tab">Cashflow</a>
                            </li>
                            <li class="nav-item">
                                <a href="#pemasukan" value="keluar" onclick="jenis('nasabah')" class="nav-link" data-bs-toggle="tab">Nasabah</a>
                            </li>
                            
                        </ul>


                    </div>
                    <div class="m-2 cashflow">
                        <div class="row">
                            <div class="col-md-3">
                                Total Saldo
                            </div>
                            <div class="col-md-3" id="ttlsaldo">

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Total Transaksi
                            </div>
                            <div class="col-md-3" id="ttltransaksi">

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Total Transaksi Perbulan
                            </div>
                            <div class="col-md-3" id="ttlbulan">

                            </div>


                        </div>

                    </div>
                    <div class="m-2 cashflow">
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-select" id="bulan">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="tahun">
                                    <?php for ($i = 2023; $i <= date('Y'); $i++) : ?>

                                        <option value="<?= $i; ?>"><?= $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="filter()" class="btn btn-primary ">Filter</button>
                            </div>


                        </div>

                    </div>
                    <div class="m-2 cashflow">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-blue-lt avatar" id="setor_tunai">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                                        <path d="M12 3v3m0 12v3"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="fs-4 fw-bold mb-0 me-2font-weight-small">
                                                    <span id="jmlsetor_tunai" class="font-weight-medium text-blue"></span>
                                                </div>
                                                <div class="text-muted">
                                                    Setor Tunai
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-blue-lt avatar" id="transfer">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                                        <path d="M12 3v3m0 12v3"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="fs-4 fw-bold mb-0 me-2font-weight-small">
                                                    <span id="jmltransfer" class="font-weight-medium text-blue"></span>
                                                </div>
                                                <div class="text-muted">
                                                    Transfer
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-blue-lt avatar" id="tarik_tunai">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                                        <path d="M12 3v3m0 12v3"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="fs-4 fw-bold mb-0 me-2font-weight-small">
                                                    <span id="jmltarik_tunai" class="font-weight-medium text-blue"></span>
                                                </div>
                                                <div class="text-muted">
                                                    Tarik Tunai
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-blue-lt avatar" id="penarikan_pembayaran">
                                                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                                        <path d="M12 3v3m0 12v3"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="fs-4 fw-bold mb-0 me-2font-weight-small">
                                                    <span id="jmlpenarikan_pembayaran" class="font-weight-medium text-blue"></span>
                                                </div>
                                                <div class="text-muted">
                                                    Penarikan ke Pembayaran
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php $data = $this->db->group_by('dusun')->group_by('kelurahan')->group_by('kecamatan')->get('tbl_pelanggan')->result(); ?>
                    <div class="m-2 nasabah">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-label">Dusun</div>
                                <select class="form-select" id="dusun">
                                    <option value="-">-</option>
                                    <?php foreach ($data as $dusun) : ?>
                                        <option value="<?= $dusun->dusun; ?>"><?= $dusun->dusun; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-label">Desa</div>
                                <select class="form-select" id="kelurahan">
                                    <option value="-">-</option>

                                    <?php foreach ($data as $kelurahan) : ?>
                                        <option value="<?= $kelurahan->kelurahan; ?>"><?= $kelurahan->kelurahan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-label">Kecamatan</div>
                                <select class="form-select" id="kecamatan">
                                    <option value="-">-</option>

                                    <?php foreach ($data as $kecamatan) : ?>
                                        <option value="<?= $kecamatan->kecamatan; ?>"><?= $kecamatan->kecamatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="m-2">
                            <div class="row">
                                <button type="button" onclick="filter2()" class="btn btn-primary mt-3 ">Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="m-2 nasabah">
                        <div class="row">
                            <div class="col-md-6">
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
                                                <div class="fs-4 fw-bold mb-0 me-2font-weight-small">
                                                    <span id="total_nasabah" class="font-weight-medium text-blue"></span>
                                                </div>
                                                <div class="text-muted">
                                                    Total Jumlah Nasabah
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                                <div class="fs-4 fw-bold mb-0 me-2font-weight-small">
                                                    <span id="total_transaksi_nasabah" class="font-weight-medium text-blue"></span>
                                                </div>
                                                <div class="text-muted">
                                                    Total Transaksi
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                    
                </div>
        </div>
    </div>

    <div class="container-xl">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-between">
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
              <div class="col-12">
                <?php
                    $data_nas = $this->db->query("SELECT SUM(jumlah) AS jml, 
                    DATE_FORMAT(tgl, '%m-%Y') AS nas_bulan FROM tbl_keuangan GROUP BY DATE_FORMAT(tgl, '%m-%Y')")->result();

                    foreach($data_nas as $row => $t_nas){

                        $nas[]=['label'=>$t_nas->nas_bulan,  'y'=>$t_nas->jml];
                        
                        
                        }

                    ?>

                        <div id="total_nas" style="height: 300px; width:100%;"></div>
                        <script src="<?= base_url('assets/canvasjs/js/canvasjs.min.js')?>"></script>
                                
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<script type="text/javascript">
    window.onload = function() {

        var chart = new CanvasJS.Chart("total_nas",{
            theme : 'light1',
            animationEnabled: true,
         
            title:{
                text: "Total Transaksi"
            },
            axisY:[{
                title: "Total Transaksi",
            }],
            axisX:[{
                title: "Bulan-Tahun",
            }],
            data:[
                {
                    type: "column",
                    dataPoints:

                    <?=json_encode($nas, JSON_NUMERIC_CHECK);?>
                }
            ]
        });
        chart.render();
    }
</script>


