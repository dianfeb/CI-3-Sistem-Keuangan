<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');
	}

	public function index()
	{
        $data['title'] = 'Dashboard';
        $data['menu'] = 'dashboard';
        $data['content'] = 'dashboard';

		$data['bulan_masuk'] = $this->getData('Aktif', 'Deposit', date('Y-m'));
		$data['bulan_keluar'] = $this->getData('Aktif', 'Penarikan', date('Y-m'));

		$data['total_masuk'] = $this->getData('Aktif', 'Deposit', null);
		$data['total_keluar'] = $this->getData('Aktif', 'Penarikan', null);

		$this->load->view('template/main', $data);
	}

	function getData($status = null, $jenis = null, $bulan = null){

		$con = array(
			'table_name' => 'tbl_keuangan',
			'select' => array('SUM(jumlah) as jumlah')
		);

		if(!empty($jenis)){
			$con['where']['jenis'] = $jenis;
		}

		if(!empty($bulan)){
			$con['where']['MONTH(tgl)'] = date('m');
			$con['where']['YEAR(tgl)'] = date('Y');
		}

		if(!empty($status)){
			$con['where']['status'] = $status;
		}else{
			$con['where']['status !='] = 'Deleted';
		}

		$get = $this->baseben->get($con);

		if($get[0]['jumlah'] == null){
			return 0;
		}else{
			return $get[0]['jumlah'];
		}
	}
}
