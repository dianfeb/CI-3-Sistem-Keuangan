<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - Sistem Keuangan</title>
    <link rel="icon" href="<?= base_url() ?>public/logo/<?= logo() ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?= base_url() ?>public/logo/<?= logo() ?>" type="image/x-icon" />
    <!-- CSS files -->
    <link href="<?= base_url() ?>assets/css/tabler.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/demo.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-10 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 bg-login-image d-flex justify-content-center" >
                                    <img class=""  style="height:200px; margin: 150px 0 0 80px;" src="<?= base_url() ?>public/logo/<?= logo() ?>">
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <form class="card card-md" id="form_login" method="post" autocomplete="off">
                                            <div class="card-body">
                                                <h2 class="card-title text-center mb-2">Sistem Keuangan</h2>
                                                <p class="text-center mb-4">Masukan Username dan Password Dengan Benar</p>

                                                <?php if ($this->session->flashdata('alert') != '') { ?>
                                                    <div class="row  mb-2">
                                                        <div class="col-lg-12">
                                                            <div class="alert alert-<?= $this->session->flashdata('alert') ?> solid fade show mb-2">
                                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                                                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                                </svg>
                                                                <?= $this->session->flashdata('message') ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php  } ?>
                                                <?= $this->security->get_csrf_hash() ?>
                                                <div class="mb-3">
                                                    <label class="form-label">Username atau Email</label>
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="Username atau Email">
                                                    <!-- <input type="hidden" name="csrf_baseben" value="<?= $this->security->get_csrf_hash() ?>"> -->
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">
                                                        Password
                                                    </label>
                                                    <div class="input-group input-group-flat">
                                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                                                        <span class="input-group-text">
                                                            <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                                                <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <circle cx="12" cy="12" r="2" />
                                                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                                                </svg>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-footer">
                                                    <button type="submit" class="btn btn-primary w-100">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- Modal -->

    <div id="modalPin" class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <form id="cekPin">
                    <div class="modal-body">
                        <div class="modal-title">Input Your Pin</div>
                        <div>
                            <input type="password" class="form-control" id="pin" name="pin">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabler Core -->
    <script src="<?= base_url() ?>assets/js/tabler.min.js"></script>
    <script src="<?= base_url() ?>assets/js/demo.min.js"></script>

    <script>
        // $('#modalPin').modal('hide');

        // $('#form_login').submit(function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: '<?= base_url(); ?>Auth/check_login',
        //         type: 'post',
        //         data: $(this).serialize(),
        //         success: function(data) {

        //             var user = JSON.parse(data);
        //             sessionStorage.setItem("username", user.username);
        //             sessionStorage.setItem("password", user.password);
        //             $('#modalPin').modal('show');

        //         }
        //     })
        // })
        $('#form_login').submit(function(e) {
            e.preventDefault();
            var username = $("#username").val();
            var password = $("#password").val();

            if (username == "admin" && password == "admin") {

                sessionStorage.setItem("username", username);
                sessionStorage.setItem("password", password);
                $('#modalPin').modal('show');
            } else {
                alert('Username / Password Salah');
                $("#username").val('');
                $("#password").val('');
            }
        })

        $('#cekPin').submit(function(e) {

            var username = sessionStorage.getItem("username");
            var password = sessionStorage.getItem("password");
            var pin = $('#pin').val();
            e.preventDefault();
            $.ajax({
                url: '<?= base_url(); ?>Auth/check_login',
                type: 'post',
                data: {
                    pin: pin,
                    username: username,
                    password: password
                },
                success: function(x) {
                    var user = JSON.parse(x);

                    if (user.status == true) {
                        window.location.href = '<?= base_url(); ?>Dashboard';
                    } else {
                        window.location.href = '<?= base_url(); ?>Auth';

                    }
                    // $('#modalPin').modal('show');

                }
            })
        })
    </script>
</body>

</html>