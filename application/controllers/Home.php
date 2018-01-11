<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->model('Products_Model');
	}

	public function index()
	{
        //Get Product for Home Screen
        $this->data['products'] = $products = $this->Products_Model->index();

		$this->render('home/index');
	}


}
