<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //Get Cart Product
    public function cart($user_id, $product_id = null)
    {
        if($product_id == null)
        {
            $query = $this->db->get_where('cart', array('status' => '1', 'user_id' => $user_id));
            $result = $query->result_array();
            return $result;
        }
        else
        {
            $query = $this->db->get_where('cart', array('product_id' => $product_id, 'user_id' => $user_id));
            $result = $query->row_array();
            return $result;
        }

    }

    // Get cart products with details
    public function cartProducts($user_id)
    {
        $this->db->select('cart.*, listing.user_id user, listing.food_name, listing.price, listing.image, food_cat.food_category, type.type');

        $this->db->from('cart cart');

        $this->db->join('food_listings listing', 'cart.product_id = listing.id');

        $this->db->join('food_category food_cat', 'food_cat.id = listing.food_category');

        $this->db->join('food_types type', 'type.id = listing.food_type');

        $this->db->where('listing.status', '1');

        $this->db->where('cart.user_id', $user_id);

        $query = $this->db->get();

        $result = $query->result_array();

        //echo $this->db->last_query(); exit;

        return $result;
    }

    // Get User Details form 'Users_details' table
    public function add_cart($user_id, $product_id, $quantity)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

            $data_create = array(
            'user_id ' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'created_date' => $date,
            'updated_date' => $date,
            'status' => '1',
            );

        $this->db->insert('cart', $data_create);

        // End Transaction
        $this->db->trans_complete();
    }

    //Update  cart Product with status 1
    public function update_cart($id, $quantity)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
        'quantity' => $quantity,
        'updated_date' => $date,
        );

        $this->db->where('id', $id);
        $this->db->update('cart', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Remove Cart Product
    public function remove_cart_product($user_id, $cart_id)
    {
        // Start Transaction
        $this->db->trans_start();

        $this->db->where('id', $cart_id);
        $this->db->where('user_id', $user_id);
        $this->db->delete('cart');

        // End Transaction
        $this->db->trans_complete();

        return true;
    }
}