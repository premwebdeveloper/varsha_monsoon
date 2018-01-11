<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get All Slider
    public function slider($id = null)
    {
        if(!is_null($id))
        {
            $query = $this->db->get_where('slider', array('id' => $id));
            $result = $query->row_array();
        }
        else
        {
            $query = $this->db->get_where('slider');
            $result = $query->result_array();
        }
        return $result;
    }

    // Add Slider
    public function addSlider($slider)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

            $data = array(
                'title' => $slider['title'],
                'description' => $slider['description'],
                'image' => $slider['image'],
                'created_on' => $date,
                'updated_on' => $date,
                'status' => '1',
            );

        $this->db->insert('slider', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    // Remove Slider
    public function removeSlider($slider_id)
    {
        $this->db->where('id', $slider_id);

        $this->db->delete('slider');

        return true;
    }

    // Get All Offer
    public function offer($id = null)
    {
        if(!is_null($id))
        {
            $query = $this->db->get_where('offer', array('id' => $id));
            $result = $query->row_array();
        }
        else
        {
            $query = $this->db->get_where('offer');
            $result = $query->result_array();
        }
        return $result;
    }

    // Add Slider
    public function addOffer($offer)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

            $data = array(
                'title' => $offer['title'],
                'price' => $offer['price'],
                'description' => $offer['description'],
                'image' => $offer['image'],
                'created_on' => $date,
                'updated_on' => $date,
                'status' => '1',
            );

        $this->db->insert('offer', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    // Remove Slider
    public function removeOffer($offer_id)
    {
        $this->db->where('id', $offer_id);

        $this->db->delete('offer');

        return true;
    }

    //Delete Food Type
   /* public function delete_food_type($id)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'status' => "0",
            'updated_on' => $date
        );

        $this->db->where('id', $id);

        $this->db->update('food_category', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Add Food Type


    //Get Food Type Detail for Edit Food Type
    public function edit_food_category($food_category_id, $type, $desc, $category, $image)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'description' => $desc,
            'food_category' => $category,
            'food_type' => $type,
            'image' => $image,
            'updated_on' => $date,
        );

        $this->db->where('id', $food_category_id);

        $this->db->update('food_category', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Add Blog
    public function add_blog($desc, $title, $category, $image)
    {
       $date = date('Y-m-d H:i:s');

       //Start Transaction
       $this->db->trans_start();

       $data_create = array(
            'title' => $title,
            'description' => $desc,
            'category' => $category,
            'image' => $image,
            'create_by' => 'Admin',
            'created_date' => $date,
            'updated_date' => $date,
            'status' => '1',
       );

       $this->db->insert('blogs', $data_create);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Update Blog
    public function edit_blog($id, $desc, $title, $category, $image)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'title' => $title,
            'description' => $desc,
            'category' => $category,
            'image' => $image,
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('blogs', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Delete Blog
    public function delete_blog($id)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'status' => "0",
            'updated_date' => $date
        );

        $this->db->where('id', $id);

        $this->db->update('blogs', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }*/
}