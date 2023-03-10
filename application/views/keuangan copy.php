<?php
date_default_timezone_set('Asia/Jakarta');
$tglpl = date('Ymd');

$tgl2 = date('Y-m-d');
$no_default = "001";
$id_keuangan = "T" . $tglpl . "" . $no_default;

$cek = $this->db->like('id_keuangan', 'T' . $tglpl)->get('tbl_keuangan')->result();
if (count($cek) >  0) {


    $last = $this->db->like('id_keuangan', 'T' . $tglpl)->order_by('id_keuangan', 'desc')->get('tbl_keuangan')->row()->id_keuangan;

    $last = substr($last, 10);


    $new = (int)$last + 1;
    $new_nota = substr($last, 0, strpos((string)$last, (string)$new) - strlen((string)$new)) . "" . $new;
    $id_keuangan = "T" . $tglpl . "0" . $new_nota;
}

//   var_dump($id_keuangan);die;
?>
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Transaksi Deposit & Penarikan
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none" id="btn-add-setor">
                <div class="btn-list">
                    <button class="btn btn-primary d-none d-sm-inline-block" onclick="add()">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Tambah Data
                    </button>


                </div>
            </div>
            <div class="col-auto ms-auto d-print-none" id="btn-add-penarikan">
                <div class="btn-list">
                    <button class="btn btn-primary d-none d-sm-inline-block" onclick="addpenarikantunai()">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        Tambah Data
                    </button>

                </div>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs nav-fill" data-bs-toggle="tabs">
                            <li class="nav-item">
                                <a href="#pemasukan" value="masuk" onclick="jenis('masuk')" class="nav-link active" data-bs-toggle="tab">Setor Tunai & Transfer</a>
                            </li>
                            <li class="nav-item">
                                <a href="#pemasukan" value="keluar" onclick="jenis('keluar')" class="nav-link" data-bs-toggle="tab">Penarikan</a>
                            </li>
                        </ul>
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

