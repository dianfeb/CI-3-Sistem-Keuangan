<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Email Sections
| -------------------------------------------------------------------------
| This file lets you determine whether or not various sections of Email
| data are displayed when the Email is enabled.
| Please see the user guide for info:
|
|  http://ellislab.com/codeigniter/user-guide/libraries/email.html
|
*/

$config['protocol'] = 'smtp';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'utf-8';
$config['wordwrap'] = FALSE;
#$config['crlf'] = "\r\n";
#$config['newline'] = "\r\n"; 
$config['smtp_host'] = 'email anda';

$config['smtp_user'] = '';
$config['smtp_pass'] = '';


$config['smtp_port'] = 25;
$config['smtp_timeout'] =60;
$config['mailtype'] ='html';



/* End of file Email.php */
/* Location: ./application/config/Email.php */
