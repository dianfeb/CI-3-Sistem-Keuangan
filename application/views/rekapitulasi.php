<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Rekap Data Transaksi
                </h2>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="mb-3">
                            <div class="form-label">Jenis Transaksi</div>
                            <select class="form-select" id="jenis">
                                <option value="masuk">Deposit</option>
                                <option value="keluar">Penarikan</option>
                            </select>
                        </div>
                        <div class="ms-3 mb-3">
                            <div class="form-label">Tanggal Awal</div>
                            <input type="date" class="form-control" id="tgl_awal" value="<?=date('Y-m-d')?>">
                        </div>
                        <div class="ms-3 mb-3">
                            <div class="form-label">Tanggal Akhir</div>
                            <input type="date" class="form-control" id="tgl_akhir" value="<?=date('Y-m-d')?>">
                        </div>
                        <button type="button" onclick="filter()" class="btn btn-primary mt-3 ms-3">Filter</button>
                        <!-- <button type="button" onclick="cetak_rekapitulasi()" class="btn btn-success mt-3 ms-3">Cetak</button> -->
                        <!-- <a href="<?= base_url(); ?>Cetak/cetak_rekapitulasi" class="btn btn-success mt-3 ms-3"><i class="fa fa-print pr-2"></i>Print</a> -->
                    </div>
                 
                    

                    <div class="m-2">
                        <div class="table-responsive">
                            <table id="tbl_general" class="table table-vcenter card-table table-striped" style="width: 100%;">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
