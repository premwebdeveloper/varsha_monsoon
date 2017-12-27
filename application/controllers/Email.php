<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Email extends My_controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function sendEmail()
	{
		$this->load->library('email');

		$config = array(
		    'protocol'  => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'premsinghania2402@gmail.com',
		    'smtp_pass' => '212matpuchhna',
		    'mailtype'  => 'html',
		    'charset'   => 'utf-8'
		);

		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$htmlContent = '<h1>Sending email via SMTP server</h1>';
		$htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

		$this->email->to('prem_saini@hotmail.com');
		$this->email->from('premsinghania2402@gmail.com');
		$this->email->subject('How to send email via SMTP server in CodeIgniter');
		$this->email->message($htmlContent);

		//Send email
		$this->email->send();
	}
}
?>