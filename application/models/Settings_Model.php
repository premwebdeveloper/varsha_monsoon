<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_Model extends CI_Model
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


}