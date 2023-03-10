<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Pengaturan Sistem
                </h2>
            </div>

            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Identitas</h3>
                    </div>

                    <form action="<?= base_url() ?>pengaturan/update_pengaturan" method="POST" enctype="multipart/form-data">
                        <div class="m-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Sistem</label>
                                        <input type="text" name="nama_website" id="nama_website" class="form-control" placeholder="Nama Sistem" value="<?= $get[0]['nama_website'] ?>" required>
                                        <input type="hidden" name="csrf_baseben" value="<?= $this->security->get_csrf_hash() ?>">
                                        <input type="hidden" name="id_identitas" id="id_identitas" value="<?= $get[0]['id_identitas'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" id="email" placeholder="Email" value="<?= $get[0]['email'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">No Telepon</label>
                                        <input type="number" name="no_telp" id="no_telp" placeholder="No. Telepon" value="<?= $get[0]['no_telp'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">No Fax</label>
                                        <input type="number" name="no_fax" id="no_fax" placeholder="No Fax" value="<?= $get[0]['no_fax'] ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea type="text" name="alamat" id="alamat" placeholder="Alamat" class="form-control" required><?= $get[0]['alamat'] ?></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                        <p>Logo saat ini: <a href="<?= base_url() ?>public/logo/<?= $get[0]['logo'] ?>"><?= $get[0]['logo'] ?></a></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Favicon</label>
                                        <input type="file" name="favicon" id="favicon" class="form-control">
                                        <p>Favicon saat ini: <a href="<?= base_url() ?>public/favicon/<?= $get[0]['favicon'] ?>"><?= $get[0]['favicon'] ?></a></p>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button type="submit" class="btn btn-primary ms-auto mt-4 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="10" y1="14" x2="21" y2="3"></line>
                                        <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                    </svg>
                                    Simpan Data
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="general_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="<?= base_url() ?>users/crud_users" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title-modal">Tambah Data Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                <input type="hidden" name="csrf_baseben" value="<?= $this->security->get_csrf_hash() ?>">
                                <input type="hidden" name="users_id" id="users_id" value="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="no_telp" id="no_telp" placeholder="No. HP" class="form-control" required>
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