<?php
defined('BASEPATH') or exit('No direct script access allowed');
define('FILE_ENCRYPTION_BLOCKS', 10000);

class MY_Controller extends CI_Controller
{

	function __construct()
	{

		parent::__construct();
		#MODEL Loads
		$this->load->model('Baseben_Model', 'baseben');
		$this->load->model('Custom_Model', 'custommod');
		$this->load->library('encryption');
	}

	function update_status()
	{
		$data_post = $this->input->post();

		$data = array(
			'table_name' => $data_post['table_name'],
			'status' => $data_post['status'],
			'updatedon' => date('Y-m-d H:i:s'),
			'updatedby' => $this->session->userdata('email'),
			'key' => $data_post['key'],
			'key_name' => $data_post['key_name']
		);

		$query = $this->baseben->update($data);

		if ($query) {
			echo json_encode(array('kode' => 200, 'keterangan' => 'Status berhasil di update'));
		} else {
			echo json_encode(array('kode' => 500, 'keterangan' => 'Status gagal di update'));
		}
	}

	function _upload($id_input, $jenis, $name = null)
	{
		$path = './public/' . $jenis;

		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}

		$this->load->library('upload');

		$config = array(
			'upload_path' => $path,
			'allowed_types' => "png|jpg|jpeg|webp|pdf|docx|doc|ppt|xlsx|xls|pptx|zip|rar|ico",
			'overwrite' => TRUE,
			'encrypt_name' => FALSE,
			'max_size' => 50000
		);

		$this->upload->initialize($config);

		if ($this->upload->do_upload($id_input)) {
			$response = $this->upload->data("file_name");
		} else {
			$response = $this->upload->display_errors();
		}

		//var_dump($response);die();

		return $response;
	}
}
