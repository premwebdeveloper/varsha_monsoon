<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function index()
    {
        $query = $this->db->get_where('blogs', array('status' => '1'));
        $result = $query->result_array();
        return $result;
    }

    //View Blog by Id
    public function view($id)
    {
        $query = $this->db->get_where('blogs', array('status' => '1', 'id' => $id));
        $result = $query->row_array();
        return $result;
    }

}