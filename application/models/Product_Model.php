<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get food types like Pure ver or Non veg
    public function getFoodType($type = null)
    {
        $this->db->select('*');

        $this->db->from('food_types');

        if(!is_null($type))
        {
            $this->db->where('id', $type);

            $query = $this->db->get();

            $result = $query->row_array();
        }
        else
        {
            $query = $this->db->get();

            $result = $query->result_array();
        }

        return $result;
    }

    // Get food category
    public function getFoodCategory($category = null)
    {
        $this->db->select('*');

        $this->db->from('food_category');

        if(!is_null($category))
        {
            $this->db->where('id', $category);

            $query = $this->db->get();

            $result = $query->row_array();
        }
        else
        {
            $this->db->where('status', '1');

            $query = $this->db->get();

            $result = $query->result_array();
        }

        return $result;
    }

    // Get Day Meals like Breakfast / Lunch / Dinner
    public function getBreakfastLunchDinner()
    {
        $this->db->select('*');

        $this->db->from('breakfast_lunch_dinner');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    // Get Week Days
    public function week_days()
    {
        $this->db->select('*');

        $this->db->from('weak_days');

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    // Get Food Type form 'food_category' table
    public function product_category()
    {
        $this->db->select('category.*, type.type');

        $this->db->from('food_category category');

        $this->db->join('food_types type', 'type.id = category.food_type');

        $this->db->where('category.status', '1');

        $query = $this->db->get();

        $result = $query->result_array();
        //echo $this->db->last_query();exit;

        return $result;
    }

    // Get Product Availibility
    public function product_availibility($product_id = null)
    {
        if(!is_null($product_id))
        {
            $this->db->select('*');

            $this->db->from('product_available_on');

            $this->db->where('product_id', $product_id);

            $query = $this->db->get();

            $result = $query->row_array();
        }
        else
        {
            $this->db->select('*');

            $this->db->from('product_available_on');

            $query = $this->db->get();

            $result = $query->result_array();
        }

        //echo $this->db->last_query();exit;

        return $result;
    }

    // Get products
    public function getProducts($product_id = null)
    {
        if(!is_null($product_id))
        {
            $this->db->select('*');

            $this->db->from('food_listings');

            $this->db->where('id', $product_id);

            $query = $this->db->get();

            $result = $query->row_array();
        }
        else
        {
            $this->db->select('*');

            $this->db->from('food_listings');

            $query = $this->db->get();

            $result = $query->result_array();
        }

        //echo $this->db->last_query();exit;

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

}