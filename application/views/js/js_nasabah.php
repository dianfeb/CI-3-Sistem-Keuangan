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

    function jenis(id) {
        showTable(id);
    }

    function filter() {
        showTable();
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
                "url": '<?= base_url() ?>Nasabah/getNasabah',
                "data": {
                    
                    // csrf_baseben: '<?= $this->security->get_csrf_hash() ?>'
                }
            },
            columns: [{
                    title: 'No',
                    data: 'no',
                },
                {
                    title: 'Kode',
                    data: 'kd_pelanggan',

                },
                {
                    title: 'Nama Lengkap',
                    data: 'nama_lengkap',

                },
              
                {
                    title: 'Alamat',
                    data: 'alamat',


                },

                {
                    title: 'No KTP',
                    data: 'no_ktp',

                },
               
                {
                    title: 'No HP',
                    data: 'no_hp',
                },
            
                {
                    title: 'Aksi',
                    data: 'id_pelanggan',
                    render: function(k, v, r) {
                        var button_color = 'danger'
                        var status = 'Tidak Aktif'
                        if (r.status == 'Tidak Aktif') {
                            button_color = 'success'
                            status = 'Aktif'
                        }


                        return `
                        <div class="row g-2 align-items-center mb-n3">
                        <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                            <button class="btn btn-info w-50 btn-icon" title="Detail Data" onclick="detail(\'` + r.id_pelanggan + `\')">
                                <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                     <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                    <path d="M9 17h6"></path>
                                    <path d="M9 13h6"></path>
                                </button>
                            </div>
                      
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-primary w-10 btn-icon" title="Edit Data" onclick="edit(\'` + r.id_pelanggan + `\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/edit -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                    <line x1="16" y1="5" x2="19" y2="8" /></svg>
                                </button>
                            </div>
                         
                            <div class="col-6 col-sm-4 col-md-2 col-xl-auto mb-3">
                                <button class="btn btn-danger w-50 btn-icon"  title="Hapus Data" onclick="hapus_data(\'` + r.id_pelanggan + `\',\'Deleted\')">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <line x1="4" y1="7" x2="20" y2="7" />
                                    <line x1="10" y1="11" x2="10" y2="17" />
                                    <line x1="14" y1="11" x2="14" y2="17" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
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
            "displayLength": 10
        });

    }

    function add() {
        $('#modal_title').text('Tambah Data Nasabah')
        $('#general_modal').modal('show')

        // $('#id_pelanggan').val('')
        // $('#nama_lengkap').val('')
        // $('#no_hp').val('')
        // $('#no_ktp').val('')
        // $('#tgl_lahir').val('')
        // $('#email').val('')
        // $('#ibu').val('')
        // $('#provinsi').val('')
        // $('#kabupaten').val('')
        // $('#kecamatan').val('')
        // $('#desa').val('')
        // $('#negara').val('')
        // $('#pekerjaan').val('')
        // $('#no_usaha').val('')
        // $('#ktp').val('')
        // $('#npwp').val('')
        // $('#izin_usaha').val('')
        // $('#norek').val('')
        // $('#pemilik').val('')
        // $('#status_klg').val('')
    }

    function edit(id) {
       $('#edit_modal').modal('show');
        $('#title-edit-modal-edit').html(`Edit Nasabah - ` + id + ``)
        $.ajax({
            url: '<?= base_url() ?>nasabah/getNasabah',
            type: 'POST',
            data: {
                'id_pelanggan': id,
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response)
                $('#kd_pelanggan-edit').val(response.data[0].kd_pelanggan)
                $('#id_pelanggan-edit').val(response.data[0].id_pelanggan)
                $('#nama-nasabah-edit').append(`  <option selected value="` + response.data[0].nama_lengkap + `">` + response.data[0].nama_lengkap + `</option>`);
                $('#no_hp-edit').val(response.data[0].no_hp)
                $('#no_ktp-edit').val(response.data[0].no_ktp)
                $('#tgl_lahir-edit').val(response.data[0].tgl_lahir)
                $('#email-edit').val(response.data[0].email)
                $('#provinsi-edit').val(response.data[0].provinsi)
                $('#kecamatan-edit').val(response.data[0].kecamatan)
                $('#kabupaten-edit').val(response.data[0].kabupaten)
                $('#kelurahan-edit').val(response.data[0].kelurahan)
                $('#dusun-edit').val(response.data[0].dusun)
                $('#negara-edit').val(response.data[0].negara)
                $('#pekerjaan-edit').val(response.data[0].pekerjaan)
                $('#no_usaha-edit').val(response.data[0].no_usaha)
                $('#ktp-edit').attr('src',response.data[0].ktp_src);
                $('#npwp-edit').attr('src',response.data[0].npwp_src);
                $('#izin_usaha-edit').attr('src',response.data[0].izin_usaha_src);
                $('#norek-edit').val(response.data[0].norek) 
                $('#pemilik-edit').val(response.data[0].pemilik)
                $('#no_darurat-edit').val(response.data[0].no_darurat)
                $('#status_klg-edit').val(response.data[0].status_klg)


            }
        })
    }

    function detail(id) {
        $('#nasabah_modal').modal('show');
        $('#title-nasabah-detail').html(`Detail Nasabah - ` + id + ``)
        // alert('coba');
        $.ajax({
            url: '<?= base_url() ?>Nasabah/getNasabah',
            type: 'POST',
            data: {
                'id_pelanggan': id,
                // 'csrf_baseben': '<?= $this->security->get_csrf_hash() ?>'
            },
            success: function(response) {
                response = JSON.parse(response);
                console.log(response)
                $('#kd_pelanggan-detail').val(response.data[0].kd_pelanggan)
                // $('#id_pelanggan-detail').val(response.data[0].id_pelanggan)
                $('#nama-nasabah-detail').append(`  <option selected value="` + response.data[0].kd_pelanggan + `">` + response.data[0].nama_lengkap + `</option>`);
                $('#no_hp-detail').val(response.data[0].no_hp)
                $('#no_ktp-detail').val(response.data[0].no_ktp)
                $('#tgl_lahir-detail').val(response.data[0].tgl_lahir)
                $('#email-detail').val(response.data[0].email)
                $('#provinsi-detail').val(response.data[0].provinsi)
                $('#kecamatan-detail').val(response.data[0].kecamatan)
                $('#kabupaten-detail').val(response.data[0].kabupaten)
                $('#kelurahan-detail').val(response.data[0].kelurahan)
                $('#dusun-detail').val(response.data[0].dusun)
                $('#negara-detail').val(response.data[0].negara)
                $('#pekerjaan-detail').val(response.data[0].pekerjaan)
                $('#no_usaha-detail').val(response.data[0].no_usaha)
                $('#ktp-detail').attr('src',response.data[0].ktp_src);
                $('#npwp-detail').attr('src',response.data[0].npwp_src);
                $('#izin_usaha-detail').attr('src',response.data[0].izin_usaha_src);
                $('#norek-detail').val(response.data[0].norek) 
                $('#pemilik-detail').val(response.data[0].pemilik)
                $('#no_darurat-detail').val(response.data[0].no_darurat)
                $('#status_klg-detail').val(response.data[0].status_klg)


            }
        })
    }

    function update_status(id, status) {
        $.ajax({
            url: '<?= base_url() ?>nasabah/update_status',
            type: 'POST',
            data: {
                'id_pelanggan': id,
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
                    url: '<?= base_url() ?>nasabah/update_status',
                    type: 'POST',
                    data: {
                        'id_pelanggan': id,
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