<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->Model('Users_Model');

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the Home page
			redirect('/', 'refresh');
		}
		else
		{
			// If logged in user is USER not admin
			if($this->ion_auth->in_group('user'))
			{
				$user_id = $this->access->get_user_id();

		        // Get User Details
		        $this->data['user_data'] = $user_data = $this->Users_Model->get_user($user_id);
			}
		}

	}

	protected function render($the_view = NULL, $template = NULL)
	{
		if($_SESSION['user_group'] == 'user')
		{
			$template = 'public_master';
		}
		if($_SESSION['user_group'] == 'admin')
		{
			$template = 'auth_master';
		}

		parent::render($the_view, $template);
	}
}
?>