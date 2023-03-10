<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        showTable2();
    })

    function filter() {
        showTable3();

   
       

    }

    function cetak(id) {
        window.location.href = '<?= base_url(); ?>Cetak/cetak_transaksi?id=' + id;
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
                "url": '<?= base_url() ?>rekapitulasi/getKeuangan',
                "data": {
                    id_pelanggan: $('#nasabah').val(),
                    jenis: $('#jenis_transaksi').val(),
                    tgl_awal : $('#tgl_awal').val(),
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
            "displayLength": 5
        });

       

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
                "url": '<?= base_url() ?>rekapitulasi/getKeuangan',
                "data": {
                   jenis : $('#jenis_transaksi').val(),
                   tgl_awal : $('#tgl_awal').val(),
                   tgl_akhir : $('#tgl_akhir').val(),

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
                    title: 'Jenis Keuangan',
                    data: 'jenis_transaksi',
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
            "displayLength": 5
        });

    }
</script>