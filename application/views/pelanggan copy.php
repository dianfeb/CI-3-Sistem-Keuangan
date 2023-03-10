<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Data Nasabah
                </h2>
            </div>

            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
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
                    <button class="btn btn-primary d-sm-none btn-icon" onclick="add()">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </button>
                </div>
            </div>


            <div class="col-12 mt-4">
                <div class="card">
                    <div class="mr-3">
                        <?php echo $this->session->flashdata('message'); ?>
                        <?= form_error('no_ktp', '<div class="alert alert-danger" role="alert">', '</div>'); ?>


                    </div>
                    <div class="row m-2 mr-auto">
                        <div class="col-7 mt-2 ">

                        </div>
                        <div class="col-5 mt-2 ">
                            <input type="text" class="form-control" id='input' onkeyup='searchTable()' placeholder="Search">

                        </div>


                        <div class="m-2">
                            <div class="table-responsive col-12 text-nowrap">
                                <table id="tbl_general" class="table-responsive table card-table table-striped  display-dataTables " data-page-length="25">
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
            <form action="<?= base_url() ?>Pelanggan/crud_pelanggan" method="POST" onSubmit="validasi()">
                <!-- <form action="<?= base_url() ?>Pelanggan/crud_pelanggan" method="POST" enctype="multipart/form-data"> -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title-modal">Tambah Data Nasabah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- <input type="hidden" id="id_pelanggan" name="id_pelanggan" class="form-control"> -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Kode Nasabah</label>
                                    <input type="text" id="kd_pelanggan" name="kd_pelanggan" class="form-control" value="<?= $kodePelanggan; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor Handphone</label>
                                    <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="Masukkan nomor handphone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nomor KTP</label>
                                    <input type="text" id="no_ktp" name="no_ktp" class="form-control" placeholder="Masukkan Nomor KTP">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="" style="color:red;">(jika ada)</span></label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan Email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" id="ibu" name="ibu" class="form-control" placeholder="Masukkan Nama Ibu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Negara</label>
                                    <input type="text" id="negara" name="negara" class="form-control" placeholder="Masukkan Negara">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kabupaten</label>
                                    <select class="form-control" name="kabupaten" id="kabupaten">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kecamatan</label>
                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Desa</label>
                                    <select class="form-control" name="kelurahan" id="kelurahan">
                                        <option value="">-- Pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Pekerjaan</label>
                                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Masukkan Nama Pekerjaan">
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Upload KTP</label>
                                    <input type="file" class="form-control" name="ktp" id="ktp">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">No. izin Usaha <span class="" style="color:red;">(jika ada)</span></label>
                                    <input type="text" id="no_usaha" name="no_usaha" class="form-control" placeholder="Masukkan Nomor Usaha">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Upload NPWP <span class="" style="color:red;">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="npwp" id="npwp">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Upload Izin Usaha<span class="" style="color:red;">(jika ada)</span></label>
                                    <input type="file" class="form-control" name="izin_usaha" id="izin_usaha">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">No. Rekening <span class="" style="color:red;">(jika ada)</span></label>
                                    <input type="text" id="norek" name="norek" class="form-control" placeholder="Masukkan Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama Pemilik Rekening <span class="" style="color:red;">(jika ada)</span></label>
                                    <input type="text" id="pemilik" name="pemilik" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Kontak Darurat</label>
                                    <input type="text" id="no_darurat" name="no_darurat" class="form-control" placeholder="Masukkan Kontak Darurat">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Status Keluarga</label>
                                    <select class="form-control" name="status_klg" id="status_klg">
                                        <option value="">-- Pilih --</option>
                                        <option value="ayah">Ayah</option>
                                        <option value="ibu">Ibu</option>
                                        <option value="kakak">Kakak</option>
                                        <option value="adik">Adik</option>
                                        <option value="saudara">Saudara</option>
                                        <option value="teman">Teman</option>
                                    </select>
                                </div>

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


    <div class="modal modal-blur fade" id="nasabah_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="title-nasabah-modal">
                        <h5>Detail Nasabah</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- <?php $plg = $this->db->where('status', 'Aktif')->get('tbl_pelanggan')->result(); ?> -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Nasabah</label>
                                <input type="text" class="form-control" id="kd_pelanggan-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <select name="nasabah" class="form-control" id="nama-nasabah-detail" readonly></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" id="no_hp-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor KTP</label>
                                <input type="text" class="form-control" id="no_ktp-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" id="tgl_lahir-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="email-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu Kandung</label>
                                <input type="text" class="form-control" id="ibu-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Negara</label>
                                <input type="text" class="form-control" id="negara-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kabupaten</label>
                                <input type="text" class="form-control" id="kabupaten-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Desa</label>
                                <input type="text" class="form-control" id="kelurahan-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No Izin Usaha</label>
                                <input type="text" class="form-control" id="no_usaha-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload KTP <span class="" style="color:red;">(jika ada)</span></label>
                                <img style="width:100px;height:auto;" src="" id="ktp-detail" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Pokok Wajib Pajak <span class="" style="color:red;">(jika ada)</span></label>
                                <img style="width:100px;height:auto;" src="" id="npwp-detail" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload Izin Usaha <span class="" style="color:red;">(jika ada)</span></label>
                                <img style="width:100px;height:auto;" src="" id="izin_usaha-detail" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Rekening <span class="" style="color:red;">(jika ada)</span></label>
                                <input type="text" class="form-control" id="norek-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" id="pemilik-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kontak Darurat</label>
                                <input type="text" class="form-control" id="no_darurat-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hubungan Keluraga</label>
                                <input type="text" class="form-control" id="status_klg-detail" readonly></input>
                            </div>
                        </div>


                    </div>




                </div>
                <div class="modal-footer modal-body">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <!-- <a target="_blank" id="cetak_nasabah" class="btn btn-success ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Cetak Bukti
                </a> -->
                </div>
            </div>


        </div>
    </div>
    <div class="modal modal-blur fade" id="edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="title-edit-modal-edit">
                        <h5>Edit Nasabah</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- <?php $plg = $this->db->where('status', 'Aktif')->get('tbl_pelanggan')->result(); ?> -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kode Nasabah</label>
                                <input type="text" class="form-control" id="kd_pelanggan-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <select name="nasabah" class="form-control" id="nama-nasabah-detail" readonly></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="text" class="form-control" id="no_hp-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor KTP</label>
                                <input type="text" class="form-control" id="no_ktp-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="text" class="form-control" id="tgl_lahir-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="email-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Ibu Kandung</label>
                                <input type="text" class="form-control" id="ibu-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Negara</label>
                                <input type="text" class="form-control" id="negara-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="provinsi-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kabupaten</label>
                                <input type="text" class="form-control" id="kabupaten-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="kecamatan-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Desa</label>
                                <input type="text" class="form-control" id="kelurahan-detail" readonly></input>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dusun</label>
                                <input type="text" class="form-control" id="dusun-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No Izin Usaha</label>
                                <input type="text" class="form-control" id="no_usaha-detail" readonly></input>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload KTP <span class="" style="color:red;">(jika ada)</span></label>
                                <img style="width:100px;height:auto;" src="" id="ktp-detail" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Pokok Wajib Pajak <span class="" style="color:red;">(jika ada)</span></label>
                                <img style="width:100px;height:auto;" src="" id="npwp-detail" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload Izin Usaha <span class="" style="color:red;">(jika ada)</span></label>
                                <img style="width:100px;height:auto;" src="" id="izin_usaha-detail" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Rekening <span class="" style="color:red;">(jika ada)</span></label>
                                <input type="text" class="form-control" id="norek-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" id="pemilik-detail" readonly></input>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kontak Darurat</label>
                                <input type="text" class="form-control" id="no_darurat-detail" readonly></input>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Hubungan Keluraga</label>
                                <input type="text" class="form-control" id="status_klg-detail" readonly></input>
                            </div>
                        </div>


                    </div>




                </div>
                <div class="modal-footer modal-body">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <!-- <a target="_blank" id="cetak_nasabah" class="btn btn-success ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Cetak Bukti
                </a> -->
                </div>
            </div>


        </div>
    </div>


    <script>
        fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json`)
            .then((response) => response.json())
            .then((provinces) => {
                var data = provinces;
                var pelanggan = `<option>Pilih</option>`;
                data.forEach((element) => {
                    pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById("provinsi").innerHTML = pelanggan;
            });
    </script>
    <script>
        const selectProvinsi = document.getElementById('provinsi');
        const selectKabupaten = document.getElementById('kabupaten');
        const selectKecamatan = document.getElementById('kecamatan');
        const selectKelurahan = document.getElementById('kelurahan');

        selectProvinsi.addEventListener('change', (e) => {
            var provinsi = e.target.options[e.target.selectedIndex].dataset.prov;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${provinsi}.json`)
                .then((response) => response.json())
                .then((regencies) => {
                    var data = regencies;
                    var pelanggan = `<option>Pilih</option>`;
                    document.getElementById('kabupaten').innerHTML = '<option>Pilih</option>';
                    document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                    document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                    data.forEach((element) => {
                        pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById("kabupaten").innerHTML = pelanggan;
                });
        });

        selectKabupaten.addEventListener('change', (e) => {
            var kabupaten = e.target.options[e.target.selectedIndex].dataset.prov;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${kabupaten}.json`)
                .then((response) => response.json())
                .then((districts) => {
                    var data = districts;
                    var pelanggan = `<option>Pilih</option>`;
                    document.getElementById('kecamatan').innerHTML = '<option>Pilih</option>';
                    document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                    data.forEach((element) => {
                        pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById("kecamatan").innerHTML = pelanggan;
                });
        });
        selectKecamatan.addEventListener('change', (e) => {
            var kecamatan = e.target.options[e.target.selectedIndex].dataset.prov;
            fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${kecamatan}.json`)
                .then((response) => response.json())
                .then((villages) => {
                    var data = villages;
                    var pelanggan = `<option>Pilih</option>`;
                    document.getElementById('kelurahan').innerHTML = '<option>Pilih</option>';
                    data.forEach((element) => {
                        pelanggan += `<option data-prov="${element.id}" value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById("kelurahan").innerHTML = pelanggan;
                });
        });
    </script>


    <script type="text/javascript">
        function validasi() {
            // var nama_lengkap = document.getElementById("nama_lengkap").value;
            // var no_hp = document.getElementById("no_hp").value;
            // var no_ktp = document.getElementById("no_ktp").value;
            // var tgl_lahir = document.getElementById("tgl_lahir").value;
            // var ibu = document.getElementById("ibu").value;
            // var kota = document.getElementById("kota").value;
            // var kecamatan = document.getElementById("kecamatan").value;
            // var kelurahan = document.getElementById("kelurahan").value;
            // var provinsi = document.getElementById("provinsi").value;
            // var negara = document.getElementById("negara").value;
            // var pekerjaan = document.getElementById("pekerjaan").value;
            // var no_darurat = document.getElementById("no_darurat").value;

            // if (nama_lengkap != "" && no_hp !="" && no_ktp !="" && tgl_lahir !="" && ibu !="" && kota !="" && kecamatan !=""
            // && kelurahan !="" && provinsi !="" && negara !="" && pekerjaan !="" && no_darurat !="")   {
            // 	return true;
            // }else{
            // 	alert('Anda harus mengisi data dengan lengkap !');
            // }
        }
    </script>

    <script>
        function searchTable() {
            var input;
            var saring;
            var status;
            var tbody;
            var tr;
            var td;
            var i;
            var j;
            input = document.getElementById("input");
            saring = input.value.toUpperCase();
            tbody = document.getElementsByTagName("tbody")[0];;
            tr = tbody.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                        status = true;
                    }
                }
                if (status) {
                    tr[i].style.display = "";
                    status = false;
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>