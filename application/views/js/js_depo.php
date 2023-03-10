<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        showTable('masuk');

        if ('<?= $this->session->flashdata('alert') ?>' == 'success') {
            var timerInterval;
            Swal.fire({
                title: "Berhasil!",
                icon: "success",
                html: '<?= $this->session->flashdata('message') ?> <br><b></b> milliseconds.',
                timer: 500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })

        } else if ('<?= $this->session->flashdata('alert') ?>' == 'error') {
            Swal.fire(
                'Gagal!',
                '<?= $this->session->flashdata('message') ?>',
                'error'
            )
        }
    })

    $('#btn-add-setor').show();
    // $('#btn-add-penarikan').hide();

    function jenis() {
        $('#btn-add-setor').show();
        showTable();

        console.log(id);

    }

    function showTable() {

        var nasabah = $('#id_nasabah').val();
        var jenis = $('#jenis').val();
        if ($.fn.DataTable.isDataTable('#tbl_general')) {
            $("#tbl_general").dataTable().fnDestroy();
            $('#tbl_general').empty();
        }

        var table = $('#tbl_general').DataTable({
            dom: 'Brtip',
            "ajax": {
                "type": 'POST',
                "url": '<?= base_url() ?>Transaksi/getKeuangan',
                "data": {
                    jenis: jenis,
                    id_pelanggan: nasabah
                    // csrf_baseben: '<?= $this->security->get_csrf_hash() ?>'
                }
            },
            columns: [{
                    title: 'No',
                    data: 'no',
                },
                {
                    title: 'Tanggal',
                    data: 'tgl',

                },
                {
                    title: 'Kode Transaksi',
                    data: 'id_keuangan',
                },
                {
                    title: 'Nominal',
                    data: 'rp',
                },
                {
                    title: 'Jenis Deposit',
                    data: 'jenis_jenis',
                },
                {
                    title: 'Rekening Pengirim',
                    data: 'rekening_pengirim',
                },
                {
                    title: 'Bukti Trf',
                    data: 'bukti',
                },
                // {
                //     title: 'Status',
                //     data: 'status',
                //     render: function(k, v, r) {
                //         if (r.status == 'Aktif') {
                //             return '<span class="badge badge-success"> ' + r.status + '</span>'
                //         } else {
                //             return '<span class="badge badge-danger"> ' + r.status + '</span>'
                //         }
                //     },
                //     className: 'text-center'
                // },
                {
                    title: 'Aksi',
                    data: 'id_keuangan',
                    render: function(k, v, r) {
                        var button_color = 'danger'
                        var status = 'Tidak Aktif'
                        if (r.status == 'Tidak Aktif') {
                            button_color = 'success'
                            status = 'Aktif'
                        }


                        return `
                        <div class="row g-2 align-items-center mb-n3">
                          <div class="col-4 col-sm-3 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-info w-50 btn-sm  btn-icon" title="Cetak Data" onclick="cetak(\'` + r.id_keuangan + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/detail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-primary w-50 btn-sm btn-icon" title="Edit Data" onclick="edit(\'` + r.id_keuangan + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </button>
                            </div>

                        
                            <div class="col-4 col-sm-3 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-danger w-50 btn-sm  btn-icon"  title="Hapus Data" onclick="hapus_data(\'` + r.id_keuangan + `\',\'Deleted\',\'` + r.jenis + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>`;
                    },
                    width: '150px'
                }

            ],
            // rowGroup: {
            //     dataSrc: 'type',
            // },
            "scrollX": true,
            "displayLength": 25
        });

    }

    function add() {
        $('.modal-title').html(`<h5>Tambah Data</h5>`);
        $('#general_modal').modal('show')
        var id = $('#id_nasabah').val();
        $.ajax({
            url: '<?= base_url() ?>Transaksi/getKeuangan',
            type: 'POST',
            data: {
                'id_pelanggan': id,
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response);
                $('#nama-nasabah').append(`  <option selected value="` + response.data[0].id_pelanggan + `">` + response.data[0].nasabah + `</option>`);
                $('#tujuan').val(response.data[0].tujuan);
                $('#id_pelanggan_crud').val(response.data[0].id_pelanggan);
                $('#id_keuangan').val(response.data[0].id_keuangan);
                $('#jumlah').val(response.data[0].jumlah);
                $('#tgl').val(response.data[0].tgl);
                $('#detail-alamat-add').val(response.data[0].dusun);
                $('#detail-ktp').val(response.data[0].ktp);
                // $('#detail-ibu').val(response.data[0].ibu);
                $('#detail-saldo').val(response.data[0].sisa_saldo);

                if (response.data[0].jenis == 'Deposit') {
                    $('#jenis').html(`<div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis" value="Deposit" class="form-selectgroup-input" checked required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Pemasukan</span>
                                        <span class="d-block text-muted">Pemasukan Keuangan</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis" value="Penarikan" class="form-selectgroup-input" required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Pengeluaran</span>
                                        <span class="d-block text-muted">Pengeluaran Keuangan</span>
                                    </span>
                                </span>
                            </label>
                        </div>`)
                } else {
                    $('#jenis').html(`<div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis" value="Deposit" class="form-selectgroup-input" required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Pemasukan</span>
                                        <span class="d-block text-muted">Pemasukan Keuangan</span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis" value="Penarikan" class="form-selectgroup-input" checked required>
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                    <span class="me-3">
                                        <span class="form-selectgroup-check"></span>
                                    </span>
                                    <span class="form-selectgroup-label-content">
                                        <span class="form-selectgroup-title strong mb-1">Pengeluaran</span>
                                        <span class="d-block text-muted">Pengeluaran Keuangan</span>
                                    </span>
                                </span>
                            </label>
                        </div>`)
                }

            }
        })
    }

    function addpenarikantunai() {
        // $('.modal-title').html('<h5>Penarikan Tunai & Pembayaran</h5>')
        $('#penarikan_modal').modal('show')
        // $('#jenis_transaksi_keuangan').val('Penarikan');
        // $('#tujuan').val('')
        // $('#id_keuangan').val('')
        // $('#jumlah').val('')
        // $('#tgl').val('')

        $('#jenis_transaksi').html(``);
    }

    function edit(id) {

        
        $('#title-modal').html('Edit Data Keuangan')
        $('#edit_modal').modal('show')
        $.ajax({
            url: '<?= base_url() ?>keuangan/getKeuangan',
            type: 'POST',
            data: {
                'id_keuangan': id,
              
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response);

                $('#nama-nasabah-depo').append(`  <option selected value="` + response.data[0].id_pelanggan + `">` + response.data[0].nasabah + `</option>`);
                // $('#tujuan').val(response.data[0].tujuan);
                $('#id_keuangan_depo').val(response.data[0].id_keuangan);
                $('#id_pelanggan_depo').val(response.data[0].id_pelanggan);
                $('#jumlah_depo').val(response.data[0].jumlah);
                $('#tgl_depo').val(response.data[0].tgl);
                $('#nominal_depo').val(response.data[0].nominal_transfer);
                $('#nama_pengirim_depo').val(response.data[0].nama_pengirim);
                $('#rekening_pengirim_depo').val(response.data[0].rekening_pengirim);
                $('#nama_penerima_depo').val(response.data[0].nama_penerima);
                $('#rekening_penerima_depo').val(response.data[0].rekening_penerima);
                $('#jenis_transaksi_keuangan').val(response.data[0].jenis);
                $('#detail-alamat-depo').val(response.data[0].dusun);
                $('#detail-ktp-depo').val(response.data[0].ktp);
                $('#nominal_depo').val(response.data[0].nominal_transfer);
                // $('#detail-ibu-depo').val(response.data[0].ibu);
                $('#detail-saldo-depo').val(response.data[0].sisa_saldo);
                $('#gambar_transfer').attr('href', '<?= base_url(); ?>assets/img/bukti/' + response.data[0].bukti);
                if (response.data[0].jenis_transaksi == 'transfer') {
                    $('.transfer-container-depo').show();
                } else {
                    $('.transfer-container-depo').hide();

                }
                if (response.data[0].jenis_transaksi == 'tunai') {
                    $('#jenis_depo').html(`
                    <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                            <input type="radio" name="jenis_transaksi" id="option-transaksi-tunai-edit" value="tunai" class="form-selectgroup-input option-transaksi" checked required>
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
                            <input type="radio" name="jenis_transaksi" id="option-transaksi-transfer-edit" value="transfer" class="form-selectgroup-input option-transaksi" required>
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
                        `)
                } else {
                    $('#jenis_depo').html(`
                    <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                            <input type="radio" name="jenis_transaksi" id="option-transaksi-tunai-edit" value="tunai" class="form-selectgroup-input option-transaksi" required>
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
                            <input type="radio" name="jenis_transaksi" id="option-transaksi-transfer-edit" value="transfer" class="form-selectgroup-input option-transaksi" checked required>
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
                        `)
                }
                $('#option-transaksi-tunai-edit').click(function() {
                    // alert('tunai');
                    $('.transfer-container-depo').hide();
                    $('#jumlah-depo').show();

                })


                $('#option-transaksi-transfer-edit').click(function() {
                    // alert('transfer');
                    $('#jumlah-depo').hide();
                    $('.transfer-container-depo').show();

                })
            }
        })
    }

    function cetak(id) {
        window.location.href = '<?= base_url(); ?>Cetak/cetak_transaksi?id=' + id;
    }

    function detailGambar(id) {
        $('.modal-title').html(`<h5>Gambar Transaksi </h5>`);
        $('#gambar_modal').modal('show');
        $('#detail_gambar_bukti').attr("src", "assets/img/bukti/".id);

    }

    function update_status(id, status, jenis) {
        $.ajax({
            url: '<?= base_url() ?>Transaksi/update_status',
            type: 'POST',
            data: {
                'id_keuangan': id,
                'status': status,
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response)
                if (response.kode == 200) {
                    var timerInterval;
                    Swal.fire({
                        title: "Berhasil!",
                        icon: "success",
                        html: '<?= $this->session->flashdata('message') ?> <br><b></b> milliseconds.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                    showTable(jenis)
                } else {
                    Swal.fire(
                        'Gagal!',
                        response.keterangan,
                        'error'
                    )
                }
            }
        })
    }

    function hapus_data(id, status, jenis) {
        Swal.fire({
            title: 'Konfirmasi hapus',
            text: "Apa kamu yakin untuk menghapusnya ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '<?= base_url() ?>keuangan/update_status',
                    type: 'POST',
                    data: {
                        'id_keuangan': id,
                        'status': status,
                        // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
                    },
                    success: function(response) {
                        response = JSON.parse(response)
                        if (response.kode == 200) {

                            var timerInterval;
                            Swal.fire({
                                title: "Berhasil!",
                                icon: "success",
                                html: '<?= $this->session->flashdata('message') ?> <br><b></b> milliseconds.',
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    const b = Swal.getHtmlContainer().querySelector('b')
                                    timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                            location.reload();
                            showTable(jenis)
                        } else {
                            Swal.fire(
                                'Gagal!',
                                response.keterangan,
                                'error'
                            )
                        }
                    }
                })

            }
        })

    }
</script>