<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Sub_Categories extends Auth_Controller
{
    // Parent Construct function
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Sub_Categories_Model');
        $this->load->Model('Categories_Model');
    }

    public function index()
    {
        $this->data['sub_categories'] = $sub_categories = $this->Sub_Categories_Model->index();

        $this->render('sub_categories/index');
    }

    // Add new address
    public function add_sub_category()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('category', 'Category', 'required|trim');

            $subcategory = array();

            if($this->form_validation->run() === true)
            {
                $subcategory['name'] = $name = $this->input->post('name');
                $subcategory['category'] = $category = $this->input->post('category');

                // Add new address
                $add = $this->Sub_Categories_Model->add_sub_category($subcategory);

                if($add)
                {
                    $this->session->set_flashdata('message', 'Sub Category added successfully.');
                }
                else
                {
                    $this->session->set_flashdata('message', 'Something went wrong.');
                }
                redirect('Sub_Categories');
            }
        }

        //  Get All categories
        $this->data['categories'] = $categories = $this->Categories_Model->index();

        $this->render('sub_categories/insert');
    }

    // Delete user address
    public function deleteSubCategory()
    {
        $sub_category_id = $this->uri->segment(3);

        $delete = $this->Sub_Categories_Model->deleteSubCategory($sub_category_id);

        if($delete)
        {
            $this->session->set_flashdata('message', 'Sub Category deleted successfully.');
        }
        else
        {
            $this->session->set_flashdata('message', 'Something went wrong.');
        }
        redirect('Sub_Categories');
    }
}