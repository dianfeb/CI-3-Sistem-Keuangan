<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        showTable();
        
    })

    function filter() {
        showTable();
        
    }

    function cetak(id) {
        window.location.href = '<?= base_url(); ?>Cetak/cetak_riwayat?id=' + id;
    }

    function cetak_bukti_riwayat(id) {
        window.location.href = '<?= base_url(); ?>Cetak/cetak_riwayat_bukti?id=' + id;
    }




    function filter2() {
        $('#detail_modal').modal('hide');

        if ($.fn.DataTable.isDataTable('#tbl_general')) {
            $("#tbl_general").dataTable().fnDestroy();
            $('#tbl_general').empty();
        }

        var table = $('#tbl_general').DataTable({
            dom: 'Brtip',
            "ajax": {
                "type": 'POST',
                "url": '<?= base_url() ?>riwayat/getKeuangan',
                "data": {
                    id_pelanggan: $('#nasabah').val(),
                    jenis: $('#jenis_jns').val(),
                    tgl_awal: $('#tgl_awal').val(),
                    tgl_akhir: $('#tgl_akhir').val(),
                    status: 'Aktif',
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
                    title: 'Jenis ',
                    data: 'jenis',
                },
                {
                    title: 'Keterangan',
                    data: 'tujuan',

                },
                {
                    title: 'Tanggal',
                    data: 'tanggal',
                },
                {
                    title: 'Jumlah (Rp)',
                    data: 'rp',
                },

            ],
            // rowGroup: {
            //     dataSrc: 'type',
            // },
            "scrollX": true,
            "displayLength": 25
        });



    }

    function filterRekap() {

        var jenis = $('#jenis_jenis').val();
        var tgl_awal = $('#tgl_awal').val();
        var tgl_akhir = $('#tgl_akhir').val();

        if (jenis == 'Setor Tunai') {
            var jenis = 'Deposit';
            var jenis_transaksi = 'tunai';


        } else if (jenis == 'Transfer') {
            var jenis = 'Deposit';
            var jenis_transaksi = 'transfer';


        } else if (jenis == 'Penarikan Tunai') {
            var jenis = 'Penarikan';
            var jenis_transaksi = 'tunai';


        } else if (jenis == 'Penarikan ke Pembayaran') {
            var jenis = 'Penarikan';
            var jenis_transaksi = 'transfer';


        }
        window.location.href = 'https://siskeu.tand.asia/Cetak/cetak_riwayat?jenis=' + jenis +
            "&trs=" + jenis_transaksi +
            "&tgl1=" + tgl_awal +
            "&tgl2=" + tgl_akhir;



    }


    function detailGambar(id) {
        $('.modal-title').html(`<h5>Gambar Transaksi </h5>`);
        $('#gambar_modal').modal('show');
        $('#detail_gambar_bukti').attr("src", "assets/img/bukti/".id);

    }



    function cetakrekap() {
        $.ajax({
            "type": 'POST',
            "url": '<?= base_url() ?>Cetak/cetak_riwayat',
            "data": {

                jenis: $('#jenis_jenis').val(),
                tgl_awal: $('#tgl_awal').val(),
                tgl_akhir: $('#tgl_akhir').val(),

                status: 'Aktif',

            },


        })

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
                "url": '<?= base_url() ?>riwayat/getKeuangan',
                "data": {

                    jenis: $('#jenis_jenis').val(),
                    tgl_awal: $('#tgl_awal').val(),
                    tgl_akhir: $('#tgl_akhir').val(),

                    status: 'Aktif',
                    // csrf_baseben: '<?= $this->security->get_csrf_hash() ?>'
                }
            },
            columns: [{
                    title: 'No',
                    data: 'no',
                },


                {
                    title: 'Tanggal',
                    data: 'tanggal',
                },
                {
                    title: 'Kode Transaksi',
                    data: 'id_keuangan',
                },
                {
                    title: 'Nama',
                    data: 'nasabah',
                },
                {
                    title: 'Jenis Transaksi',
                    data: 'jenis_jenis',
                },

                {
                    title: 'Nominal',
                    data: 'rp',
                },

                {
                    title: 'Rekening Pengirim',
                    data: 'rekening_pengirim',
                },



                {
                    title: 'Bukti',
                    data: 'bukti',
                },
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
                                <button class="btn btn-info w-50 btn-sm  btn-icon" title="Cetak Data" onclick="cetak_bukti_riwayat(\'` + r.id_keuangan + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/detail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                        <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                    </svg>
                                </button>
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


    

</script>