<?php
class Custom_Model extends CI_Model
{

    function getLaporPasar($date)
    {

        $db = $this->load->database('default', TRUE);
        $db->select(array(
            'pasar_id',
            'nama as nama_pasar',
        ));
        $db->where('status', 'Aktif');
        $db->where('pasar_id not in (select pasar_id from status_lapor_v where tgl_lapor =\''.$date.'\')');

        $db->group_by(array(
            'pasar_id',
            'nama',
        ));

        return $db->get('pasar_v')->result_array();
    }

   
}
