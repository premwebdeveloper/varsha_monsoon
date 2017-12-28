<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Brands_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get all brands
    public function index()
    {
        $query = $this->db->get_where('brands', array('status' => '1'));
        $result = $query->result_array();

        return $result;
    }

    // Add new address
    public function add_brand($brand)
    {
        $this->db->trans_start();

            $data = array(
                'brand'            => $brand['name'],
                'status'          => 1,
            );

            $this->db->insert('brands', $data);

            $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return true;
    }

    // Delete user address
    public function deleteBrand($brand_id)
    {
         $data = array(
            'status' => 0
        );

        $this->db->where('id', $brand_id);

        # update Users_details
        $this->db->update('brands', $data);

        return true;
    }
}