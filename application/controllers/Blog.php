<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Blog_Model');
	}

    public function index()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Blogs', 'Blog');

        $this->data['page_description'] = 'Blogs';

        $this->data['blogs'] = $blogs = $this->Blog_Model->index();


        $this->render('blogs/index');
    }

    //View Blog
	public function view()
	{
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Blogs', 'Blog');

        $this->data['page_description'] = 'Blogs';

        $id = $this->uri->segment(3);

        $this->data['blog'] = $blog = $this->Blog_Model->view($id);

		$this->render('blogs/view');
	}
}
