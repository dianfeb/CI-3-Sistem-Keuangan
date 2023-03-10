<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');

		if(empty($this->session->userdata('login'))){
			redirect(base_url());
		}
		
	}

	public function index()
	{
        $data['title'] = 'Pengaturan Sistem';
		$data['menu'] = 'pengaturan';
		$data['js'] = 'js_pengaturan';
        $data['content'] = 'pengaturan';

		$con = array(
			'table_name' => 'tbl_identitas',
			'where' => array('id_identitas' => 1) 
		);

		$data['get'] = $this->baseben->get($con);

        $this->load->view('template/main', $data);
		
	}

	function update_pengaturan(){
		$data_post = $this->input->post();

		$data = array(
			'table_name' => 'tbl_identitas',
			'nama_website' => $data_post['nama_website'],
			'email' => $data_post['email'],
			'alamat' => $data_post['alamat'],
			'no_telp' => $data_post['no_telp'],
			'no_fax' => $data_post['no_fax'],
		);

		if ($_FILES['logo']['name'] != '') {
			$data['logo'] = $this->_upload('logo', 'logo');
		}

		if ($_FILES['favicon']['name'] != '') {
			$data['favicon'] = $this->_upload('favicon', 'favicon');
		}

		if(!empty($data_post['id_identitas'])){
			$data['key_name'] = 'id_identitas';
			$data['key'] = $data_post['id_identitas'];
			$data['updatedon'] = date('Y-m-d H:i:s');
			$data['updatedby'] = $this->session->userdata('username');
			$query = $this->baseben->update($data);
		}else{
			$data['createdon'] = date('Y-m-d H:i:s');
			$data['createdby'] = $this->session->userdata('username');

			$query = $this->baseben->insert($data);
		}

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}

		redirect(base_url() . 'pengaturan');
	}

}
