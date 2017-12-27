<?php if (!defined('BASEPATH'))   exit('No direct script access allowed');

class send_email
{
	function __construct()
	{
		$this->CI = & get_instance();
	}

	# Send Email to User's Email ID
	function sendEmail($email, $message, $subject)
	{
		$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'ambrlabs01@gmail.com',
		    'smtp_pass' => '!@#$%^&*',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);

		$this->CI->email->initialize($config);
		$this->CI->email->set_mailtype("html");
		$this->CI->email->set_newline("\r\n");

		$htmlContent = $message;

		$this->CI->email->to($email);
		$this->CI->email->from('ambrlabs01@gmail.com');
		$this->CI->email->subject($subject);
		$this->CI->email->message($htmlContent);

		//Send email
		$this->CI->email->send();

		return true;

	}
}

?>