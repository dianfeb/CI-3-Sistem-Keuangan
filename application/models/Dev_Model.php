<?php

class Dev_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert($post)
    {
        $headers = $this->input->request_headers();
        if (isset($headers['x-api-key']) || isset($headers['X-API-KEY'])) {

            $api_key = '';
            if (array_key_exists('x-api-key', $headers)) {
                $api_key = $headers['x-api-key'];
            } else if (array_key_exists('X-API-KEY', $headers)) {
                $api_key = $headers['X-API-KEY'];
            }
            if ($api_key != '') {

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip_address = $_SERVER['REMOTE_ADDR'];
                }

                $agent= '';
                if(array_key_exists('User-Agent',$headers)){
                    $agent=$headers['User-Agent'];
                }
                $server_uri = explode('/', $_SERVER['REQUEST_URI']);
                $data = array(
                    'api_key' => $api_key,
                    'user_agent' => $agent,
                    'request_http_method' => $_SERVER['REQUEST_METHOD'],
                    'request_body' => (count($post)>0)?json_encode($post):null,
                    'request_timestamp' => date('Y-m-d H:i:s'),
                    'request_ip_address' => $ip_address,
                    'request_api_method' =>(isset($server_uri[3]) ? $server_uri[3] : $server_uri[2]),
                    'log_request_date' => date('Y-m-d'),
                    'uri' => $_SERVER['REQUEST_URI']
                );
                $this->db->insert('api_dev_log', $data);
                return $this->db->insert_id();
            }
        } else {
            return false;
        }
    }


}
 

?>