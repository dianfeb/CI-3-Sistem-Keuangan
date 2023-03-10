<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
   
    function __construct(){
        
        parent::__construct();
        #MODEL Loads
        $this->load->library('encryption'); 
        $this->encryption->initialize(
        array(
        		'driver' => 'opensssl',
                'cipher' => 'aes-256',
                'mode' => 'cbc',
                'key' => 'eoffice !@# $% ^&&*(( () ))^ &&* DEV NEW I&*(* ()* (* &&() ))'
        )
);
    }
    
    public function enc($plain_text)
    {	
		return  $this->encryption->encrypt($this->encryption->encrypt($plain_text));
    }
	
	public function dec($chiper_text)
    {	
		return   $this->encryption->decrypt($this->encryption->decrypt($chiper_text));
    }
}