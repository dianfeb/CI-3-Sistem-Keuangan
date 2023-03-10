<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keuangan extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');

		if (empty($this->session->userdata('login'))) {
			redirect(base_url());
		}
	}

	public function index()
	{
		$data['title'] = 'Transaksi';
		$data['menu'] = 'keuangan';
		$data['content'] = 'keuangan';
		$data['js'] = 'js_keuangan';
		$data['css'] = 'css_keuangan';
		$this->load->view('template/main', $data);
	}

	function getKeuangan()
	{
		$data_post = $this->input->post();

		$con = array(
			'table_name' => 'tbl_keuangan',
			'order_by' => array('id_keuangan', 'DESC'),
			// 'where' => ''
			'group_by' => array('id_pelanggan')

		);

		$where = array();

		if (!empty($data_post['jenis'])) {

			$where['jenis'] =  $data_post['jenis'];
		} 

		if (!empty($data_post['id_keuangan'])) {
			$where['id_keuangan'] =  $data_post['id_keuangan'];
		}
		if (!empty($data_post['id_pelanggan'])) {
			$where['id_pelanggan'] =  $data_post['id_pelanggan'];
		}

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
			$get[$k]['tanggal'] = hari_tgl_indo($v['tgl']);
			$get[$k]['rp'] = rupiah($v['jumlah']);
			$get[$k]['jns'] = $v['jenis_transaksi'] . "(" . $v['jenis'] . ")";
			$get[$k]['jenis_keuangan'] = $v['jenis'] == 'Deposit' ? 'PeDepositan' : 'Pengeluaran';
			$get[$k]['nasabah'] = $nm_plg->nama_lengkap;
			// $get[$k]['alamat'] = $nm_plg->kota;
			$get[$k]['ktp'] = $nm_plg->no_ktp;
			$get[$k]['jenis'] = $v['jenis'];
			$get[$k]['kelurahan'] = $nm_plg->kelurahan;
			$get[$k]['dusun'] = $nm_plg->dusun;
			$get[$k]['kecamatan'] = $nm_plg->kecamatan;
			$get[$k]['jenis_transaksi'] = $v['jenis_transaksi'];
			// $get[$k]['nominal_transfer'] = "Rp " . number_format($v['nominal_transfer'], 2, ',', '.');




			$depo = $this->db->where('jenis', 'Deposit')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			$tarik = $this->db->where('jenis', 'Penarikan')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();

$jmldepo = 0;
			$totaldepo = 0;
			foreach ($depo as $depo) {
				$totaldepo = $totaldepo + $depo->jumlah;
				// $totaldepo++;
				$jmldepo++;
			}

			$totaltarik = 0;
			foreach ($tarik as $tarik) {
				$totaltarik = $totaltarik + $tarik->jumlah;
				// $totaltarik++;
			}

			$totalsaldo = $totaldepo - $totaltarik;
			$saldorupiah = "Rp " . number_format($totalsaldo, 0, '', '.');
			$get[$k]['sisa_saldo'] = $saldorupiah;
			$get[$k]['total_depo'] ="Rp " . number_format($totaldepo, 0, '', '.');
			$get[$k]['totalpenarikan'] = "Rp " . number_format($totaltarik, 0, '', '.');
		}

		echo json_encode(array('data' => $get));
	}

	function crud_keuangan()
	{

		date_default_timezone_set('Asia/Jakarta');
		$data_post = $this->input->post();

		// var_dump($data_post);die;
		if (!isset($data_post['tujuan'])) {
			$tujuan = '-';
		}

		if (!empty($_FILES['bukti']['tmp_name'])) {
			$config['upload_path'] = './assets/img/bukti/'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_keuangan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// var_dump($filename);
			// var_dump($this->upload->display_errors());
			// die;
			if ($this->upload->do_upload('bukti')) {
				$gbr = $this->upload->data();
				$bukti = $gbr['file_name'];
			}
			// return true;
		}

		if ($data_post['jenis_transaksi'] == 'tunai' && $data_post['jenis'] == 'Deposit') {

			$data = array(
				'table_name' => 'tbl_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => '-',
				'rekening_pengirim' => '-',
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => '-',
				'nominal_transfer' => '-',
				'jumlah' => $data_post['jumlah'],
				'bukti' => '-',
				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')

			);
		} else if (($data_post['jenis_transaksi'] == 'transfer' && $data_post['jenis'] == 'Deposit')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => $data_post['nama_pengirim'],
				'rekening_pengirim' => $data_post['rekening_pengirim'],
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => $data_post['tgl_transfer'],
				'nominal_transfer' => $data_post['nominal_transfer'],
				'jumlah' => $data_post['nominal_transfer'],
				'bukti' => $bukti,

				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		} else if (($data_post['jenis_transaksi'] == 'tunai' && $data_post['jenis'] == 'Penarikan')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => '-',
				'rekening_pengirim' => '-',
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => '-',
				'nominal_transfer' => '-',
				'jumlah' => $data_post['jumlah'],
				'bukti' => '-',
				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		} else if (($data_post['jenis_transaksi'] == 'transfer' && $data_post['jenis'] == 'Penarikan')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => $data_post['nama_pengirim'],
				'rekening_pengirim' => $data_post['rekening_pengirim'],
				'nama_penerima' => $data_post['nama_penerima'],
				'rekening_penerima' => $data_post['rekening_penerima'],
				'tgl_transfer' => $data_post['tgl_transfer'],
				'nominal_transfer' => $data_post['nominal_transfer'],
				'jumlah' => $data_post['nominal_transfer'],
				'bukti' => $bukti,

				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		}


		// var_dump($data);die;
		$query = $this->baseben->insert($data);

		if (!empty($data_post['id_keuangan'])) {
			$data['key_name'] = 'id_keuangan';
			$data['key'] = $data_post['id_keuangan'];
			$data['updatedon'] = date('Y-m-d H:i:s');
			$data['updatedby'] = $this->session->userdata('username');
			$query = $this->baseben->update($data);
		}

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}

		redirect(base_url() . 'keuangan');
	}
	function edit_keuangan()
	{

		date_default_timezone_set('Asia/Jakarta');
		$data_post = $this->input->post();

		// var_dump($data_post);die;
		if (!isset($data_post['tujuan'])) {
			$tujuan = '-';
		}

		if (!empty($_FILES['bukti']['tmp_name'])) {
			$config['upload_path'] = './assets/img/bukti/'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_keuangan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// var_dump($filename);
			// var_dump($this->upload->display_errors());
			// die;
			if ($this->upload->do_upload('bukti')) {
				$gbr = $this->upload->data();
				$bukti = $gbr['file_name'];
			}
			// return true;
		}else{
			$buktilama = $this->db->where('id_keuangan',$data_post['id_keuangan'])->get('tbl_keuangan')->row()->bukti;

			$bukti = $buktilama;
		}

		if ($data_post['jenis_transaksi'] == 'tunai' && $data_post['jenis'] == 'Deposit') {

			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => '-',
				'rekening_pengirim' => '-',
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => '-',
				'nominal_transfer' => '-',
				'jumlah' => $data_post['jumlah'],
				'bukti' => '-',
				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')

			);
		} else if (($data_post['jenis_transaksi'] == 'transfer' && $data_post['jenis'] == 'Deposit')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => $data_post['nama_pengirim'],
				'rekening_pengirim' => $data_post['rekening_pengirim'],
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => $data_post['tgl_transfer'],
				'nominal_transfer' => $data_post['nominal_transfer'],
				'jumlah' => $data_post['nominal_transfer'],
				'bukti' => $bukti,

				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		} else if (($data_post['jenis_transaksi'] == 'tunai' && $data_post['jenis'] == 'Penarikan')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => '-',
				'rekening_pengirim' => '-',
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => '-',
				'nominal_transfer' => '-',
				'jumlah' => $data_post['jumlah'],
				'bukti' => '-',
				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		} else if (($data_post['jenis_transaksi'] == 'transfer' && $data_post['jenis'] == 'Penarikan')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => $data_post['nama_pengirim'],
				'rekening_pengirim' => $data_post['rekening_pengirim'],
				'nama_penerima' => $data_post['nama_penerima'],
				'rekening_penerima' => $data_post['rekening_penerima'],
				'tgl_transfer' => $data_post['tgl_transfer'],
				'nominal_transfer' => $data_post['nominal_transfer'],
				'jumlah' => $data_post['nominal_transfer'],
				'bukti' => $bukti,

				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		}


		// var_dump($this->db->set($data)->where('id_keuangan',$data_post['id_keuangan'])->get_compiled_update('tbl_keuangan'));die;
		// var_dump($data_post['jenis'],$data_post['jenis_transaksi']);die;
		$query = $this->baseben->update($data);

		// if (!empty($data_post['id_keuangan'])) {
		// 	$data['key_name'] = 'id_keuangan';
		// 	$data['key'] = $data_post['id_keuangan'];
		// 	$data['updatedon'] = date('Y-m-d H:i:s');
		// 	$data['updatedby'] = $this->session->userdata('username');
		// 	$query = $this->baseben->update($data);
		// }

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}

		redirect(base_url() . 'Transaksi/Depo?id='.$data_post['id_pelanggan']."&jns=".$data_post['jenis']);
	}
	function edittarik_keuangan()
	{

		date_default_timezone_set('Asia/Jakarta');
		$data_post = $this->input->post();

		// var_dump($data_post);die;
		if (!isset($data_post['tujuan'])) {
			$tujuan = '-';
		}

		if (!empty($_FILES['bukti']['tmp_name'])) {
			$config['upload_path'] = './assets/img/bukti/'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_keuangan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			// var_dump($filename);
			// var_dump($this->upload->display_errors());
			// die;
			if ($this->upload->do_upload('bukti')) {
				$gbr = $this->upload->data();
				$bukti = $gbr['file_name'];
			}
			// return true;
		}else{
			$buktilama = $this->db->where('id_keuangan',$data_post['id_keuangan'])->get('tbl_keuangan')->row()->bukti;

			$bukti = $buktilama;
		}

		if ($data_post['jenis_transaksi'] == 'tunai' && $data_post['jenis'] == 'Deposit') {

			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => '-',
				'rekening_pengirim' => '-',
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => '-',
				'nominal_transfer' => '-',
				'jumlah' => $data_post['jumlah'],
				'bukti' => '-',
				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')

			);
		} else if (($data_post['jenis_transaksi'] == 'transfer' && $data_post['jenis'] == 'Deposit')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => $data_post['nama_pengirim'],
				'rekening_pengirim' => $data_post['rekening_pengirim'],
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => $data_post['tgl_transfer'],
				'nominal_transfer' => $data_post['nominal_transfer'],
				'jumlah' => $data_post['nominal_transfer'],
				'bukti' => $bukti,

				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		} else if (($data_post['jenis_transaksi'] == 'tunai' && $data_post['jenis'] == 'Penarikan')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => '-',
				'rekening_pengirim' => '-',
				'nama_penerima' => '-',
				'rekening_penerima' => '-',
				'tgl_transfer' => '-',
				'nominal_transfer' => '-',
				'jumlah' => $data_post['jumlah'],
				'bukti' => '-',
				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		} else if (($data_post['jenis_transaksi'] == 'transfer' && $data_post['jenis'] == 'Penarikan')) {
			$data = array(
				'table_name' => 'tbl_keuangan',
				'key'=>$data_post['id_keuangan'],
				'key_name' => 'id_keuangan',
				'id_keuangan' => $data_post['id_keuangan'],
				'id_pelanggan' => $data_post['nasabah'],
				'jenis' => $data_post['jenis'],
				'jenis_transaksi' => $data_post['jenis_transaksi'],
				'tgl' => date('Y-m-d'),
				'tujuan' => $tujuan,
				'nama_pengirim' => $data_post['nama_pengirim'],
				'rekening_pengirim' => $data_post['rekening_pengirim'],
				'nama_penerima' => $data_post['nama_penerima'],
				'rekening_penerima' => $data_post['rekening_penerima'],
				'tgl_transfer' => $data_post['tgl_transfer'],
				'nominal_transfer' => $data_post['nominal_transfer'],
				'jumlah' => $data_post['nominal_transfer'],
				'bukti' => $bukti,

				'status' => 'Aktif',
				'createdon' => date('Y-m-d H:i:s'),
				'createdby' => $this->session->userdata('email')


			);
		}


		// var_dump($this->db->set($data)->where('id_keuangan',$data_post['id_keuangan'])->get_compiled_update('tbl_keuangan'));die;
		// var_dump($data_post['jenis'],$data_post['jenis_transaksi']);die;
		$query = $this->baseben->update($data);

		// if (!empty($data_post['id_keuangan'])) {
		// 	$data['key_name'] = 'id_keuangan';
		// 	$data['key'] = $data_post['id_keuangan'];
		// 	$data['updatedon'] = date('Y-m-d H:i:s');
		// 	$data['updatedby'] = $this->session->userdata('username');
		// 	$query = $this->baseben->update($data);
		// }

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}

		redirect(base_url() . 'Transaksi/Tarik?id='.$data_post['id_pelanggan']."&jns=".$data_post['jenis']);
	}

	function rekap()
	{
		$data['title'] = 'Riwayat Transaksi';
		$data['menu'] = 'rekap';
		$data['content'] = 'rekap';
		$data['js'] = 'js_rekap';
		$data['css'] = 'css_rekap';
		$this->load->view('template/main', $data);
	}

	function update_status()
	{

		$data_post = $this->input->post();

		$data = array(
			'table_name' => 'tbl_keuangan',
			'status' => $data_post['status'],
			'key' => $data_post['id_keuangan'],
			'key_name' => 'id_keuangan',
			'updatedon' => date('Y-m-d H:i:s'),
			'updatedby' => $this->session->userdata('username'),
		);

		$query = $this->db->where('id_keuangan',$data_post['id_keuangan'])->delete('tbl_keuangan');


		if ($query) {
			echo json_encode(array('kode' => 200, 'keterangan' => 'Status berhasil di update'));
		} else {
			echo json_encode(array('kode' => 500, 'keterangan' => 'Status gagal di update'));
		}
	}

	public function search_nasabah_byid()
	{
		$id = $this->input->post('id');

		$data = $this->db->where('tbl_pelanggan.id_pelanggan', $id)->get('tbl_pelanggan')->row();

		echo json_encode($data);
	}

	public function sisa_saldo()
	{

		$id = $this->input->post('id');

		$depo = $this->db->where('jenis', 'Deposit')->where('id_pelanggan', $id)->get('tbl_keuangan')->result();
		$tarik = $this->db->where('jenis', 'Penarikan')->where('id_pelanggan', $id)->get('tbl_keuangan')->result();


		$totaldepo = 0;
		foreach ($depo as $depo) {
			$totaldepo = $totaldepo + $depo->jumlah;
			// $totaldepo++;
		}

		$totaltarik = 0;
		foreach ($tarik as $tarik) {
			$totaltarik = $totaltarik + $tarik->jumlah;
			// $totaltarik++;
		}

		$totalsaldo = $totaldepo - $totaltarik;
		$saldorupiah = "Rp " . number_format($totalsaldo, 0, '', '.');
		$data = array(
			'depo' => $totaldepo,
			'tarik' => $totaltarik,
			'saldo' => $saldorupiah
		);
		echo json_encode($data);
	}
}
