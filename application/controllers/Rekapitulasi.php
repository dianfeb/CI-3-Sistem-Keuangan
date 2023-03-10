<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapitulasi extends CI_Controller
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
		$data['title'] = 'Rekapitulasi';
		$data['menu'] = 'rekapitulasi';
		$data['content'] = 'rekapitulasi';
		$data['js'] = 'js_rekapitulasi';
		$data['css'] = 'css_rekapitulasi';
		$this->load->view('template/main', $data);
	}



    function getKeuangan(){
		$data_post = $this->input->post();

        $con = array(
            'table_name' => 'tbl_keuangan',
			'order_by' => array('id_keuangan', 'DESC')
        );

        $where = array();

        if(!empty($data_post['jenis'])){
            $where['jenis'] =  $data_post['jenis'];
        }

		if(!empty($data_post['id_keuangan'])){
            $where['id_keuangan'] =  $data_post['id_keuangan'];
        }

        if(!empty($data_post['status'])){
            $where['status'] = $data_post['status'];
        }else{
			$where['status !='] =  'Deleted';
		}

		if(!empty($data_post['tgl_awal'])){
			$where['tgl >='] = $data_post['tgl_awal'];
			$where['tgl <='] = $data_post['tgl_akhir'];
		}

        if(count($where) > 0){
            $con['where'] = $where;
        }

        $get = $this->baseben->get($con);

        foreach ($get as $k => $v) {
            $nm_plg = $this->db->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_pelanggan')->row();
            $get[$k]['no'] = $k+1;
			$get[$k]['tanggal'] = hari_tgl_indo($v['tgl']);
			$get[$k]['rp'] = rupiah($v['jumlah']);
			$get[$k]['jns'] = $v['jenis_transaksi'] . "(" . $v['jenis'] . ")";
            $get[$k]['nasabah'] = $nm_plg->nama_lengkap;
			if($v['jenis'] =="Deposit" && $v['jenis_transaksi'] == "tunai"){
				$get[$k]['jenis_jns'] = "Setor Tunai";
				
			}else if($v['jenis'] =="Deposit" && $v['jenis_transaksi'] == "transfer"){
				$get[$k]['jenis_jns'] = "Transfer";

			}
			if($v['jenis'] =="Penarikan" && $v['jenis_transaksi'] == "tunai"){
				$get[$k]['jenis_jns'] = "Penarikan Tunai";
				
			}else if($v['jenis'] =="Penarikan" && $v['jenis_transaksi'] == "transfer"){
				$get[$k]['jenis_jns'] = "Penarikan ke Pembayaran";

			}
			if($v['bukti'] == null || $v['bukti'] == '-'){

				$get[$k]['bukti'] =  "-";
			}else{
				$get[$k]['bukti'] =  "<button style=outline:none;border:none; onclick=detailGambar('".$v['bukti']."')><img style='width:200px;height:auto;' src=".base_url()."/assets/img/bukti/".$v['bukti']."></button>";
				// $get[$k]['bukti'] =  '<button onclick="detailGambar('.$v['id_keuangan'].')">'+"<img  style='width:200px;height:auto;' src=".base_url()."/assets/img/bukti/".$v['bukti'].">"+'</button>';
			}
			// $get[$k]['nominal_transfer'] = "Rp " . number_format($v['nominal_transfer'], 2, ',', '.');



            // $masuk = $this->db->where('jenis', 'masuk')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();
			// $keluar = $this->db->where('jenis', 'keluar')->where('id_pelanggan', $v['id_pelanggan'])->get('tbl_keuangan')->result();


        }

        echo json_encode(array('data' => $get));
	}
}
