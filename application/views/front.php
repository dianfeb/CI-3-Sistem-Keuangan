<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <!-- Bootstrap CSS -->

    <link href="<?= base_url() ?>/assets/css/bootstrap.min.css" rel='stylesheet'>
    <link href="<?= base_url() ?>assets/css/owl.carousel.min.css" rel='stylesheet' >
    <link href="<?= base_url() ?>assets/css/owl.theme.default.min.css" rel='stylesheet' >
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="<?= base_url() ?>assets/css/style.css" rel='stylesheet'>

    <title>Sistem Arus Keuangan</title>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70">


  
    <!-- BOTTOM NAV -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">SIARKU<span class="dot">.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    
                </ul>
                <a href="<?= base_url() ?>Auth" 
                    class="btn btn-brand ms-lg-3">Login</a>
            </div>
        </div>
    </nav>

    <!-- SLIDER -->
    <div class="owl-carousel owl-theme hero-slider">
        <div class="slide slide1">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center text-white">
                        <h6 class="text-white text-uppercase">Welcome</h6>
                        <h1 class="display-3 my-4">Sistem Informasi Arus Keuangan</h1>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="slide slide2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h1 class="display-3 my-4">Deposit</h1>
                        <h6 class="text-white text-uppercase">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias aliquid quam facilis itaque? Repellat quaerat, architecto reiciendis facere quasi delectus, soluta aperiam, laboriosam quod expedita porro temporibus odio. Est, alias.</h6>
                       
                    </div>
                </div>
            </div>
        </div>

        <div class="slide slide3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 text-white">
                        <h1 class="display-3 my-4">Penarikan</h1>
                        <h6 class="text-white text-uppercase">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias aliquid quam facilis itaque? Repellat quaerat, architecto reiciendis facere quasi delectus, soluta aperiam, laboriosam quod expedita porro temporibus odio. Est, alias.</h6>
                       
                    </div>
                </div>
            </div>
        </div>

    
        </div>
    </div>

  
  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="footer-top">
        <div class="container">
          <div class="row">
  
            <div class="col-lg-3 col-md-6 footer-contact">
              <h3>SIARKU</h3>
              <p>
                A108 Adam Street <br>
                New York, NY 535022<br>
                United States <br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
            </div>
  
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Tips Hemat</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Mencatat Pengeluaran</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Prioritas Kebutuhan</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Menabung</a></li>
             
              </ul>
            </div>
  
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Features</h4>
              <ul>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Deposit</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Penarikan</a></li>
                <li><i class="bx bx-chevron-right"></i> <a href="#">Riwayat Transfer</a></li>
              </ul>
            </div>
  
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>Our Social Networks</h4>
              <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
  
          </div>
        </div>
      </div>
  

  </footer><!-- End Footer -->






    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>assets/js/app.js"></script>
</body>

</html>