<div class="modal modal-blur fade" id="general_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url() ?>keuangan/crud_keuangan" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="title-modal">
                        <h5>Tambah Data Keuangan</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php $plg = $this->db->where('status', 'Aktif')->get('tbl_pelanggan')->result(); ?>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12"> <label class="form-label">Kode Transaksi</label>
                            <input type="text" name="id_keuangan" value="<?= $id_keuangan; ?>" class="form-control" readonly>
                            <input type="hidden" name="jenis" value="masuk" id="jenis_transaksi_keuangan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label class="form-label">Nasabah</label>
                            <select name="nasabah" class="form-control" id="nama-nasabah">
                                <option value="#">--Pilih Nasabah--</option>
                                <?php foreach ($plg as $plg) : ?>
                                    <option value="<?= $plg->id_pelanggan; ?>">(<?= $plg->ktp; ?>) <?= $plg->nama_lengkap; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <button class="btn btn-primary btn-sm">Klik Untuk Biodata Singkat Nasabah</button> -->

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="detail-alamat" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KTP</label>
                            <input type="text" class="form-control" id="detail-ktp" readonly>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nama Ibu Kandung</label>
                            <input type="text" class="form-control" id="detail-ibu" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Saldo Sebelumnya</label>
                            <input type="text" class="form-control" id="detail-saldo" readonly>

                        </div>
                    </div>
                    <!-- <label class="form-label">Jenis Keuangan</label>
                    <div class="form-selectgroup-boxes row mb-3" id="jenis">

                    </div> -->

                    <label class="form-label">Jenis Transaksi</label>
                    <div class="form-selectgroup-boxes row mb-3" id="jenis">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-tunai" value="tunai" class="form-selectgroup-input option-transaksi" required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Setor Tunai</span>
                                        <span class="d-block text-muted">Pemberian Uang Secara Langsung</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-transfer" value="transfer" class="form-selectgroup-input option-transaksi" required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Transfer</span>
                                        <span class="d-block text-muted">Transfer dengan bukti transfer</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3" id="jumlah">
                                <label class="form-label">Jumlah (Rp)</label>
                                <input type="text" name="jumlah" class="form-control" placeholder="Jumlah (Rp)">
                            </div>
                        </div>
                        <!-- <?php date_default_timezone_set('Asia/Jakarta'); ?> -->
                        <!-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tgl" value="<?= date('Y-m-d'); ?>" id="tgl" class="form-control" required>
                            </div>
                        </div> -->
                    </div>
                    <div class="row transfer-container">
                        <div class="col-md-6">
                            <label for="">Tanggal Transfer</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="tgl_transfer" id="">

                        </div>
                        <div class="col-md-6">
                            <label for="">Nominal Transfer</label>
                            <input type="number" class="form-control" name="nominal_transfer" id="">

                        </div>
                    </div>
                    <div class="row transfer-container">
                        <div class="col-md-6">
                            <label for="">Nama Pengirim</label>
                            <input type="text" class="form-control" name="nama_pengirim" id="">

                        </div>
                        <div class="col-md-6">
                            <label for="">No. Rekening Pengirim</label>
                            <input type="number" class="form-control" name="rekening_pengirim" id="">

                        </div>
                    </div>


                    <div class="row mt-2">
                        <label class="form-label">Upload Bukti Transaksi</label>
                        <div class="input-group col-md-12">
                            <input type="file" class="form-control" name="bukti" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-body">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal modal-blur fade" id="penarikan_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url() ?>keuangan/crud_keuangan" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="title-modal">
                        <h5>Tambah Data Keuangan</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php $plg = $this->db->where('status', 'Aktif')->get('tbl_pelanggan')->result(); ?>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12"> <label class="form-label">Kode Transaksi</label>
                            <input type="text" name="id_keuangan" value="<?= $id_keuangan; ?>" class="form-control" readonly>
                            <input type="hidden" name="jenis" value="keluar" id="jenis_transaksi_keuangan" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label class="form-label">Nasabah</label>
                            <select name="nasabah" class="form-control" id="nama-nasabah-penarikan">
                                <option value="#">--Pilih Nasabah--</option>
                                <?php foreach ($plg as $plg) : ?>
                                    <option value="<?= $plg->id_pelanggan; ?>">(<?= $plg->ktp; ?>) <?= $plg->nama_lengkap; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <button class="btn btn-primary btn-sm">Klik Untuk Biodata Singkat Nasabah</button> -->

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="detail-alamat-penarikan" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">No. KTP</label>
                            <input type="text" class="form-control" id="detail-ktp-penarikan" readonly>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nama Ibu Kandung</label>
                            <input type="text" class="form-control" id="detail-ibu-penarikan" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Saldo Sebelumnya</label>
                            <input type="text" class="form-control" id="detail-saldo-penarikan" readonly>

                        </div>
                    </div>
                    <!-- <label class="form-label">Jenis Keuangan</label>
                    <div class="form-selectgroup-boxes row mb-3" id="jenis">

                    </div> -->

                    <label class="form-label">Jenis Transaksi</label>
                    <div class="form-selectgroup-boxes row mb-3" id="jenis">
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-tunai-penarikan" value="tunai" class="form-selectgroup-input option-transaksi" required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Penarikan Tunai</span>
                                        <span class="d-block text-muted">Penarikan Uang Secara Langsung</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-transfer-penarikan" value="transfer" class="form-selectgroup-input option-transaksi" required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Penarikan ke Pembayaran</span>
                                        <span class="d-block text-muted">Penarikan dengan bukti transfer</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3" id="jumlah-penarikan">
                                <label class="form-label">Jumlah (Rp)</label>
                                <input type="text" name="jumlah" class="form-control" placeholder="Jumlah (Rp)">
                            </div>
                        </div>
                        <!-- <?php date_default_timezone_set('Asia/Jakarta'); ?> -->
                        <!-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tgl" value="<?= date('Y-m-d'); ?>" id="tgl" class="form-control" required>
                            </div>
                        </div> -->
                    </div>
                    <div class="row transfer-container-penarikan">
                        <div class="col-md-6">
                            <label for="">Tanggal Transfer</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d'); ?>" name="tgl_transfer" id="">

                        </div>
                        <div class="col-md-6">
                            <label for="">Nominal Transfer</label>
                            <input type="number" class="form-control" name="nominal_transfer" id="">

                        </div>
                    </div>
                    <div class="row transfer-container-penarikan">
                        <div class="col-md-6">
                            <label for="">Nama Pengirim</label>
                            <input type="text" class="form-control" name="nama_pengirim" id="">

                        </div>
                        <div class="col-md-6">
                            <label for="">No. Rekening Pengirim</label>
                            <input type="number" class="form-control" name="rekening_pengirim" id="">

                        </div>
                    </div>
                    <div class="row transfer-container-penarikan">
                        <div class="col-md-6">
                            <label for="">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima" id="">

                        </div>
                        <div class="col-md-6">
                            <label for="">No. Rekening Penerima</label>
                            <input type="number" class="form-control" name="rekening_penerima" id="">

                        </div>
                    </div>


                    <div class="row mt-2 transfer-container-penarikan">
                        <label class="form-label">Upload Bukti Transaksi</label>
                        <div class="input-group col-md-12">
                            <input type="file" class="form-control" name="bukti" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-body">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal modal-blur fade" id="detail_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="title-modal-detail">
                    <h5>Detail Keuangan</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $plg = $this->db->where('status', 'Aktif')->get('tbl_pelanggan')->result(); ?>
            <div class="modal-body">

                <div class="mb-3">
                    <div class="mb-3">
                        <label class="form-label">Nasabah</label>
                        <select name="nasabah" class="form-control" id="nama-nasabah-detail">

                        </select>
                    </div>
                    <!-- <button class="btn btn-primary btn-sm">Klik Untuk Biodata Singkat Nasabah</button> -->

                </div>
             
                <div class="row">
                  
                    <div class="col-md-12">
                        <label class="form-label">Saldo Sebelumnya</label>
                        <input type="text" class="form-control" id="detail-saldo-detail" readonly>

                    </div>
                </div>
                <!-- <label class="form-label">Jenis Keuangan</label>
                    <div class="form-selectgroup-boxes row mb-3" id="jenis">

                    </div> -->

                <label class="form-label">Jenis Transaksi</label>
                <div class="form-selectgroup-boxes row mb-3" id="jenis-detail">
                    <div class="col-lg-6">
                        <a href="" style="text-decoration:none;" id="depo-tunai">
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <!-- <span class="form-selectgroup-check"></span> -->
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">Setor Tunai</span>
                                    <span class="d-block text-muted">Pemberian Uang Secara Langsung</span>
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">Transfer</span>
                                    <span class="d-block text-muted">Transfer dengan bukti transfer</span>
                                </span>
                            </span>
                        </label>
                    </div>
                </div>
             
            </div>
            <div class="modal-footer modal-body">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
                <a target="_blank" id="cetak_transaksi" class="btn btn-success ms-auto">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Cetak Bukti
                </a>
            </div>
        </div>
        

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $('#nama-nasabah').change(function() {
        var id = $('#nama-nasabah').val();
        // console.log(id);
        $.ajax({
            url: '<?= base_url(); ?>Keuangan/search_nasabah_byid',
            type: 'post',
            data: {
                id: id
            },
            success: function(response) {

                var data = JSON.parse(response);
                // console.log(data);
                $('#detail-alamat').val(data.kota);
                $('#detail-ktp').val(data.ktp);
                $('#detail-ibu').val(data.ibu);
            }
        })
    })
    $('#nama-nasabah').change(function() {
        var id = $('#nama-nasabah').val();
        // console.log(id);
        $.ajax({
            url: '<?= base_url(); ?>Keuangan/sisa_saldo',
            type: 'post',
            data: {
                id: id
            },
            success: function(response) {

                var data = JSON.parse(response);
                // console.log(response);

                $('#detail-saldo').val(data.saldo);

            }
        })
    })
    $('#nama-nasabah-penarikan').change(function() {
        var id = $('#nama-nasabah-penarikan').val();
        // console.log(id);
        $.ajax({
            url: '<?= base_url(); ?>Keuangan/search_nasabah_byid',
            type: 'post',
            data: {
                id: id
            },
            success: function(response) {

                var data = JSON.parse(response);
                // console.log(data);
                $('#detail-alamat-penarikan').val(data.kota);
                $('#detail-ktp-penarikan').val(data.ktp);
                $('#detail-ibu-penarikan').val(data.ibu);
            }
        })
    })
    $('#nama-nasabah-penarikan').change(function() {
        var id = $('#nama-nasabah-penarikan').val();
        // console.log(id);
        $.ajax({
            url: '<?= base_url(); ?>Keuangan/sisa_saldo',
            type: 'post',
            data: {
                id: id
            },
            success: function(response) {

                var data = JSON.parse(response);

                $('#detail-saldo-penarikan').val(data.saldo);

            }
        })
    })
</script>

<script>
    $('#jumlah').hide();
    $('.transfer-container').hide();
    $('#option-transaksi-tunai').click(function() {
        var option = $('#option-transaksi-tunai').val();
        $('.transfer-container').hide();
        $('#jumlah').show();

    })
 

    $('#option-transaksi-transfer').click(function() {
        var option = $('#option-transaksi-transfer').val();
        $('#jumlah').hide();
        $('.transfer-container').show();

    })
    $('#option-transaksi-tunai-penarikan').click(function() {
        var option = $('#option-transaksi-tunai-penarikan').val();
        $('.transfer-container-penarikan').hide();
        $('#jumlah-penarikan').show();

    })
    $('#option-transaksi-transfer-penarikan').click(function() {
        var option = $('#option-transaksi-transfer-penarikan').val();
        $('#jumlah-penarikan').hide();
        $('.transfer-container-penarikan').show();

    })


</script>