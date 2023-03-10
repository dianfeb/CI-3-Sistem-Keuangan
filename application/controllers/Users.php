<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        $data['title'] = 'Data Users';
		$data['menu'] = 'users';
        $data['content'] = 'users';
		$data['js'] = 'js_users';
		$data['css'] = 'css_users';
        $this->load->view('template/main', $data);
		
	}

	function getUsers(){
		$data_post = $this->input->post();

        $con = array(
            'table_name' => 'tbl_users',
			'order_by' => array('users_id', 'DESC')
        );

        $where = array();

		if(!empty($data_post['users_id'])){
            $where['users_id'] =  $data_post['users_id'];
        }

        if(!empty($data_post['status'])){
            $where['status'] = $data_post['status'];
        }else{
			$where['status !='] =  'Deleted';
		}

        if(count($where) > 0){
            $con['where'] = $where;
        }

        $get = $this->baseben->get($con);

        foreach ($get as $k => $v) {
            $get[$k]['no'] = $k+1;
        }

        echo json_encode(array('data' => $get));
	}

	function crud_users(){
		$data_post = $this->input->post();

		$data = array(
			'table_name' => 'tbl_users',
			'username' => $data_post['username'],
			'pin' => $data_post['pin'],
			'nama_lengkap' => $data_post['nama_lengkap'],
			'email' => $data_post['email'],
			'no_telp' => $data_post['no_telp'],
			'role' => 'admin',
			'status' => 'Aktif'
		);

		if(!empty($data_post['password'])){
			$data['password'] = $data_post['password'];
			// $data['password'] = sha1(md5($data_post['password']));
		}

		if(!empty($data_post['users_id'])){
			$data['key_name'] = 'users_id';
			$data['key'] = $data_post['users_id'];
			$data['updatedon'] = date('Y-m-d H:i:s');
			$data['updatedby'] = $this->session->userdata('username');
			$query = $this->baseben->update($data);
		}else{
			$data['createdon'] = date('Y-m-d H:i:s');
			$data['createdby'] = $this->session->userdata('email');

			$query = $this->baseben->insert($data);
		}

		if ($query) {
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('message', 'Data berhasil disimpan');
		} else {
			$this->session->set_flashdata('alert', 'error');
			$this->session->set_flashdata('message', 'Data gagal disimpan');
		}

		redirect(base_url() . 'users');
	}

	function update_status()
    {

        $data_post = $this->input->post();

        $data = array(
            'table_name' => 'tbl_users',
            'status' => $data_post['status'],
            'key' => $data_post['users_id'],
            'key_name' => 'users_id',
			'updatedon' => date('Y-m-d H:i:s'),
			'updatedby' => $this->session->userdata('username'),
        );

        $query = $this->baseben->update($data);

        if ($query) {
            echo json_encode(array('kode' => 200, 'keterangan' => 'Status berhasil di update'));
        } else {
            echo json_encode(array('kode' => 500, 'keterangan' => 'Status gagal di update'));
        }
    }

}
