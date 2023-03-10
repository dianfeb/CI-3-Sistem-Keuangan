<?php

class M_Kode extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function kodePelanggan()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kd_pelanggan,3)) AS kd_max FROM tbl_pelanggan WHERE DATE(tanggal)=CURDATE()");
        $kd = "";
        $char = "PL";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $char . sprintf("%03s", $tmp);
            }
        } else {
            $kd = "01";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $kd . date('y');
    }

    function kodeTransaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tglpl = date('Ymd');

        $tgl2 = date('Y-m-d');
        $no_default = "0001";
        $id_keuangan = "T" . $tglpl . "" . $no_default;

        $cek = $this->db->like('id_keuangan', 'T' . $tglpl)->get('tbl_keuangan')->result();
        if (count($cek) >  0) {


            $last = $this->db->like('id_keuangan', 'T' . $tglpl)->order_by('id_keuangan', 'desc')->get('permintaan_lab')->row()->id_keuangan;

            $last = substr($last, 10);


            $new = (int)$last + 1;
            $new_nota = substr($last, 0, strpos((string)$last, (string)$new) - strlen((string)$new)) . "" . $new;
            $noorder = "T" . $tglpl . "" . $new_nota;
        }
    }


    function simpan_upload($ktp){
        $data = array(

                'ktp' => $ktp
            );  
        $result= $this->db->insert('tbl_pelanggan',$data);
        return $result;
    }


    function get_data_nasabah(){
        $query = $this->db->query("SELECT * FROM tbl_pelanggan WHERE DATE(tanggal)=CURDATE()");

        // if($query->num_rows() > 0){
        //     foreach($query->result() as $data){
        //         $hasil[] = $data;
        //     }
        //     return $hasil;
        // }
    }

    public function chart()
    {
        $data_nasabah = $this->db->query("SELECT COUNT(id_keuangan) AS jumlah, 
        DATE_FORMAT(tgl, '%Y %m') AS nasabah_bulan FROM tbl_keuangan GROUP BY DATE_FORMAT(tgl, '%Y %m')")->result();
}
  
}
