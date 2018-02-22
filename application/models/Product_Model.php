<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Model extends CI_Model
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

    // Get products by product type
    public function getProductsByAll($type=null, $meal=null, $cat=null)
    {
        $this->db->select('*');

        $this->db->from('food_listings');

        if(!is_null($type) && is_null($meal) && is_null($cat)){

             $this->db->where('food_type', $type);
        }
        elseif (is_null($type) && !is_null($meal) && is_null($cat)) {

            $this->db->where('breakfast_lunch_dinner', $meal);
        }
        elseif (is_null($type) && is_null($meal) && !is_null($cat)) {

            $this->db->where('food_category', $cat);
        }
        elseif (!is_null($type) && !is_null($meal) && is_null($cat)) {

            $this->db->where('food_type', $type);
            $this->db->where('breakfast_lunch_dinner', $meal);
        }
        elseif (is_null($type) && !is_null($meal) && !is_null($cat)) {

            $this->db->where('breakfast_lunch_dinner', $meal);
            $this->db->where('food_category', $cat);
        }
        elseif (!is_null($type) && is_null($meal) && !is_null($cat)) {

            $this->db->where('food_type', $type);
            $this->db->where('food_category', $cat);
        }
        elseif (!is_null($type) && !is_null($meal) && !is_null($cat)) {

            $this->db->where('food_type', $type);
            $this->db->where('breakfast_lunch_dinner', $meal);
            $this->db->where('food_category', $cat);
        }

        $query = $this->db->get();

        $result = $query->result_array();

        //echo $this->db->last_query();exit;

        return $result;

    }

    //Change Delivery Status in Food LIsting Table
    public function delivery($user_id, $data)
    {
        $date = date("Y-m-d H:i:s");

        $result = array(
            'today_delivery_by_seller' => $data,
            'updated_on' => $date,
        );

        $this->db->where('user_id', $user_id);

        # update Users_details
        $this->db->update('food_listings', $result);

        return true;
    }
	
	// Search products
    public function searchProducts($search_for)
    {
        $this->db->select('prod.*, bra.brand, cat.category');

        $this->db->from('products prod');

        $this->db->join('brands bra', 'bra.id = prod.brand_id');
        $this->db->join('categories cat', 'cat.id = prod.category_id');

        $this->db->where('prod.status', 1);

        $this->db->like('prod.name', $search_for);
        $this->db->or_like('prod.sku_code', $search_for);
        $this->db->or_like('prod.price1', $search_for);
        $this->db->or_like('prod.price2', $search_for);
        $this->db->or_like('bra.brand', $search_for);
        $this->db->or_like('cat.category', $search_for);

        $query = $this->db->get();

        $result = $query->result_array();

        //echo $this->db->last_query();exit;

        return $result;
    }
	
	# get product images
	public function getProductImagesByID($product_id)
	{
		$this->db->select('*');

        $this->db->from('product_images');

		$where = array('product_id' => $product_id, 'status' => 1);
		
        $this->db->where($where);

        $query = $this->db->get();

        $result = $query->result_array();

        //echo $this->db->last_query();exit;

        return $result;
	}
	

}