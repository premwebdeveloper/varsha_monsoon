<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        //Load Product Model
        $this->load->model('Food_Listing_Model');
        //Get Product for Home Screen
        $this->data['listing'] = $listing = $this->Food_Listing_Model->Listings();
		$this->render('home/index');
	}


}
