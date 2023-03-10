<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cashflow extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');
		$this->load->model('M_Kode');

		if (empty($this->session->userdata('login'))) {
			redirect(base_url());
		}
	}



	function index()
	{
		$data['title'] = 'Informasi';
		$data['menu'] = 'Informasi';
		$data['content'] = 'cashflow';
		$data['js'] = 'js_cashflow';
		$data['css'] = 'css_cashflow';
		$this->load->view('template/main', $data);
	}



	function rekap()
	{
		$data['title'] = 'Cashflow';
		$data['menu'] = 'rekap';
		$data['content'] = 'rekap';
		$data['js'] = 'js_rekap';
		$data['css'] = 'css_rekap';
		$this->load->view('template/main', $data);
	}


	function getKeuangan()
	{
		$data_post = $this->input->post();
		date_default_timezone_set('Asia/Jakarta');
		$con = array(
			'table_name' => 'tbl_keuangan',
			'order_by' => array('id_keuangan', 'DESC')
		);

		$where = array();




		if (!empty($data_post['tahun'])) {
			$where['tgl >='] = $data_post['tahun'] . "-01-01";
			$where['tgl <='] =  $data_post['tahun'] . "-12-31";
		} else {
			$where['tgl >='] =  date('Y') . "-01-01";
			$where['tgl <='] = date('Y') . "-12-31";
		}

		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {



			$depo = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$tarik = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$depotf = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();
			$tariktf = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();

			$totaldepo = 0;
			$totaltarik = 0;
			$totaldepotf = 0;
			$totaltariktf = 0;

			$jmldepo = 0;
			$jmltf = 0;
			$jmltarik = 0;
			$jmlpembayaran = 0;
			foreach ($depo as $depo) {
				$totaldepo = $totaldepo + $depo->jumlah;
				// $totaldepo++;
				$jmldepo++;
			}
			foreach ($depotf as $depotf) {
				$totaldepotf = $totaldepotf + $depotf->jumlah;
				// $totaldepo++;
				$jmltf++;
			}
			foreach ($tarik as $tarik) {
				$totaltarik = $totaltarik + $tarik->jumlah;
				// $totaltarik++;
				$jmltarik++;
			}
			foreach ($tariktf as $tariktf) {
				$totaltariktf = $totaltariktf + $tariktf->jumlah;
				// $totaldepo++;
				$jmlpembayaran++;
			}

			$totalsaldo = ($totaldepo + $totaldepotf) - ($totaltarik + $totaltariktf);

			$nilai_transaksi = ($totaldepo + $totaldepotf) + ($totaltarik + $totaltariktf);
		}
		if (isset($nilai_transaksi) && isset($totalsaldo)) {

			$get = array(
				'nilai_transaksi' => "Rp " . number_format(($nilai_transaksi), 0, ',', '.'),
				'total_saldo' => "Rp " . number_format(($totalsaldo), 0, ',', '.'),
				'jmldepo' => $jmldepo,
				'totaldepo' => "Rp " . number_format(($totaldepo), 0, ',', '.'),
				'totaldepotf' => "Rp " . number_format(($totaldepotf), 0, ',', '.'),
				'totaltarik' => "Rp " . number_format(($totaltarik), 0, ',', '.'),
				'totaltariktf' => "Rp " . number_format(($totaltariktf), 0, ',', '.'),
				'jmltf' => $jmltf,
				'jmltarik' => $jmltarik,
				'jmlpembayaran' => $jmlpembayaran,
			);
		} else {
			$get = array(
				'nilai_transaksi' => "Rp " . number_format((0), 0, ',', '.'),
				'total_saldo' => "Rp " .  number_format((0), 0, ',', '.'),
				'jmldepo' => 0,
				'totaldepo' => "Rp " . number_format((0), 0, ',', '.'),
				'totaldepotf' => "Rp " . number_format((0), 0, ',', '.'),
				'totaltarik' => "Rp " . number_format((0), 0, ',', '.'),
				'totaltariktf' => "Rp " . number_format((0), 0, ',', '.'),
				'jmltf' => 0,
				'jmltarik' => 0,
				'jmlpembayaran' => 0,
			);
		}

		echo json_encode($get);
	}
	function getKeuanganNasabah()
	{
		$data_post = $this->input->post();
		date_default_timezone_set('Asia/Jakarta');
		$con = array(
			'table_name' => 'tbl_pelanggan',
		);

		$where = array();




		if ($data_post['dusun'] != "-") {
			$where['dusun'] = $data_post['dusun'];
			$where['dusun'] =  $data_post['dusun'];
		}
		if ($data_post['kelurahan'] != "-") {
			$where['kelurahan'] = $data_post['kelurahan'];
			$where['kelurahan'] =  $data_post['kelurahan'];
		}
		if ($data_post['kecamatan'] != "-") {
			$where['kecamatan'] = $data_post['kecamatan'];
			$where['kecamatan'] =  $data_post['kecamatan'];
		}

		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {



			$depo = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'tunai')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			$tarik = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'tunai')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			$depotf = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'transfer')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			$tariktf = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'transfer')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();

			$totaldepo = 0;
			$totaltarik = 0;
			$totaldepotf = 0;
			$totaltariktf = 0;

			$jmldepo = 0;
			$jmltf = 0;
			$jmltarik = 0;
			$jmlpembayaran = 0;
			foreach ($depo as $depo) {
				$totaldepo = $totaldepo + $depo->jumlah;
				// $totaldepo++;
				$jmldepo++;
			}
			foreach ($depotf as $depotf) {
				$totaldepotf = $totaldepotf + $depotf->jumlah;
				// $totaldepo++;
				$jmltf++;
			}
			foreach ($tarik as $tarik) {
				$totaltarik = $totaltarik + $tarik->jumlah;
				// $totaltarik++;
				$jmltarik++;
			}
			foreach ($tariktf as $tariktf) {
				$totaltariktf = $totaltariktf + $tariktf->jumlah;
				// $totaldepo++;
				$jmlpembayaran++;
			}

			// $totalsaldo = ($totaldepo + $totaldepotf) - ($totaltarik + $totaltariktf);

			$total_nasabah =  $jmldepo + $jmltf + $jmltarik + $jmlpembayaran;
			$nilai_transaksi = ($totaldepo + $totaldepotf) + ($totaltarik + $totaltariktf);
		}
		if (isset($nilai_transaksi) && isset($total_nasabah)) {

			$get = array(
				'nilai_transaksi' => "Rp " . number_format(($nilai_transaksi), 0, ',', '.'),
				'total_nasabah' => $total_nasabah,

			);
		} else {
			$get = array(
				'nilai_transaksi' => "Rp " . number_format((0), 0, ',', '.'),
				'total_nasabah' => 0,

			);
		}

		echo json_encode($get);
	}
	function getKeuanganChart()
	{
		$data_post = $this->input->post();
		date_default_timezone_set('Asia/Jakarta');
		$con = array(
			'table_name' => 'tbl_keuangan',
		);

		$where = array();

		if (!empty($data_post['bulannasabah'])) {
			$where['tgl >='] = date('Y') . "-" . $data_post['bulannasabah'] . "-01";
			$where['tgl <='] =   date('Y') . "-" . $data_post['bulannasabah'] . "-31";
		} else {
			$where['tgl >='] =  date('Y') . "-" . date('m') . "-01";
			$where['tgl <='] = date('Y') . "-" . date('m') . "-31";
		}
		

		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {



			$depo = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$tarik = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$depotf = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();
			$tariktf = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();


			$data = array(
				'depo' => $depo,
				'tarik' => $tarik,
				'depotf' => $depotf,
				'tariktf' => $tariktf,
			);
		
		}


		echo json_encode($data);
	}
	function getKeuanganChart2()
	{
		$data_post = $this->input->post();
		date_default_timezone_set('Asia/Jakarta');
		$con = array(
			'table_name' => 'tbl_keuangan',
		);

		$where = array();

		if (!empty($data_post['bulannasabah'])) {
			$where['tgl >='] = date('Y') . "-" . $data_post['bulannasabah'] . "-01";
			$where['tgl <='] =   date('Y') . "-" . $data_post['bulannasabah'] . "-31";
		} else {
			$where['tgl >='] =  date('Y') . "-" . date('m') . "-01";
			$where['tgl <='] = date('Y') . "-" . date('m') . "-31";
		}


		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {



			$depo = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$tarik = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$depotf = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();
			$tariktf = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();

			$totaldepo = 0;
			$totaltarik = 0;
			$totaldepotf = 0;
			$totaltariktf = 0;

			$jmldepo = 0;
			$jmltf = 0;
			$jmltarik = 0;
			$jmlpembayaran = 0;
			foreach ($depo as $depo) {
				$totaldepo = $totaldepo + $depo->jumlah;
				// $totaldepo++;
				$jmldepo++;
			}
			foreach ($depotf as $depotf) {
				$totaldepotf = $totaldepotf + $depotf->jumlah;
				// $totaldepo++;
				$jmltf++;
			}
			foreach ($tarik as $tarik) {
				$totaltarik = $totaltarik + $tarik->jumlah;
				// $totaltarik++;
				$jmltarik++;
			}
			foreach ($tariktf as $tariktf) {
				$totaltariktf = $totaltariktf + $tariktf->jumlah;
				// $totaldepo++;
				$jmlpembayaran++;
			}

			// $totalsaldo = ($totaldepo + $totaldepotf) - ($totaltarik + $totaltariktf);

			$total_nasabah =  $jmldepo + $jmltf;
			$nilai_transaksi = ($totaldepo + $totaldepotf) + ($totaltarik + $totaltariktf);
			if (isset($nilai_transaksi)) {

				$get = array(
					'nilai_transaksi' => $nilai_transaksi,
					'total_nasabah' => $total_nasabah,
					'bln' => $v['tgl'],

				);
			} else {
				$get = array(
					'nilai_transaksi' => 0,
					'total_nasabah' => 0,
					'bln' => $v['tgl'],

				);
			}
		}


		echo json_encode($get);
	}
	function getKeuanganBulan()
	{
		$data_post = $this->input->post();
		date_default_timezone_set('Asia/Jakarta');
		$con = array(
			'table_name' => 'tbl_keuangan',
			'order_by' => array('id_keuangan', 'DESC')
		);

		$where = array();




		if (!empty($data_post['bulan'])) {
			$where['tgl >='] = date('Y') . "-" . $data_post['bulan'] . "-01";
			$where['tgl <='] = date('Y') . "-" . $data_post['bulan'] . "-31";
		} else {
			$where['tgl >='] =  date('Y') . "-01-01";
			$where['tgl <='] = date('Y') . "-12-31";
		}

		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {



			$depo = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$tarik = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'tunai')->get('tbl_keuangan')->result();
			$depotf = $this->db->where('jenis', 'Deposit')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();
			$tariktf = $this->db->where('jenis', 'Penarikan')->where('jenis_transaksi', 'transfer')->get('tbl_keuangan')->result();

			$totaldepo = 0;
			$totaltarik = 0;
			$totaldepotf = 0;
			$totaltariktf = 0;

			$jmldepo = 0;
			$jmltf = 0;
			$jmltarik = 0;
			$jmlpembayaran = 0;
			foreach ($depo as $depo) {
				$totaldepo = $totaldepo + $depo->jumlah;
				// $totaldepo++;
				$jmldepo++;
			}
			foreach ($depotf as $depotf) {
				$totaldepotf = $totaldepotf + $depotf->jumlah;
				// $totaldepo++;
				$jmltf++;
			}
			foreach ($tarik as $tarik) {
				$totaltarik = $totaltarik + $tarik->jumlah;
				// $totaltarik++;
				$jmltarik++;
			}
			foreach ($tariktf as $tariktf) {
				$totaltariktf = $totaltariktf + $tariktf->jumlah;
				// $totaldepo++;
				$jmlpembayaran++;
			}

			$ttlbulan = ($totaldepo + $totaldepotf) + ($totaltarik + $totaltariktf);
		}
		if (isset($ttlbulan)) {

			$get = array(
				'ttlbulan' => "Rp " . number_format(($ttlbulan), 0, ',', '.'),

			);
		} else {
			$get = array(
				'ttlbulan' => "Rp " . number_format((0), 0, ',', '.'),
			);
		}

		echo json_encode($get);
	}

	function tampilGrafikNasabah(){
		$bulan =$this->request->getPost('bulan');

		$query = $db->query("SELECT tgl AS tgl,id_keuangan from tbl_keuangan  WHERE DATE_FORMAT(tgl,'%Y-%m) =
		'$bulan' ORDER BY tgl ASC")->get()->result();

		$data = [
			'grafik' => $query
		];

		$json = [
			'data' => view('cashflow', $data)
		];

		echo json_encode($json);
	}

	public function chartNasabah()
    {
        $data = $this->M_Kode->chart();
        echo json_encode($data);
    }

}
