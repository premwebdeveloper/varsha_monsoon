<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Brands extends Auth_Controller
{
    // Parent Construct function
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Brands_Model');
    }

    public function index()
    {
        $user_id = $this->access->get_user_id();

        $this->data['brands'] = $brands = $this->Brands_Model->index();

        $this->render('brands/index');
    }

    // Add new address
    public function add_brand()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');

            $brand = array();

            if($this->form_validation->run() === true)
            {
                $brand['name'] = $name = $this->input->post('name');

                // Add new address
                $add = $this->Brands_Model->add_brand($brand);

                if($add)
                {
                    $this->session->set_flashdata('message', 'Brand added successfully.');
                }
                else
                {
                    $this->session->set_flashdata('message', 'Something went wrong.');
                }
                redirect('Brands');
            }
        }

        $this->render('brands/insert');
    }

    // Delete user address
    public function deleteBrand()
    {
        $brand_id = $this->uri->segment(3);

        $delete = $this->Brands_Model->deleteBrand($brand_id);

        if($delete)
        {
            $this->session->set_flashdata('message', 'Brand deleted successfully.');
        }
        else
        {
            $this->session->set_flashdata('message', 'Something went wrong.');
        }
        redirect('Brands');
    }
}