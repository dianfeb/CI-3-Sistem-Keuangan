<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">

                <!-- Page pre-title -->
                <h2 class="page-title">
                    Riwayat Transaksi
                </h2>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="mb-3">
                            <div class="form-label">Jenis Transaksi</div>
                            <select class="form-select" id="jenis_jenis">
                                <option value="Setor Tunai">Setor Tunai</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Penarikan Tunai">Penarikan Tunai</option>
                                <option value="Penarikan ke Pembayaran">Penarikan ke Pembayaran</option>
                                
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
                        
                        <!-- <button type="button"  onclick="cetakrekap()"  class="btn btn-success mt-3 ms-3"><i class="fa fa-print pr-2"></i>Print</button> -->

                        <button onclick="filterRekap()" class="btn btn-success mt-3 ms-3"><i class="fa fa-print pr-2"></i>Print</button>
                      
                    </div>
                 
                    

                    <div class="m-2">
                        <div class="table-responsive">
                            <table id="tbl_general" class="table table-vcenter card-table table-striped" style="width: 100%;" data-page-length='25';>
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

<!-- 

<div class="container-xl">

    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
  <h2 class="page-title">
                    Bukti Transaksi
                </h2>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <div class="mb-3">
                            <div class="form-label">Jenis Transaksi</div>
                            <select class="form-select" id="jenis_jns">
                                <option value="Deposit">Deposit</option>
                                <option value="Penarikan">Penarikan</option>

                                
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
                        <button type="button" onclick="filter3()" class="btn btn-primary mt-3 ms-3">Filter</button>
                        

                        <button onclick="filterRekap3()" class="btn btn-success mt-3 ms-3"><i class="fa fa-print pr-2"></i>Print</button>
                      
                    </div>
                 
                    

                    <div class="m-2">
                        <div class="table-responsive">
                            <table id="tbl_general2" class="table table-vcenter card-table table-striped" style="width: 100%;" data-page-length='25';>
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
</div> -->
