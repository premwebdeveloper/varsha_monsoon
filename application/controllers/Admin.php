<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->Model('Product_Model');
        $this->load->Model('Admin_Model');
    }

    // View All Slider
    public function slider()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashborad');
        $this->breadcrumbs->push('Sliders', 'Admin/slider');

        $this->data['page_description'] = 'Sliders';

        $this->data['sliders'] = $sliders = $this->Admin_Model->slider();

        $this->render('admin_user/slider');
    }

    public function addSlider()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Sliders', 'Admin/slider');
        $this->breadcrumbs->push('Add Slider', 'Admin/addSlider');

        $slider = array();

        if($this->input->post())
        {
            $slider['title'] = $title = $this->input->post("title");
            $slider['description'] = $description = $this->input->post("description");

            if(!empty($_FILES['image']['name']))
            {
                $path = "uploads/slider";

                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }

                $config['upload_path']   = $path;
                $config['allowed_types'] = 'bmp|jpg|png|jpeg';
                $config['max_size']      = 8000;

                // Set upload library
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('image'))
                {
                    $upload_error = array('error' => $this->upload->display_errors());
                    $_SESSION['message'] = $upload_error['error'];
                    $this->session->mark_as_flash('message');

                    redirect('Admin/addSlider');
                }
                else
                {
                    $success = $this->upload->data();
                    $slider['image'] = $image = $success['file_name'];

                    $addSlider = $this->Admin_Model->addSlider($slider);

                    $_SESSION['message'] = 'Slider Added Successfully.';

                    $this->session->mark_as_flash('message');

                    redirect('Admin/slider');
                }
            }
            else
            {
                $_SESSION['message'] = 'Please upload slider Image';

                $this->session->mark_as_flash('message');

                redirect('Admin/addSlider');
            }
        }

        $this->render('admin_user/addSlider');
    }

    // Delete Slider
    public function removeSlider()
    {
        $slider_id = $this->uri->segment(3);

        $removeSlider = $this->Admin_Model->removeSlider($slider_id);

        if($removeSlider)
        {
            $_SESSION['message'] = 'Slider deleted successfully.';

            $this->session->mark_as_flash('message');

            redirect('Admin/slider');
        }
    }

    // View All Offer
    public function offer()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashborad');
        $this->breadcrumbs->push('Offers', 'Admin/offer');

        $this->data['page_description'] = 'Offers';

        $this->data['offers'] = $offers = $this->Admin_Model->offer();

        $this->render('admin_user/offer');
    }

    // Add Offer
    public function addOffer()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Offers', 'Admin/offer');
        $this->breadcrumbs->push('Add Offer', 'Admin/addOffer');

        $offer = array();

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title','Title', 'trim|required');
            $this->form_validation->set_rules('price','Category', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $offer['title'] = $title = $this->input->post("title");
                $offer['price'] = $price = $this->input->post("price");
                $offer['description'] = $description = $this->input->post("description");

                if(!empty($_FILES['image']['name']))
                {
                    $path = "uploads/offer";

                    if(!file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $config['upload_path']   = $path;
                    $config['allowed_types'] = 'bmp|jpg|png|jpeg';
                    $config['max_size']      = 8000;

                    // Set upload library
                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('image'))
                    {
                        $upload_error = array('error' => $this->upload->display_errors());
                        $_SESSION['message'] = $upload_error['error'];
                        $this->session->mark_as_flash('message');

                        redirect('Admin/addOffer');
                    }
                    else
                    {
                        $success = $this->upload->data();
                        $offer['image'] = $image = $success['file_name'];

                        $addOffer = $this->Admin_Model->addOffer($offer);

                        $_SESSION['message'] = 'Offer Added Successfully.';

                        $this->session->mark_as_flash('message');

                        redirect('Admin/offer');
                    }
                }
                else
                {
                    $_SESSION['message'] = 'Please upload offer Image';

                    $this->session->mark_as_flash('message');

                    redirect('Admin/addOffer');
                }
            }
        }

        $this->render('admin_user/addOffer');
    }

    // Delete Offer
    public function removeOffer()
    {
        $offer_id = $this->uri->segment(3);

        $removeOffer = $this->Admin_Model->removeOffer($offer_id);

        if($removeOffer)
        {
            $_SESSION['message'] = 'Offer deleted successfully.';

            $this->session->mark_as_flash('message');

            redirect('Admin/offer');
        }
    }


    //Add Food Type
    /*

    //Edit Food Type
    public function edit_food_category()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Categories', 'Admin/food_category');
        $this->breadcrumbs->push('Edit Category', 'Admin/edit_food_category');
        $id = $this->uri->segment(3);

        if($this->input->post())
        {
            $id = $this->input->post("food_category_id");
        }

        //Get food type for edit
        $this->data['food_category'] = $food_category = $this->Admin_Model->food_category($id);

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('type','Type', 'trim|required');
            $this->form_validation->set_rules('category','Category', 'trim|required');
            $this->form_validation->set_rules('desc','Description', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $type = $this->input->post("type");
                $category = $this->input->post("category");
                $desc = $this->input->post("desc");
                $food_category_id = $this->input->post("food_category_id");

                //Check Image is Upload or not

                if(!empty($_FILES['image']['name']))
                {
                    $path = "uploads/food_category";

                    if(!file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $config['upload_path'] = $path;
                    $config['allowed_types']        = 'bmp|jpg|png|jpeg';
                    $config['max_size']             = 512;

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
                          'maintain_ratio'  =>  TRUE,
                          'quality'         =>  '100%',
                          'width'           =>  600,
                          'height'          =>  500,
                        );
                        $this->image_lib->clear();
                        $this->image_lib->initialize($configer);
                        $this->image_lib->resize();
                    }
                }
                else
                {
                    $image = $food_category['image'];
                }

                //Add Food Type
                $add_type = $this->Admin_Model->edit_food_category($food_category_id, $type, $desc, $category, $image);

                $_SESSION['message'] = 'Food Type Updated Successfully.';
                $this->session->mark_as_flash('message');
                redirect('Admin/food_category');

            }
            else
            {
                $this->render('admin_user/add_food_category');
            }
        }

        $this->render('admin_user/edit_food_category');

    }

    //Delete Food Type
    public function delete_food_category()
    {
        $id = $this->uri->segment(3);
        $change = $this->Admin_Model->delete_food_category($id);
        $this->session->set_flashdata('message', 'Food Type Deleted Successfully.');
        redirect("Admin/food_category");
    }

    public function blogs()
    {
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Blogs', 'Blog');

        $this->data['page_description'] = 'Blogs';

        $this->data['blogs'] = $blogs = $this->Blog_Model->index();

        $this->render('admin_user/blogs');

    }

    //View Blog
    public function view_blog()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Blogs', 'Admin/blogs');
        $this->breadcrumbs->push('View Blog', 'Admin/view_blog');

        $this->data['page_description'] = 'Blogs';

        $id = $this->uri->segment(3);

        $this->data['blog'] = $blog = $this->Blog_Model->view($id);

        $this->render('admin_user/view_blog');
    }

    //Add Blog
    public function add_blog()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Blogs', 'Admin/blogs');
        $this->breadcrumbs->push('Add Blog', 'Admin/add_blog');

        $this->data['page_description'] = 'Blogs';

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('category','Category', 'trim|required');
            $this->form_validation->set_rules('title','Title', 'trim|required');
            $this->form_validation->set_rules('desc','Description', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $desc = $this->input->post("desc");
                $title = $this->input->post("title");
                $category = $this->input->post("category");

                //Check Image is Upload or not
                if(!empty($_FILES['image']['name']))
                {
                    $path = "uploads/blog";

                    if(!file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $config['upload_path'] = $path;
                    $config['allowed_types']        = 'bmp|jpg|png|jpeg';
                    $config['max_size']             = 2048;

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
                          'maintain_ratio'  =>  TRUE,
                          'quality'         =>  '100%',
                          'width'           =>  870,
                          'height'          =>  370,
                        );
                        $this->image_lib->clear();
                        $this->image_lib->initialize($configer);
                        $this->image_lib->resize();
                    }
                }
                else
                {
                    $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                    redirect($redirect_to);
                }

                //Add Food Type
                $add_blog = $this->Admin_Model->add_blog($desc, $title, $category, $image);

                $_SESSION['message'] = 'Blog Added Successfully.';

                $this->session->mark_as_flash('message');

                redirect('Admin/add_blog');

            }
            else
            {
                $this->render('admin_user/add_blog');
            }
        }

        $this->render('admin_user/add_blog');
    }

    //Edit Blog
    public function edit_blog()
    {
        $this->load->model('Blog_Model');
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Blogs', 'Admin/blogs');
        $this->breadcrumbs->push('Edit Blog', 'Admin/edit_blog');
        $this->data['page_description'] = 'Blogs';

        $id = $this->uri->segment(3);

        if($this->input->post())
        {
            $id = $this->input->post("blog_id");
        }

        //Get food type for edit
        $this->data['blog'] = $blog = $this->Blog_Model->view($id);

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('category','Category', 'trim|required');
            $this->form_validation->set_rules('title','Title', 'trim|required');
            $this->form_validation->set_rules('desc','Description', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $desc = $this->input->post("desc");
                $title = $this->input->post("title");
                $category = $this->input->post("category");

                //Check Image is Upload or not
                if(!empty($_FILES['image']['name']))
                {
                    $path = "uploads/blog";

                    if(!file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }

                    $config['upload_path'] = $path;
                    $config['allowed_types']        = 'bmp|jpg|png|jpeg';
                    $config['max_size']             = 2048;

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
                          'maintain_ratio'  =>  TRUE,
                          'quality'         =>  '100%',
                          'width'           =>  870,
                          'height'          =>  370,
                        );
                        $this->image_lib->clear();
                        $this->image_lib->initialize($configer);
                        $this->image_lib->resize();
                    }
                }
                else
                {
                    $image = $blog['image'];
                }

                //Add Food Type
                $edit_blog = $this->Admin_Model->edit_blog($id, $desc, $title, $category, $image);

                $_SESSION['message'] = 'Blog Updated Successfully.';

                $this->session->mark_as_flash('message');

                redirect('Admin/blogs');

            }
            else
            {
                $this->render('admin_user/edit_blog');
            }
        }

        $this->render('admin_user/edit_blog');
    }

    //Delete Blog
    public function delete_blog()
    {
        $id = $this->uri->segment(3);

        $delete_blog = $this->Admin_Model->delete_blog($id);

        $this->session->set_flashdata('message', 'Blog Deleted Successfully.');

        redirect("Admin/blogs");
    }*/
}