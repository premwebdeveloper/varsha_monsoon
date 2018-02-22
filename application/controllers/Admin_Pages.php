<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin_Pages extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Admin_Pages_Model');
    }

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////
     /////////////////////////////////////////All Home More Pages Function //////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function index()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Home Pages', 'Admin_Pages/about');
        $this->data['admin_pages'] = $admin_pages = $this->Admin_Pages_Model->index();

        $this->render('admin_pages/index');
    }

    //Edit Pages
    public function edit_pages()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Pages', 'Admin_Pages');
        $this->breadcrumbs->push('Edit Page', 'Admin_Pages/edit_pages');

        $id = $this->uri->segment(3);

        //Get food type for edit
        $this->data['page'] = $page = $this->Admin_Pages_Model->get_page($id);

        if($this->input->post())
        {
            if($this->input->post())
            {
                $id = $this->input->post("page_id");
            }

            $this->load->library('form_validation');
            $this->form_validation->set_rules('desc','Description', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $title = $this->input->post("title");
                $desc = $this->input->post("desc");

                //Update Page Data
                $edit_page = $this->Admin_Pages_Model->edit_page($id, $title, $desc);

                $_SESSION['message'] = 'Page Updated Successfully.';

                $this->session->mark_as_flash('message');

                redirect('admin_pages');

            }
        }

        $this->render('admin_pages/edit_pages');
    }

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////
     /////////////////////////////////////////Home Page Slider Functions/////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Home Page Slider
    public function slider()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Slider', 'Admin_Pages/slider');

        $this->data['slider'] = $slider = $this->Admin_Pages_Model->Slider();

        $this->render('admin_pages/slider');
    }

    //Add Slider Image
    public function add_slider_image()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Slider', 'Admin_Pages/slider');
        $this->breadcrumbs->push('Add Slider', 'Admin_Pages/add_slider_image');

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $desc = $this->input->post("desc");
            $title = $this->input->post("title");

            //Check Image is Upload or not
            if(!empty($_FILES['image']['name']))
            {
                $path = "frontend_assets/img";

                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }

                $config['upload_path']  = $path;
                $config['allowed_types']= 'bmp|jpg|png|jpeg';
                $config['max_size']     = 1024 * 6;

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

            //Add Food Type
            $add_blog = $this->Admin_Pages_Model->add_slider_image($title, $desc, $image);

            $_SESSION['message'] = 'Slider Image Added Successfully.';

            $this->session->mark_as_flash('message');

            redirect('Admin_Pages/slider');
        }

        $this->render('admin_pages/add_slider_image');
    }

    //Edit Slider Image
    public function edit_slider_image()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Slider', 'Admin_Pages/slider');
        $this->breadcrumbs->push('Edit Slider', 'Admin_Pages/edit_slider_image');

        $id = $this->uri->segment(3);

        $this->data['slider_image'] = $slider_image = $this->Admin_Pages_Model->get_Slider($id);

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $desc = $this->input->post("desc");
            $title = $this->input->post("title");
            $id = $this->input->post('id');


            //Check Image is Upload or not
            if(!empty($_FILES['image']['name']))
            {
                $path = "frontend_assets/img";

                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }

                $config['upload_path']  = $path;
                $config['allowed_types']= 'bmp|jpg|png|jpeg';
                $config['max_size']     = 1024 * 6;

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
                $image = $this->input->post('slider_image');
                if(!$image)
                {
                    $_SESSION['message'] = "Please Upload Slider Image";
                    $this->session->mark_as_flash('message');
                    $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                    redirect($redirect_to);
                }
            }

            //Add Food Type
            $add_blog = $this->Admin_Pages_Model->edit_slider_image($id, $title, $desc, $image);

            $_SESSION['message'] = 'Slider Image Updated Successfully.';

            $this->session->mark_as_flash('message');

            redirect('Admin_Pages/slider');
        }

        $this->render('admin_pages/edit_image_slider');
    }

    //Delete Slider Image
    public function delete_slider_image($value='')
    {
        $slider_id = $this->uri->segment(3);

        $this->db->trans_begin();

        $update_slider = $this->Admin_Pages_Model->Delete_Slider_Image($slider_id);

        $this->db->trans_commit();

        $message = "Slider Image Deleted Successfully.";
        $redirect = "Admin_Pages/slider";

        if($update_slider)    # If the status updated successfully
        {
            $this->session->set_flashdata('message', $message);
        }
        else    # If the status not updated successfully
        {
            $this->session->set_flashdata('message', 'Something went wrong.');
        }

        redirect($redirect);
    }

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////
     ////////////////////////////////////////////////Faq's Function//////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Get all Faq's
    public function faqs()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('FAQ'."'S", 'Admin_Pages/faqs');

        $this->data['faqs'] = $faqs = $this->Admin_Pages_Model->Faqs();

        $this->render('admin_pages/faqs');
    }

    //Add Faq's
    public function add_faq()
    {
       $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('FAQ'."'S", 'Admin_Pages/faqs');
        $this->breadcrumbs->push('Add FAQ'."'S", 'Admin_Pages/add_faqs');

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('question','Question', 'trim|required');
            $this->form_validation->set_rules('answer','Answer', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $question = $this->input->post("question");
                $answer = $this->input->post("answer");

                //Add Food Type
                $add_faq = $this->Admin_Pages_Model->add_faq($question, $answer);

                $_SESSION['message'] = 'Faq Added Successfully.';

                $this->session->mark_as_flash('message');
            }

            redirect('Admin_Pages/faqs');
        }

        $this->render('admin_pages/add_faq');
    }
    //Edit Faq's
    public function edit_faq()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('FAQ'."'S", 'Admin_Pages/faqs');
        $this->breadcrumbs->push('Edit FAQ', 'Admin_Pages/edit_faq');

        $id = $this->uri->segment(3);

        $this->data['faq'] = $faq = $this->Admin_Pages_Model->get_faq($id);

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('question','Question', 'trim|required');
            $this->form_validation->set_rules('answer','Answer', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $question = $this->input->post("question");
                $answer = $this->input->post("answer");
                $id = $this->input->post('id');

                //Add Food Type
                $edit_faq = $this->Admin_Pages_Model->edit_Faq($id, $question, $answer);

                $_SESSION['message'] = 'Faq Updated Successfully.';

                $this->session->mark_as_flash('message');

                redirect('Admin_Pages/faqs');
            }
        }

        $this->render('admin_pages/edit_faq');
    }

    //Delete Faq
    public function delete_faq()
    {
        $id = $this->uri->segment(3);

        $this->db->trans_begin();

        $update_faq = $this->Admin_Pages_Model->Delete_Faq($id);

        $this->db->trans_commit();

        $message = "Faq Deleted Successfully.";
        $redirect = "Admin_Pages/faqs";

        if($update_faq)    # If the status updated successfully
        {
            $this->session->set_flashdata('message', $message);
        }
        else    # If the status not updated successfully
        {
            $this->session->set_flashdata('message', 'Something went wrong.');
        }

        redirect($redirect);
    }

      ////////////////////////////////////////////////////////////////////////////////////////////////////////////
     //////////////////////////////////////////////Home Page Ads/////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////


    //Get All Ads
    public function ads()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Ads', 'Admin_Pages/ads');

        //Get ads
        $this->data['ads'] = $ads = $this->Admin_Pages_Model->Ads();

        $this->render('admin_pages/ads');
    }

    //Get Ads Details
    public function get_ads($id)
    {
        # code...
    }

    //Edit Ads by Admin
    public function edit_ads()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Ads', 'Admin_Pages/ads');
        $this->breadcrumbs->push('Edit Ads', 'Admin_Pages/edit_ads');

        $id = $this->uri->segment(3);

        $this->data['ads'] = $ads = $this->Admin_Pages_Model->get_Ads($id);

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $title = $this->input->post("title");
            $description = $this->input->post("description");
            $price = $this->input->post("price");
            $id = $this->input->post('id');

            //Check Image is Upload or not
            if(!empty($_FILES['image']['name']))
            {
                $path = "frontend_assets/img";

                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }

                $config['upload_path']  = $path;
                $config['allowed_types']= 'bmp|jpg|png|jpeg';
                $config['max_size']     = 1024 * 2;

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
                      'quality'         =>  '100%',
                    );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();
                }
            }
            else
            {
                $image = $this->input->post('slider_image');
                if(!$image)
                {
                    $_SESSION['message'] = "Please Upload Slider Image";
                    $this->session->mark_as_flash('message');
                    $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                    redirect($redirect_to);
                }
            }

            //Add Food Type
            $edit_ads = $this->Admin_Pages_Model->edit_Ads($id, $title, $description, $price, $image);

            $_SESSION['message'] = 'Ads Updated Successfully.';

            $this->session->mark_as_flash('message');

            redirect('Admin_Pages/ads');
        }

        $this->render('admin_pages/edit_ads');
    }
}