<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Categories extends Auth_Controller
{
    // Parent Construct function
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Categories_Model');
    }

    public function index()
    {
        $user_id = $this->access->get_user_id();

        $this->data['categories'] = $categories = $this->Categories_Model->index();

        $this->render('categories/index');
    }

    // Add new address
    public function add_category()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');

            $category = array();

            if($this->form_validation->run() === true)
            {
                $category['name'] = $name = $this->input->post('name');

                // Add new address
                $add = $this->Categories_Model->add_category($category);

                if($add)
                {
                    $this->session->set_flashdata('message', 'Category added successfully.');
                }
                else
                {
                    $this->session->set_flashdata('message', 'Something went wrong.');
                }
                redirect('Categories');
            }
        }

        $this->render('categories/insert');
    }

    // Delete user address
    public function deleteCategory()
    {
        $category_id = $this->uri->segment(3);

        $delete = $this->Categories_Model->deleteCategory($category_id);

        if($delete)
        {
            $this->session->set_flashdata('message', 'Category deleted successfully.');
        }
        else
        {
            $this->session->set_flashdata('message', 'Something went wrong.');
        }
        redirect('Categories');
    }
}