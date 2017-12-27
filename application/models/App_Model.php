<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	# Verify Email and Token code If available then active user else hit error
	public function verify_email($email, $verify_token)
	{
		$query = $this->db->get_where('users', array('email' => $email, 'verify_token' => $verify_token, 'active' => '0'));
		$result = $query->num_rows();

		if($result > 0)
		{
			$data = array(
				'verify_token' => NULL,
				'active' => "1",
			);

			$data1 = array(
				'status' => "1",
			);

			$this->db->where('email', $email);

			# Update Users Table
			$this->db->update('users', $data);

			# update Users_details
			$this->db->update('user_details', $data1);

			return true;
		}
		else
		{
			return false;
		}
	}

	// Get user detail by user email before login
	public function getUserByEmail($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		$result = $query->row_array();
		return $result;
	}

	// Get user existance in users table By Mobile number
	public function getUserByMobile($phone)
	{
		$query = $this->db->get_where('users', array('phone' => $phone));
		$result = $query->row_array();
		return $result;
	}

}