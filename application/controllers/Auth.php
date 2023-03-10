	<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Auth extends CI_Controller
	{


		public function __construct()
		{
			parent::__construct();
			$this->load->model('Baseben_Model', 'baseben');
		}

		public function index()
		{
			if (!empty($this->session->userdata('login'))) {
				redirect(base_url() . 'dashboard');
			}

			$this->load->view('login');
		}

		public function check_login()
		{
			$con = array(
				'table_name' => 'tbl_users',
				'where' => array(
					'username' => $this->input->post('username'),
					//	'password' => sha1(md5($this->input->post('password')))
					'password' => $this->input->post('password'),
					'pin' => $this->input->post('pin'),
				)
			);

			$check = $this->baseben->get($con);




			// echo json_encode($data);

			if (count($check) > 0) {
				$check[0]['login'] = 1;
				$this->session->set_userdata($check[0]);
				$this->session->set_flashdata('alert', 'success');
				$this->session->set_flashdata('message', 'Login Berhasil');
				$data = array(
					'status' => true,
					'msg' => 'login'
				);
				// redirect(base_url() . 'dashboard');
			} else {

				$data = array(
					'status' => false,
					'msg' => 'cant login'
				);
				$this->session->set_flashdata('alert', 'danger');
				$this->session->set_flashdata('message', 'Pin salah');
				// redirect(base_url());
			}

		echo json_encode($data);


			// if (count($check) > 0) {
			// 	$check[0]['login'] = 1;
			// 	$this->session->set_userdata($check[0]);
			// 	$this->session->set_flashdata('alert', 'success');
			// 	$this->session->set_flashdata('message', 'Login Berhasil');

			// 	redirect(base_url() . 'dashboard');
			// } else {

			// 	$con = array(
			// 		'table_name' => 'tbl_users',
			// 		'where' => array(
			// 			'email' => $this->input->post('username'),
			// 			// 'password' => sha1(md5($this->input->post('password')))
			// 			'password' => $this->input->post('password')),
			// 			'pin' => $this->input->post('pin'),
			// 		);

			// 	$check = $this->baseben->get($con);

			// 	if (count($check) > 0) {
			// 		$check[0]['login'] = 1;
			// 		$this->session->set_userdata($check[0]);
			// 		$this->session->set_flashdata('alert', 'success');
			// 		$this->session->set_flashdata('message', 'Login Berhasil');

			// 		redirect(base_url() . 'dashboard');
			// 	} else {

			// 		$this->session->set_flashdata('alert', 'danger');
			// 		$this->session->set_flashdata('message', 'Password / Username salah');
			// 		redirect(base_url());
			// 	}
			// }

		}



		public function signout()
		{
			$this->session->unset_userdata('login');
			$this->session->sess_destroy();
			redirect(base_url());
		}
	}
