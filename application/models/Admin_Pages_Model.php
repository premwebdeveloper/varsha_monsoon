<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Admin_Pages_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //Get All PAge from 'admin_pages' Table
    public function index()
    {
        $query = $this->db->get_where('admin_pages', array('status' => '1'));
        $result = $query->result_array();
        return $result;
    }

    //Get Single Page Detail from admin_pages Table
    public function get_page($id)
    {
        $query = $this->db->get_where('admin_pages', array('id' => $id));
        $result = $query->row_array();
        return $result;
    }

    //Update Home Page Details
    public function edit_page($id, $title, $desc)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'title' => $title,
            'description' => $desc,
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('admin_pages', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Get Home Page Slider Images
    public function Slider()
    {
        $query = $this->db->get_where('sliders', array('status' => 1));
        $result = $query->result_array();
        return $result;
    }

    //Get Single Home Page Slider Images
    public function get_Slider($id)
    {
        $query = $this->db->get_where('sliders', array('id' => $id, 'status' => '1'));
        $result = $query->row_array();
        return $result;
    }

    //Add Home Page Slider Iamge
    public function add_slider_image($title, $desc, $image)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'title' => $title,
            'description' => $desc,
            'image' => $image,
            'created_date' => $date,
            'updated_date' => $date,
        );

        $this->db->insert('sliders', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    public function edit_slider_image($id, $title, $desc, $image)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'title' => $title,
            'description' => $desc,
            'image' => $image,
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('sliders', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Delete Slider Image or Data
    public function Delete_Slider_Image($id)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'status' => "0",
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('sliders', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Get Faq's
    public function Faqs()
    {
        $query = $this->db->get_where('faqs', array('status' => 1));
        $result = $query->result_array();
        return $result;
    }

    //Get Single Faq
    public function get_faq($id)
    {
        $query = $this->db->get_where('faqs', array('id' => $id, 'status' => '1'));
        $result = $query->row_array();
        return $result;
    }

    //Add Faq
    public function add_faq($question, $answer)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'question' => $question,
            'answer' => $answer,
            'created_date' => $date,
            'updated_date' => $date,
        );

        $this->db->insert('faqs', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Edit Faq
    public function edit_Faq($id, $question, $answer)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'question' => $question,
            'answer' => $answer,
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('faqs', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Delete FAQ
    public function Delete_Faq($id)
    {
        # code...
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'status' => "0",
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('faqs', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

    //Get All Ads
    public function Ads()
    {
        $query = $this->db->get_where('ads', array('status >=' => 1));
        $result = $query->result_array();
        return $result;
    }
    //Get All Ads
    public function get_Ads($id)
    {
        $query = $this->db->get_where('ads', array('id' => $id));
        $result = $query->row_array();
        return $result;
    }

    //Edit Ads
    public function edit_Ads($id, $title, $description, $price, $image)
    {
        $date = date('Y-m-d H:i:s');

        // Start Transaction
        $this->db->trans_start();

        $data = array(
            'title' => $title,
            'description' => $description,
            'image' => $image,
            'price' => $price,
            'updated_date' => $date,
        );

        $this->db->where('id', $id);

        $this->db->update('ads', $data);

        // End Transaction
        $this->db->trans_complete();

        return true;
    }

}