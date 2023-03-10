<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');

		if (empty($this->session->userdata('login'))) {
			redirect(base_url());
		}
		$this->load->model('M_Kode');
	}


	public function index()
	{
		$data['title'] = 'Nasabah';
		$data['menu'] = 'nasabah';
		$data['content'] = 'nasabah';
		$data['js'] = 'js_nasabah';
		$data['css'] = 'css_nasabah';
		$data['kodePelanggan'] = $this->M_Kode->kodePelanggan();

		// $con = array(
		// 	'table_name' => 'tbl_pelanggan',
		// 	'where' => array('id_pelanggan' => 1) 
		// );

		// $data['get'] = $this->baseben->get($con);

		$this->load->view('template/main', $data);

		
	}

	function getNasabah()
	{
		$data_post = $this->input->post();


		$con = array(
			'table_name' => 'tbl_pelanggan',
			'order_by' => array('id_pelanggan', 'DESC')
		);

		$where = array();



		if (!empty($data_post['id_pelanggan'])) {
			$where['id_pelanggan'] =  $data_post['id_pelanggan'];
		}

		if (!empty($data_post['status'])) {
			$where['status'] = $data_post['status'];
		} else {
			$where['status !='] =  'Deleted';
		}


		if (count($where) > 0) {
			$con['where'] = $where;
		}

		$get = $this->baseben->get($con);

		foreach ($get as $k => $v) {
			$get[$k]['no'] = $k + 1;
			$get[$k]['tanggal'] =  date_default_timezone_set('Asia/Jakarta');
			$get[$k]['alamat'] = $v['dusun'] . ", " . $v['kelurahan'] . ", " . $v['kecamatan'];
			$get[$k]['ktp'] =  "<img style='width:200px;height:auto;' src=".base_url()."/assets/img/ktp/".$v['ktp'].">";
			$get[$k]['ktp_src'] =  base_url()."/assets/img/ktp/".$v['ktp'];
			$get[$k]['npwp_src'] =  base_url()."/assets/img/npwp/".$v['npwp'];
			$get[$k]['izin_usaha_src'] =  base_url()."/assets/img/izin_usaha/".$v['izin_usaha'];
			$get[$k]['izin_usaha'] =  $v['izin_usaha'];
			$get[$k]['npwp'] =  "<img style='width:200px;height:auto;' src=".base_url()."/assets/img/npwp/".$v['npwp'].">";
		}

		echo json_encode(array('data' => $get));
	}


	function edit_nasabah(){
		// date_default_timezone_set('Asia/Jakarta');

		$data_post = $this->input->post();
		// var_dump($_FILES['ktp']['tmp_name']);
		
		$datasebelumnya = $this->db->where('kd_pelanggan',$data_post['kd_pelanggan'])->get('tbl_pelanggan')->row();
		if (!empty($_FILES['ktp']['tmp_name'])) {
			$config['upload_path'] = './assets/img/ktp'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_pelanggan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
			if ($this->upload->do_upload('ktp')) {
				$gbr = $this->upload->data();
				$ktp = $gbr['file_name'];
			}else{
				$ktp = $datasebelumnya->ktp;
			}
			// return true;
		}
		if (!empty($_FILES['npwp']['tmp_name'])) {
			$config['upload_path'] = './assets/img/npwp'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_pelanggan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
			if ($this->upload->do_upload('npwp')) {
				$gbr = $this->upload->data();
				$npwp = $gbr['file_name'];
			}else{
				$npwp = $datasebelumnya->npwp;
			}
			// return true;
		}
		if (!empty($_FILES['izin_usaha']['tmp_name'])) {
			$config['upload_path'] = './assets/img/izin_usaha'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_pelanggan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
		// var_dump($_FILES['izin_usaha']['tmp_name']);
			if ($this->upload->do_upload('izin_usaha')) {
				$gbr = $this->upload->data();
				$foto_izin_usaha = $gbr['file_name'];
			}
			// return true;
		}else{
			$foto_izin_usaha = $datasebelumnya->izin_usaha;

		}
		// var_dump($ktp);
	// die;

		$data = array(
			'table_name' => 'tbl_pelanggan',
			'key'=>$data_post['id_pelanggan'],
			'key_name' => 'id_pelanggan',
			// 'kd_pelanggan' => $data_post['kd_pelanggan'],
			'nama_lengkap' => $data_post['nama-nasabah'],
			'no_hp' => $data_post['no_hp'],
			'no_ktp' => $data_post['no_ktp'],
			'tgl_lahir' => date('d-m-y'),
			'email' => $data_post['email'],
			'provinsi' => $data_post['provinsi'],
			'kabupaten' => $data_post['kabupaten'],
			'kecamatan' => $data_post['kecamatan'],
			'kelurahan' => $data_post['kelurahan'],
			'dusun' => $data_post['dusun'],
			'negara' => $data_post['negara'],
			'pekerjaan' => $data_post['pekerjaan'],
			'izin_usaha' => $foto_izin_usaha,
			
			'no_usaha' => $data_post['no_usaha'],
			'norek' => $data_post['norek'],
			'pemilik' => $data_post['pemilik'],
			'no_darurat' => $data_post['no_darurat'],
			'status_klg' => $data_post['status_klg'],
			'tanggal' => date('Y-m-d H:i:s'),
			'status' => 'Aktif'
		);
// var_dump($data_post);
// die;
		// var_dump($this->db->set($data)->where('id_pelanggan', $data_post['id_pelanggan'])->get_compiled_update('tbl_pelanggan'));die;
		
		$query = $this->baseben->update($data);

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}

		redirect(base_url() . 'nasabah');
	}

	
    public function print()
    {
          $data['rows'] = $this->db->get('tbl_pelanggan')->result();
        $this->load->view('cetak/cetak_rekapitulasi', $data);
    }


	function crud_nasabah()
	{
		// date_default_timezone_set('Asia/Jakarta');

		$data_post = $this->input->post();
		// var_dump($_FILES['ktp']['tmp_name']);
		
		if (!empty($_FILES['ktp']['tmp_name'])) {
			$config['upload_path'] = './assets/img/ktp'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_pelanggan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
			if ($this->upload->do_upload('ktp')) {
				$gbr = $this->upload->data();
				$ktp = $gbr['file_name'];
			}
			// return true;
		}
		if (!empty($_FILES['npwp']['tmp_name'])) {
			$config['upload_path'] = './assets/img/npwp'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_pelanggan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
			if ($this->upload->do_upload('npwp')) {
				$gbr = $this->upload->data();
				$npwp = $gbr['file_name'];
			}
			// return true;
		}
		if (!empty($_FILES['izin_usaha']['tmp_name'])) {
			$config['upload_path'] = './assets/img/izin_usaha'; //path folder
			$config['allowed_types'] = 'JPG|jpg|png|jpeg|pdf'; //type yang dapat diakses bisa anda sesuaikan
			$config['encrypt_name'] = false; //Enkripsi nama yang terupload
			// $config['max_size'] = 1000;
			$filename = $data_post['id_pelanggan'];
			$config['file_name'] = $filename;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			
		// var_dump($_FILES['izin_usaha']['tmp_name']);
			if ($this->upload->do_upload('izin_usaha')) {
				$gbr = $this->upload->data();
				$foto_izin_usaha = $gbr['file_name'];
			}
			// return true;
		}
		// var_dump($ktp);
	// die;
		$data = array(
			'table_name' => 'tbl_pelanggan',
			'kd_pelanggan' => $data_post['kd_pelanggan'],
			'nama_lengkap' => $data_post['nama_lengkap'],
			'no_hp' => $data_post['no_hp'],
			'no_ktp' => $data_post['no_ktp'],
			'tgl_lahir' => $data_post['tgl_lahir'],
			'email' => $data_post['email'],
			'provinsi' => $data_post['provinsi'],
			'kabupaten' => $data_post['kabupaten'],
			'kecamatan' => $data_post['kecamatan'],
			'kelurahan' => $data_post['kelurahan'],
			'dusun' => $data_post['dusun'],
			'negara' => $data_post['negara'],
			'pekerjaan' => $data_post['pekerjaan'],
			'no_usaha' => $data_post['no_usaha'],
			'ktp' => $ktp,
			'npwp' => $npwp,
			'izin_usaha' => $foto_izin_usaha,
			'no_usaha' => $data_post['no_usaha'],
			'norek' => $data_post['norek'],
			'pemilik' => $data_post['pemilik'],
			'no_darurat' => $data_post['no_darurat'],
			'status_klg' => $data_post['status_klg'],
			'tanggal' => date('Y-m-d H:i:s'),
			'status' => 'Aktif'
		);
// var_dump($data);die;
		if (!empty($data_post['id_pelanggan'])) {
			$data['key_name'] = 'id_pelanggan';
			$data['key'] = $data_post['id_pelanggan'];
			// $data['updatedon'] = date('Y-m-d H:i:s');
			// $data['updatedby'] = $this->session->userdata('username');
			$query = $this->baseben->update($data);
		} else {
			// $data['createdon'] = date('Y-m-d H:i:s');
			// $data['createdby'] = $this->session->userdata('email');

			$query = $this->baseben->insert($data);
		}

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}




		redirect(base_url() . 'nasabah');
	}



	function rekap()
	{
		$data['title'] = 'Rekap Data Keuangan';
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
			'table_name' => 'tbl_pelanggan',
			'status' => $data_post['status'],
			'key' => $data_post['id_pelanggan'],
			'key_name' => 'id_pelanggan',
			// 'updatedon' => date('Y-m-d H:i:s')


		);
		// if ($_FILES['ktp']['name'] != '') {
		// 	$data['ktp'] = $this->_upload('ktp', 'ktp');
		// }

	

		$query = $this->baseben->update($data);

		if ($query) {
			echo json_encode(array('kode' => 200, 'keterangan' => 'Status berhasil di update'));
		} else {
			echo json_encode(array('kode' => 500, 'keterangan' => 'Status gagal di update'));
		}
	}
}
