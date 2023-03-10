<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Riwayat extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');

		if (empty($this->session->userdata('login'))) {
			redirect(base_url());
		}
	}






	function index()
	{
		$data['title'] = 'riwayat';
		$data['menu'] = 'riwayat';
		$data['content'] = 'riwayat';
		$data['js'] = 'js_riwayat';
		$data['css'] = 'css_riwayat';
		$this->load->view('template/main', $data);
	}



	function getKeuangan()
	{
		$data_post = $this->input->post();

		$con = array(
			'table_name' => 'tbl_keuangan',
			'order_by' => array('id_keuangan', 'DESC')
		);

		$where = array();

		if ($data_post['jenis'] == 'Setor Tunai') {
			$jenis = 'Deposit';
			$jenis_transaksi = 'tunai';
			$where['jenis'] =$jenis;
			$where['jenis_transaksi'] =  $jenis_transaksi;

		} else if ($data_post['jenis'] == 'Transfer') {
			$jenis = 'Deposit';
			$jenis_transaksi = 'transfer';
			$where['jenis'] =$jenis;
			$where['jenis_transaksi'] =  $jenis_transaksi;

		} else if ($data_post['jenis'] == 'Penarikan Tunai') {
			$jenis = 'Penarikan';
			$jenis_transaksi = 'tunai';
			$where['jenis'] =$jenis;
			$where['jenis_transaksi'] =  $jenis_transaksi;

		} else if ($data_post['jenis'] == 'Penarikan ke Pembayaran') {
			$jenis = 'Penarikan';
			$jenis_transaksi = 'transfer';
			$where['jenis'] =$jenis;
			$where['jenis_transaksi'] =  $jenis_transaksi;

		}

	

		// if (!empty($data_post['jenis'])) {
		// 	$where['jenis'] =$jenis;
		// }
		// if (!empty($data_post['jenis_transaksi'])) {
		// 	$where['jenis'] =$jenis;
		// 	$where['jenis_transaksi'] =  $jenis_transaksi;
		// }

		// if (!empty($data_post['id_keuangan'])) {
		// 	$where['id_keuangan'] =  $data_post['id_keuangan'];
		// }

		if (!empty($data_post['status'])) {
			$where['status'] = $data_post['status'];
		} else {
			$where['status !='] =  'Deleted';
		}

		if (!empty($data_post['tgl_awal'])) {
			$where['tgl >='] = $data_post['tgl_awal'];
			$where['tgl <='] = $data_post['tgl_akhir'];
		}

		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {

			$nm_plg = $this->db->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_pelanggan')->row();
			$get[$k]['no'] = $k + 1;
			$get[$k]['tanggal'] = date('d-m-Y', strtotime($v['tgl']));
			$get[$k]['rp'] = "Rp " . number_format($v['jumlah'], 0, ',', '.');
			$get[$k]['bukti_src'] =  base_url() . "/assets/img/bukti/" . $v['bukti'];

			// $get[$k]['jenis_keuangan'] = $v['jenis'] == 'Deposit' ? 'Pemasukan' : 'Pengeluaran';
			$get[$k]['nasabah'] = $nm_plg->nama_lengkap;
			$get[$k]['jnsjns'] = $jenis . $jenis_transaksi;

			
			// $masuk = $this->db->where('jenis', 'masuk')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			// $keluar = $this->db->where('jenis', 'keluar')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			if ($v['jenis'] == "Deposit" && $v['jenis_transaksi'] == "tunai") {
				$get[$k]['jenis_jenis'] = "Setor Tunai";
			} else if ($v['jenis'] == "Deposit" && $v['jenis_transaksi'] == "transfer") {
				$get[$k]['jenis_jenis'] = "Transfer";
			}
			if ($v['jenis'] == "Penarikan" && $v['jenis_transaksi'] == "tunai") {
				$get[$k]['jenis_jenis'] = "Penarikan Tunai";
			} else if ($v['jenis'] == "Penarikan" && $v['jenis_transaksi'] == "transfer") {
				$get[$k]['jenis_jenis'] = "Penarikan ke Pembayaran";
			}

			// 


			if ($v['bukti'] == null || $v['bukti'] == '-') {

				$get[$k]['bukti'] =  "-";
			} else {
				$get[$k]['bukti'] =  "<button style=outline:none;border:none; onclick=detailGambar('" . $v['bukti'] . "')><img style='width:50px;height:auto;' src=" . base_url() . "/assets/img/bukti/" . $v['bukti'] . "></button>";
				// $get[$k]['bukti'] =  '<button onclick="detailGambar('.$v['id_keuangan'].')">'+"<img  style='width:200px;height:auto;' src=".base_url()."/assets/img/bukti/".$v['bukti'].">"+'</button>';
			}
			//

		
		}

		echo json_encode(array('data' => $get));
	}


}


