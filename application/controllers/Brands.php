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

                //Check Image is Upload or not
                if(!empty($_FILES['image']['name']))
                {
                    $path = "uploads/brand_image";

                    if(!file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $config['upload_path']  = $path;
                    $config['allowed_types']= 'bmp|jpg|png|jpeg';
                    $config['max_size']     = 1024 * 4;

                     // Set upload library
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('image'))
                    {
                        $upload_error = array('error' => $this->upload->display_errors());
                        $_SESSION['message'] = $upload_error['error'];
                        $this->session->mark_as_flash('message');
                        $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                        redirect($redirect_to);
                    }
                    else
                    {
                        $success = $this->upload->data();
                        $image = $success['file_name'];
                        // Crop Image Size
                        $configer =  array(
                          'image_library'   => 'gd2',
                          'source_image'    =>  $success['full_path'],
                          'maintain_ratio'  =>  FALSE,
                          'create_thumb'  =>  FALSE,
                          //'maintain_ratio'  =>  TRUE,
                          'quality'         =>  '100%',
                          'width'           =>  1200,
                          'height'          =>  1200,
                        );
                        $this->image_lib->clear();
                        $this->image_lib->initialize($configer);
                        $this->image_lib->resize();
                    }
                }
                else
                {
                    $_SESSION['message'] = "Please Upload Slider Image";
                    $this->session->mark_as_flash('message');
                    $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                    redirect($redirect_to);
                }

                $brand['image'] = $image;
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