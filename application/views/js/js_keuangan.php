<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        showTable('Deposit');

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
    $('#btn-add-penarikan').hide();

    function jenis(id) {
        showTable(id);

        console.log(id);
        if (id == "Deposit") {
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

        if (jenis == "Deposit") {
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
                        data: 'dusun',
                    },
                    {
                        title: 'Desa',
                        data: 'kelurahan',
                    },
                    {
                        title: 'Kecamatan',
                        data: 'kecamatan',
                    },
                    {
                        title: 'Total Deposit',
                        data: 'total_depo',
                    },
                    {
                        title: 'Saldo ',
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M9 12l.01 0"></path>
                                    <path d="M13 12l2 0"></path>
                                    <path d="M9 16l.01 0"></path>
                                    <path d="M13 16l2 0"></path>
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
        } else {
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
                        data: 'dusun',
                    },
                    {
                        title: 'Desa',
                        data: 'kelurahan',
                    },
                    {
                        title: 'Kecamatan',
                        data: 'kecamatan',
                    },
                  
                    {
                        title: 'Total Penarikan ',
                        data: 'totalpenarikan',
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-list" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                    <path d="M9 12l.01 0"></path>
                                    <path d="M13 12l2 0"></path>
                                    <path d="M9 16l.01 0"></path>
                                    <path d="M13 16l2 0"></path>
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

    function detail(id) {
        // $('#title-modal-detail').html(`Detail Transaksi - ` + id + ``);
        // $('#detail_modal').modal('show');

        $.ajax({
            url: '<?= base_url() ?>keuangan/getKeuangan',
            type: 'POST',
            data: {
                'id_keuangan': id,
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response.data[0].jenis);
                if (response.data[0].jenis == "Deposit") {
                    window.location.href = `<?= base_url(); ?>Transaksi/Depo?id=` + response.data[0].id_pelanggan + `&jns=` + response.data[0].jenis;
                    $('.depo-tunai-keuangan').attr(`href`, `<?= base_url(); ?>Transaksi/Depo?id=` + response.data[0].id_pelanggan + `&jns=` + response.data[0].jenis);

                } else if (response.data[0].jenis == "Penarikan") {

                    window.location.href = `<?= base_url(); ?>Transaksi/Tarik?id=` + response.data[0].id_pelanggan + `&jns=` + response.data[0].jenis;
                    $('.depo-tunai-keuangan').attr(`href`, `<?= base_url(); ?>Transaksi/Tarik?id=` + response.data[0].id_pelanggan + `&jns=` + response.data[0].jenis);
                }
                // $('#depo-tunai').attr(`href`,`<?= base_url(); ?>Transaksi/Depo/Transfer/`+response.data[0].id_pelanggan);

                // $('#cetak_transaksi').attr('href', `<?= base_url(); ?>Cetak/cetak_transaksi?id=` + id + ``);
                // $('#nama-nasabah-detail').append(`  <option selected value="` + response.data[0].kd_pelanggan + `">` + response.data[0].nasabah + `</option>`);
                // $('#tujuan-detail').val(response.data[0].tujuan);
                // $('#id_keuangan_detail').val(response.data[0].id_keuangan);
                // $('#jumlah-detail').val(response.data[0].jumlah);
                // $('#tgl-detail').val(response.data[0].tgl);
                // $('#detail-alamat-detail').val(response.data[0].alamat);
                // $('#detail-ktp-detail').val(response.data[0].ktp);
                // $('#detail-ibu-detail').val(response.data[0].ibu);
                // $('#detail-saldo-detail').val(response.data[0].sisa_saldo);
                // $('#jumlah-detail').html(`    <label class="form-label">Jumlah (Rp)</label>
                //                 <input type="text" value="` + response.data[0].jumlah + `"name="jumlah" class="form-control" placeholder="Jumlah (Rp)">`);


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