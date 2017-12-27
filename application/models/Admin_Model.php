<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get All Food Types from 'food_category' table
    public function food_category($id = null)
    {
        if(!is_null($id))
        {
            $query = $this->db->get_where('food_category', array('status' => '1', 'id' => $id));
            $result = $query->row_array();
            //echo $this->db->last_query();exit;
        }
        else
        {
            $query = $this->db->get_where('food_category', array('status' => '1'));
            $result = $query->result_array();
        }
        return $result;
    }

    //Delete Food Type
    public function delete_food_type($id)
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
    public function add_food_category($desc, $type, $type_name, $image)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

            $data_create = array(
            'food_category' => $type_name,
            'food_type' => $type,
            'image' => $image,
            'description' => $desc,
            'status' => '1',
            'created_on' => $date,
            'updated_on' => $date,
            );
        $this->db->insert('food_category', $data_create);
        //echo $this->db->last_query();exit;
        // End Transaction
        $this->db->trans_complete();
        return true;
    }

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
    }
}