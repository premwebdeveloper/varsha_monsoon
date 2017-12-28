<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function index()
    {
        $this->db->select('prod.*, cat.category, brand.brand');

        $this->db->from('products prod');

        $this->db->join('categories cat', 'cat.id = prod.category_id');

        $this->db->join('brands brand', 'brand.id = prod.brand_id');

        $this->db->where('prod.status', '1');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    // Add new address
    public function add_product($product)
    {
        $date = date('Y-m-d H:i:s');

        $this->db->trans_start();

        $data = array(
            'brand_id'     => $product['brand'],
            'category_id'  => $product['category'],
            'name'         => $product['name'],
            'sku_code'     => $product['sku_code'],
            'price1'       => $product['price1'],
            'price2'       => $product['price2'],
            'description'  => $product['description'],
            'created_date' => $date,
            'updated_date' => $date,
            'status'       => 1,
        );

        $this->db->insert('products', $data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return true;
    }

    // Delete user address
    public function deleteProduct($product_id)
    {
         $data = array(
            'status' => 0
        );

        $this->db->where('id', $product_id);

        # update Users_details
        $this->db->update('products', $data);

        return true;
    }

}