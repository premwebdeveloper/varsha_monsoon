<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Contact', 'Contact');

        $this->data['page_description'] = 'Contact';

		$this->render('frontend/contact');
	}


}
