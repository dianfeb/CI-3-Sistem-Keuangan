<?php
class Baseben_Model extends CI_Model {

    function get($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
        }

        if(isset($data['key_name']) && isset($data['key'])){
            $db->group_start();
            $db->where($data['key_name'],$data['key']);
            $db->group_end();
        }

        if(isset($data['select']) && is_array($data['select'])){
            $db->select($data['select']);
        }

        if(isset($data['where']) && is_array($data['where'])){
            $db->group_start();
            $db->where($data['where']);
            $db->group_end();
        }
        
        

        if(isset($data['where_in']) && is_array($data['where_in'])){
            $db->group_start();
            $db->where_in($data['where_in'][0],$data['where_in'][1]);
            $db->group_end();
        }

        if(isset($data['like']) && is_array($data['like'])){
            $db->like($data['like'][0],$data['like'][1]);
        }
        
        if(isset($data['group_by']) && is_array($data['group_by'])){
            $db->group_by($data['group_by']);
        }

        if(isset($data['order_by']) && is_array($data['order_by'])){
            $db->order_by($data['order_by'][0],$data['order_by'][1]);
        }
        
        if(isset($data['limit'])){
            $offset = 0;
            if(isset($data['offset'])){
                $offset = $data['offset'];
            }
            $db->limit($data['limit'], $offset);
        }

        return $db->get($data['table_name'])->result_array();
    }

    function getField($data){
        return $this->db->get($data['table_name'])->list_fields();
    }

    function insert($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
            unset($data['db']);
        }
        $temp_data = $data;
        unset($data['table_name']);
        return $db->insert($temp_data['table_name'], $data);
       
    }

    function insert_batch($table,$data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
            unset($data['db']);
        }
        $temp_data = $data;
        return $db->insert_batch($table, $data);
       
    }

    function insert_id($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
            unset($data['db']);
        }
        $temp_data = $data;
        unset($data['table_name']);
        $db->insert($temp_data['table_name'], $data);
        return $db->insert_id();
       
    }

    function update($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
            unset($data['db']);
        }
        $temp_data = $data;
        unset($data['table_name']);
        unset($data['key_name']);
        unset($data['key']);
        return $db->where($temp_data['key_name'],$temp_data['key'])->update($temp_data['table_name'], $data);
    }

    function delete($data){
        $db = $this->load->database('default',true);
        if(isset($data['db'])){
            $db = $this->load->database($data['db'],true);
            unset($data['db']);
        }
        return $db->where($data['key_name'],$data['key'])->delete($data['table_name']);
    }
    

}

?>