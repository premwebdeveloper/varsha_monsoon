<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Categories_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get all categories
    public function index()
    {
        $query = $this->db->get_where('categories', array('status' => '1'));
        $result = $query->result_array();

        return $result;
    }

    // Add new address
    public function add_category($category)
    {
        $this->db->trans_start();

            $data = array(
                'category'            => $category['name'],
                'status'          => 1,
            );

            $this->db->insert('categories', $data);

            $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return true;
    }

    // Delete user address
    public function deleteCategory($category_id)
    {
         $data = array(
            'status' => 0
        );

        $this->db->where('id', $category_id);

        # update Users_details
        $this->db->update('categories', $data);

        return true;
    }
}