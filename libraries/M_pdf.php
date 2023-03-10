<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use Mpdf\Mpdf;
 include_once APPPATH.'/third_party/vendor/autoload.php';

class M_pdf {

//    public $param;
    public $pdf;
    function __construct()
    {
    	        $config = array(
            'mode' => 'utf-8',
            'format' => 'A4-P',
        	'SetDisplayMode' => 'fullwidth',
            'setAutoTopMargin'    => 'stretch',
            'setAutoBottomMargin' => 'stretch',
            'autoMarginPadding'   => 0
        );
 //       $this->param =$param;
        $this->pdf = new Mpdf($config);
    }
}
