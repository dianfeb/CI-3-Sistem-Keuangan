<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title><?= $title ?> | <?= title() ?></title>
	<link rel="icon" href="<?= base_url() ?>public/logo/<?= logo() ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?= base_url() ?>public/logo/<?= logo() ?>" type="image/x-icon" />
	<!-- CSS files -->
	<link href="<?= base_url() ?>assets/css/tabler.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/tabler-flags.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/tabler-payments.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/tabler-vendors.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/css/demo.min.css" rel="stylesheet" />
	
	<link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
	
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->

	<script src="<?php echo base_url('/assets/canvasjs/js/Chart.js'); ?>"></script>

	<?php
	if (!empty($css)) {
		$this->load->view('css/' . $css);
	}
	?>

</head>

<body>
	<div class="wrapper">
		<?php $this->load->view('template/head') ?>
		<div class="page-wrapper">
			<?php $this->load->view($content) ?>
			<footer class="footer footer-transparent d-print-none">
				<?php $this->load->view('template/foot') ?>
			</footer>
		</div>
	</div>

	<!-- Tabler Core -->
	<script src="<?= base_url() ?>assets/js/tabler.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<!-- Datatable js -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-html5-2.1.1/r-2.2.9/rg-1.1.4/sc-2.0.5/datatables.min.js"></script> -->
	<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>


	<?php
	if (!empty($js)) {
		$this->load->view('js/' . $js);
	}
	?>
</body>

</html>