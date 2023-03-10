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

        } else if ('<?= $this->session->flashdata('alert') ?>' == 'error') {
            Swal.fire(
                'Gagal!',
                '<?= $this->session->flashdata('message') ?>',
                'error'
            )
        }
    })

    $('#btn-add-setor').show();
    $('#btn-add-penarikan').hide();

    function jenis(id) {
        showTable(id);

        console.log(id);
        if (id == "masuk") {
            $('#btn-add-setor').show();
            $('#btn-add-penarikan').hide();
        } else {
            $('#btn-add-setor').hide();
            $('#btn-add-penarikan').show();

        }
    }

    function showTable(jenis) {

        if ($.fn.DataTable.isDataTable('#tbl_general')) {
            $("#tbl_general").dataTable().fnDestroy();
            $('#tbl_general').empty();
        }

        var table = $('#tbl_general').DataTable({
            dom: 'Brtip',
            "ajax": {
                "type": 'POST',
                "url": '<?= base_url() ?>keuangan/getKeuangan',
                "data": {
                    jenis: jenis,
                    // csrf_baseben: '<?= $this->security->get_csrf_hash() ?>'
                }
            },
            columns: [{
                    title: 'No',
                    data: 'no',
                },
                {
                    title: 'Nasabah',
                    data: 'nasabah',

                },
                {
                    title: 'Dusun',
                    data: 'kelurahan',
                },
                {
                    title: 'Kecamatan',
                    data: 'kecamatan',
                },
                {
                    title: 'Sisa Saldo (Rp)',
                    data: 'sisa_saldo',
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
                                <button class="btn btn-info w-50 btn-sm  btn-icon" title="Detail Data" onclick="detail(\'` + r.id_keuangan + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/detail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                </button>
                            </div>
                            <div class="col-4 col-sm-3 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-primary w-50 btn-sm  btn-icon" title="Edit Data" onclick="edit(\'` + r.id_keuangan + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                </button>
                            </div>

                        
                            <div class="col-4 col-sm-3 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-danger w-50 btn-sm  btn-icon"  title="Hapus Data" onclick="hapus_data(\'` + r.id_keuangan + `\',\'Deleted\',\'` + r.jenis + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
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
            "displayLength": 5
        });

    }

    function add() {
        $('.modal-title').html(`<h5>Tambah Data Setor Tunai dan Transfer</h5>`);
        $('#general_modal').modal('show')
        // $('#tujuan').val('')
        // $('#id_keuangan').val('')
        // $('#jumlah').val('')
        // $('#tgl').val('')
        $('#jenis_transaksi').html(``);
    }

    function addpenarikantunai() {
        // $('.modal-title').html('<h5>Penarikan Tunai & Pembayaran</h5>')
        $('#penarikan_modal').modal('show')
        // $('#jenis_transaksi_keuangan').val('keluar');
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

                console.log(response);
                $('#nama-nasabah').append(`  <option selected value="` + response.data[0].kd_pelanggan + `">` + response.data[0].nasabah + `</option>`);
                $('#tujuan').val(response.data[0].tujuan);
                $('#id_keuangan').val(response.data[0].id_keuangan);
                $('#jumlah').val(response.data[0].jumlah);
                $('#tgl').val(response.data[0].tgl);
                $('#detail-alamat').val(response.data[0].alamat);
                $('#detail-ktp').val(response.data[0].ktp);
                $('#detail-ibu').val(response.data[0].ibu);
                $('#detail-saldo').val(response.data[0].sisa_saldo);

                if (response.data[0].jenis == 'masuk') {
                    $('#jenis').html(`<div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis" value="masuk" class="form-selectgroup-input" checked required>
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
                                <input type="radio" name="jenis" value="keluar" class="form-selectgroup-input" required>
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
                                <input type="radio" name="jenis" value="masuk" class="form-selectgroup-input" required>
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
                                <input type="radio" name="jenis" value="keluar" class="form-selectgroup-input" checked required>
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

    function detail(id) {
        $('#title-modal-detail').html(`Detail Transaksi - ` + id + ``);
        $('#detail_modal').modal('show');

        $.ajax({
            url: '<?= base_url() ?>keuangan/getKeuangan',
            type: 'POST',
            data: {
                'id_keuangan': id,
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response)
                $('#depo-tunai').attr(`href`,`<?=base_url();?>Transaksi/Deposit/`+response.data[0].id_pelanggan);
                $('#depo-tunai').attr(`href`,`<?=base_url();?>Transaksi/Depo/Transfer/`+response.data[0].id_pelanggan);

                $('#cetak_transaksi').attr('href', `<?= base_url(); ?>Cetak/cetak_transaksi?id=` + id + ``);
                $('#nama-nasabah-detail').append(`  <option selected value="` + response.data[0].kd_pelanggan + `">` + response.data[0].nasabah + `</option>`);
                $('#tujuan-detail').val(response.data[0].tujuan);
                $('#id_keuangan_detail').val(response.data[0].id_keuangan);
                $('#jumlah-detail').val(response.data[0].jumlah);
                $('#tgl-detail').val(response.data[0].tgl);
                $('#detail-alamat-detail').val(response.data[0].alamat);
                $('#detail-ktp-detail').val(response.data[0].ktp);
                $('#detail-ibu-detail').val(response.data[0].ibu);
                $('#detail-saldo-detail').val(response.data[0].sisa_saldo);
                $('#jumlah-detail').html(`    <label class="form-label">Jumlah (Rp)</label>
                                <input type="text" value="` + response.data[0].jumlah + `"name="jumlah" class="form-control" placeholder="Jumlah (Rp)">`);
                if (response.data[0].jenis == 'masuk' && response.data[0].jenis_transaksi == 'tunai') {
                    $('.transfer-container').hide();


                    $('#jenis-detail').html(`<div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-tunai" value="tunai" class="form-selectgroup-input option-transaksi" checked required>
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
                      `)
                } else if (response.data[0].jenis == 'masuk' && response.data[0].jenis_transaksi == 'transfer') {
                    $('.transfer-container').show();
                    $('#nominal_transfer_detail').val(response.data[0].nominal_transfer);
                    $('#nama_pengirim_detail').val(response.data[0].nama_pengirim);
                    $('#rekening_pengirim_detail').val(response.data[0].rekening_pengirim);
                    $('#bukti_tf').html(`<label>Bukti Transfer</label><img style="height:200px; width:200px;" src="<?= base_url() ?>assets/img/bukti/` + response.data[0].bukti + `" alt="Bukti transaksi" class="mt-2 img-thumbnail rounded text-center d-flex justify-content-center">`);


                    $('#jenis-detail').html(`<div class="col-lg-6">
                            <label class="form-selectgroup-item">
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-tunai" value="tunai" class="form-selectgroup-input option-transaksi"  required>
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
                                <input type="radio" name="jenis_transaksi" id="option-transaksi-transfer" value="transfer" class="form-selectgroup-input option-transaksi"   checked required>
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
                        </div>`)
                }

            }
        })
    }

    function update_status(id, status, jenis) {
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