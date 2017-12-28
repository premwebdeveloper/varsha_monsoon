<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Admin extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Product_Model');
        $this->load->Model('Admin_Model');
    }

    //Get Food Types for admin
    public function food_category()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashborad');
        $this->breadcrumbs->push('Food Categories', 'Admin/food_category');

        //$this->data['page_description'] = 'All Product';

        $this->data['food_category'] = $food_category = $this->Product_Model->product_category();

        $this->render('admin_user/food_category');
    }

    //Add Food Type
    public function add_food_category()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Categories', 'Admin/food_category');
        $this->breadcrumbs->push('Add Category', 'Admin/add_food_category');

        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('type_category','Category', 'trim|required');
            $this->form_validation->set_rules('type','Type', 'trim|required');
            $this->form_validation->set_rules('desc','Description', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $desc = $this->input->post("desc");
                $type = $this->input->post("type");
                $type_category = $this->input->post("type_category");
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
                    $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                    redirect($redirect_to);
                }

                //Add Food Type
                $add_type = $this->Admin_Model->add_food_category($desc, $type, $type_category, $image);

                $_SESSION['message'] = 'Food Type Added Successfully.';

                $this->session->mark_as_flash('message');

                redirect('Admin/food_category');

            }
            else
            {
                $this->render('admin_user/add_food_category');
            }
        }
        $this->render('admin_user/add_food_category');
    }

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
    }
}