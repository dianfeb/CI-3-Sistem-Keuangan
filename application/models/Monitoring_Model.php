<?php

class Monitoring_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_data($data_post, $query = null, $nolimit = null)
    {

        if(empty($this->input->post('db'))){
            $db = $this->load->database('oss', true);
        }else{
            $db = $this->load->database($this->input->post('db'), true);
        }
      

        if (!empty($data_post['tgl_awal'])) {
            $db->where('receive_date >=', $data_post['tgl_awal']);
        }
        if (!empty($data_post['tgl_akhir'])) {
            $db->where('receive_date <=', $data_post['tgl_akhir']);
        }


        if ($data_post['status'] != '') {
            $db->where('status', $data_post['status']);
        }

        if (!empty($data_post['jenis'])) {
            $db->where('jenis', $data_post['jenis']);
        }

        $i = 0;
        $column_search = array('id_pengajuan');
        $column_order = array();
        foreach ($column_search as $item) {
            if ($data_post['search']['value']) {
                if ($i === 0) {
                    $db->group_start();
                    $db->like($item, $data_post['search']['value']);
                } else {
                    $db->or_like($item, $data_post['search']['value']);
                }
                if (count($column_search) - 1 == $i) //last loop
                    $db->group_end();
            }
            $i++;
        }

        if (isset($data_post['order'])) {
            $db->order_by($column_order[$data_post['order']['0']['column']], $data_post['order']['0']['dir']);
        }

        $db->order_by('receive_date','desc');

        if ($nolimit != null) {
            $query = $db->get($this->input->post('receive'));
            return $query->num_rows();
        } else if ($query == null) {
            if ($data_post['length'] != -1)
                $db->limit($data_post['length'], $data_post['start']);
            $query = $db->get($this->input->post('receive'));
            return $query->result();
        } else {

            return $db->get_compiled_select($this->input->post('receive'));
        }
    }


    function count_filtered($data_post)
    {
        $db = $this->load->database('oss', true);
        return  $this->get_data($data_post, null, 'all');;
    }


    public function getAbsensi($data_post, $query = null, $nolimit = null)
    {

        $db = $this->load->database('default', true);

        if (!empty($data_post['nip'])) {
            $db->where('nip', $data_post['nip']);
        }

        $i = 0;
        $column_search = array('nip');
        $column_order = array('absen_masuk','absen_pulang');
        foreach ($column_search as $item) {
            if ($data_post['search']['value']) {
                if ($i === 0) {
                    $db->group_start();
                    $db->like($item, $data_post['search']['value']);
                } else {
                    $db->or_like($item, $data_post['search']['value']);
                }
                if (count($column_search) - 1 == $i) //last loop
                    $db->group_end();
            }
            $i++;
        }

        if (isset($data_post['order'])) {
            $db->order_by($column_order[$data_post['order']['0']['column']], $data_post['order']['0']['dir']);
        }

        if ($nolimit != null) {
            $where = '';
            if (!empty($data_post['nip'])) {
                $where = 'where nip=\''.$data_post['nip'].'\'';
            }
            $query = $db->query('select count(*) as jml from
            (select date(checktime),nip as jml from tbl_absensi '.$where.'  GROUP BY date(checktime),nip) sum')->result();
            return $query[0]->jml;
        } else if ($query == null) {
            if ($data_post['length'] != -1)
                $db->limit($data_post['length'], $data_post['start']);
            $query = $db->get('absensi_v');
            return $query->result();
        } else {

            return $db->get_compiled_select('absensi_v');
        }
    }


    function count_filtered_absensi($data_post)
    {
        $db = $this->load->database('default', true);
        return  $this->getAbsensi($data_post, null, 'all');;
    }
}
