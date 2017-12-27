<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Access{

	function __construct()
	{
		$this->CI = & get_instance();

		$this->msg = base64_encode("You dont have permission to view that page");

	}

	# Only Admin can access the function
	function admin_only()
	{
		if(! $this->CI->ion_auth->is_admin())
		{
			$user_groups = $this->CI->ion_auth->get_users_groups($_SESSION['user_id'])->result();
			$group = $user_groups[0]->name;

			if($group == 'user')
			{
				redirect(base_url());
			}
		}
	}

	// Get User ID
	function get_user_id ()
	{
		if (!$this->CI->ion_auth->is_admin())
		{
			$user_id = $_SESSION['user_id'];
		}
		else
		{
			$user_id = $this->CI->uri->segment(3);
		}
		return $user_id;
	}

	// User Id For Admin Console
	function get_user_uid()
	{
		if ($this->CI->ion_auth->is_admin())
		{
			$user_uid = setUser();
		}
		else
		{
			$user_uid =  $_SESSION['user_id'];
		}
		return $user_uid;
	}


}

?>