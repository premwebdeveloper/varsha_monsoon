<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function index($product_id = null)
    {
        $this->db->select('prod.*, cat.category, brand.brand');

        $this->db->from('products prod');

        $this->db->join('categories cat', 'cat.id = prod.category_id');

        $this->db->join('brands brand', 'brand.id = prod.brand_id');

        $this->db->where('prod.status', '1');

        if(!empty($product_id))
        {
            $this->db->where('prod.id', $product_id);
        }

        $this->db->where('prod.status', '1');

        $query = $this->db->get();

        if(!empty($product_id))
        {
            $result = $query->row_array();
        }
        else
        {
            $result = $query->result_array();
        }

        return $result;
    }

    // Get Product Images
    public function getProductImages($product_id)
    {
        $this->db->select('*');

        $this->db->from('product_images');

        $where = array('status' => '1', 'product_id' => $product_id);

        $this->db->where($where);

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

        return $insert_id;
    }

    // Delete user address
    public function editProduct($product)
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
            'updated_date' => $date,
        );

        $this->db->where('id', $product['product_id']);

        $this->db->update('products', $data);

        $this->db->trans_complete();

        return true;
    }

    // Insert product images
    public function addProductImage($insert_id, $image)
    {
        $date = date('Y-m-d H:i:s');

        $this->db->trans_start();

        $data = array(
            'product_id'   => $insert_id,
            'image'        => $image,
            'created_date' => $date,
            'updated_date' => $date,
            'status'       => 1,
        );

        $this->db->insert('product_images', $data);

        $this->db->trans_complete();

        return true;
    }

    // Delete Product
    public function deleteProduct($product_id)
    {
        // Update product status  = 0
        $data = array(
            'status' => 0
        );

        $this->db->where('id', $product_id);

        # update Users_details
        $this->db->update('products', $data);

        // Update product image status = 0

        $this->db->where('product_id', $product_id);

        # update Users_details
        $this->db->update('product_images', $data);

        return true;
    }

    // Delete product Image
    public function deleteImage($image_id)
    {
        $this->db->where('id', $image_id);

        $this->db->delete('product_images');

        return true;
    }

}