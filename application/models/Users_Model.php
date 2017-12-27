<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_Model extends CI_Model
{
	function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	// Get User Details form 'Users_details' table
	public function get_user($user_id = null)
	{
		if(!is_null($user_id))
		{
			$query = $this->db->get_where('user_details', array('status' => '1', 'user_id' => $user_id));
			$result = $query->row_array();
		}
		else
		{
			$query = $this->db->get_where('user_details', array('status' => '1'));
			$result = $query->result_array();
		}

		return $result;
	}

	// Get Inactive User Details form 'Users_details' table
	public function inactive_users($user_id = null)
	{
		if(!is_null($user_id))
		{
			$query = $this->db->get_where('user_details', array('status' => '0', 'user_id' => $user_id));
			$result = $query->row_array();
		}
		else
		{
			$query = $this->db->get_where('user_details', array('status' => '0'));
			$result = $query->result_array();
		}

		return $result;
	}

	# Create user ( Insert User data in user_details table )
	public function create_user($user_details)
	{
		$date = date("Y-m-d");

		$this->db->trans_start();

		$data = array(
			'user_id' => $user_details['user_id'],
			'fname' => $user_details['fname'],
			'lname'	=> $user_details['lname'],
			'email'	=> $user_details['email'],
			'phone'	=> $user_details['phone'],
			'gender'	=> $user_details['gender'],
			'dob'	=> $user_details['dob'],
			'created_on' => $date,
			'updated_on' => $date,
		);

		$this->db->insert('user_details', $data);

		$this->db->trans_complete();

		return true;
	}

	# Disable user ( Update user status )
	public function active_inactive($user_id, $status)
	{
		$date = date("Y-m-d");

		if(!is_null($user_id))
		{
			$data = array(
				'status' => $status,
				'updated_on' => $date,
			);

			$this->db->where('user_id', $user_id);

			# update Users_details
			$this->db->update('user_details', $data);
		}
		return true;
	}


	//Edit User Details form 'Users_details' table
	public function edit($data)
	{
		$date = date('Y-m-d H:i:s');
		// Start Transaction
		$this->db->trans_start();

		$user_id = $_SESSION['user_id'];

		$data1 = array(
			'fname' => $data['fname'],
			'lname' => $data['lname'],
			'dob' => $data['dob'],
			'gender' => $data['gender'],
			'bio' => $data['bio'],
			'updated_on' => $date,
		);

		$this->db->where('user_id', $user_id);

		# update Users_details
		$this->db->update('user_details', $data1);

		// End Transaction
		$this->db->trans_complete();

		return true;
	}

	//update user profile (Update Email id )
	public function update_email($user_id, $email)
	{
		$date = date("Y-m-d");

		if(!is_null($user_id))
		{
			$data = array(
				'email' => $email,
				'updated_on' => $date,
			);

			$this->db->where('user_id', $user_id);

			# update Users_details
			$this->db->update('user_details', $data);
		}
		return true;
	}

	//update user new mobile number
	public function update_mobile($userID, $new_mobile)
	{
		$date = date("Y-m-d");

		if(!is_null($userID))
		{
			$data = array(
				'phone' => $new_mobile,
				'updated_on' => $date,
			);

			$this->db->where('user_id', $userID);

			# update Users_details
			$this->db->update('user_details', $data);
		}
		return true;
	}

	//Upload User Profile Image
	public function upload_image($user_id, $image)
	{
		$date = date("Y-m-d");

		if(!is_null($image))
		{
			$data = array(
				'image' => $image,
				'updated_on' => $date,
			);

			$this->db->where('user_id', $user_id);

			# update Users_details
			$this->db->update('user_details', $data);
		}
		return true;
	}
}