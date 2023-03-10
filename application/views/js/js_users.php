<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        showTable();

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

    function jenis(id){
        showTable(id);
    }

    function showTable() {

        if ($.fn.DataTable.isDataTable('#tbl_general')) {
            $("#tbl_general").dataTable().fnDestroy();
            $('#tbl_general').empty();
        }

        var table = $('#tbl_general').DataTable({
            dom: 'Brtip',
            "ajax": {
                "type": 'POST',
                "url": '<?= base_url() ?>users/getUsers',
                "data": {
                    // csrf_baseben: '<?= $this->security->get_csrf_hash() ?>'
                }
            },
            columns: [{
                    title: 'No',
                    data: 'no',
                },
                {
                    title: 'Username',
                    data: 'username',

                },
                {
                    title: 'Nama Lengkap',
                    data: 'nama_lengkap',
                },
                {
                    title: 'Email',
                    data: 'email',
                },
                {
                    title: 'Status',
                    data: 'status',
                    render: function(k, v, r) {
                        if (r.status == 'Aktif') {
                            return '<span class="badge badge-success"> ' + r.status + '</span>'
                        } else {
                            return '<span class="badge badge-danger"> ' + r.status + '</span>'
                        }
                    },
                    className: 'text-center'
                },
                {
                    title: 'Aksi',
                    data: 'users_id',
                    render: function(k, v, r) {
                        var button_color = 'danger'
                        var status = 'Tidak Aktif'
                        if (r.status == 'Tidak Aktif') {
                            button_color = 'success'
                            status = 'Aktif'
                        }


                        return `<div class="row g-2 align-items-center mb-n3">
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-primary w-100 btn-icon" title="Edit Data" onclick="edit(\'` + r.users_id + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                                </button>
                            </div>
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-`+button_color+` w-100 btn-icon"  onclick="update_status(\'` + r.users_id + `\',\'` + status + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/power -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 6a7.75 7.75 0 1 0 10 0" /><line x1="12" y1="4" x2="12" y2="12" /></svg>
                                </button>
                            </div>
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-danger w-100 btn-icon"  title="Hapus Data" onclick="hapus_data(\'` + r.users_id + `\',\'Deleted\')">
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

    function add(){
        $('#modal_title').text('Tambah Data Users')
        $('#general_modal').modal('show')
        $('#username').val('')
        $('#users_id').val('')
        $('#password').val('')
        $('#nama_lengkap').val('')
        $('#email').val('')
        $('#no_telp').val('')
    }

    function edit(id){
        $('#modal_title').text('Edit Data Users')
        $('#general_modal').modal('show')

        $.ajax({
            url: '<?= base_url() ?>users/getUsers',
            type: 'POST',
            data: {
                'users_id': id,
                'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response)
                $('#nama_lengkap').val(response.data[0].nama_lengkap)
                $('#users_id').val(response.data[0].users_id)
                $('#username').val(response.data[0].username)
                $('#email').val(response.data[0].email)
                $('#no_telp').val(response.data[0].no_telp)
            }
        })
    }

    function update_status(id, status) {
        $.ajax({
            url: '<?= base_url() ?>users/update_status',
            type: 'POST',
            data: {
                'users_id': id,
                'status': status,
                'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
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
                    showTable()
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

    function hapus_data(id, status) {
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
                    url: '<?= base_url() ?>users/update_status',
                    type: 'POST',
                    data: {
                        'users_id': id,
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
                            showTable()
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