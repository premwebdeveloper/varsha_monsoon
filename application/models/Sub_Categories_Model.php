<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Sub_Categories_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get all subcategorys
    public function index()
    {
        $this->db->select('sub_cat.*, cat.category');

        $this->db->from('sub_categories sub_cat');

        $this->db->join('categories cat', 'cat.id = sub_cat.category_id');

        $this->db->where('sub_cat.status', '1');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    // Add new subcategory
    public function add_sub_category($subcategory)
    {
        $this->db->trans_start();

            $data = array(
                'category_id   '            => $subcategory['category'],
                'sub_category   '            => $subcategory['name'],
                'status'          => 1,
            );

            $this->db->insert('sub_categories', $data);

            $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return true;
    }

    // Delete user address
    public function deleteSubCategory($sub_category_id)
    {
         $data = array(
            'status' => 0
        );

        $this->db->where('id', $sub_category_id);

        # update Users_details
        $this->db->update('sub_categories', $data);

        return true;
    }
}