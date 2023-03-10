<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Baseben_Model', 'baseben');

		if (empty($this->session->userdata('login'))) {
			redirect(base_url());
		}
	}

	public function cetak_transaksi()
	{
		$id = $_GET['id'];
		$bukti = $this->db->where('tbl_keuangan.id_keuangan',$id)->join('tbl_pelanggan','tbl_pelanggan.id_pelanggan = tbl_keuangan.id_pelanggan')->get('tbl_keuangan')->row();
		$data['bukti'] = $bukti;
		$data['hari'] = hari_tgl_indo($bukti->tgl); 
		$this->load->view('cetak/cetak_transaksi',$data);
	}
	public function rekap_transaksi()
	{
		$id = $_GET['id'];
		$data['bukti'] = $this->db->where('tbl_keuangan.id_pelanggan',$id)->join('tbl_pelanggan','tbl_pelanggan.id_pelanggan = tbl_keuangan.id_pelanggan')->get('tbl_keuangan');
		$this->load->view('cetak/rekap_transaksi',$data);
	}

	public function cetak_nasabah()
	{
		$id = $_GET['id'];
		$data['bukti'] = $this->db->where('tbl_pelanggan.id_pelanggan',$id)->get('tbl_pelanggan')->row();
		$this->load->view('cetak/cetak_transaksi',$data);
	}


	
	public function cetak_riwayat()
    {
  
		// $data['rows'] = $this->db
		// ->from('tbl_keuangan')
		// ->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_keuangan.id_pelanggan')
		// ->get_where('tbl_keuangan', ['jenis' =>
        // $this->session->userdata('jenis_jenis')])->result();

		$data['rows'] = $this->db
		->from('tbl_keuangan')
		->join('tbl_pelanggan', 'tbl_pelanggan.id_pelanggan = tbl_keuangan.id_pelanggan')
		->get()
		->result();
		
        $this->load->view('cetak/cetak_riwayat', $data);
    }

}
