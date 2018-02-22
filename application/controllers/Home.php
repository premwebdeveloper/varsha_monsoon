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
        //Load Product Model
        $this->load->model('Food_Listing_Model');
        $this->load->model('Admin_Pages_Model');
        $this->load->model('Brands_Model');

        //Get Product for Home Screen
        $this->data['products'] = $products = $this->Products_Model->index(null, $limit = 10);

        //Get Product for Home Screen
        $this->data['brands'] = $brands = $this->Brands_Model->index();

        //Get Images for Slider
        $this->data['slider'] = $slider = $this->Admin_Pages_Model->Slider();

        //Get ads
        $this->data['ads'] = $ads = $this->Admin_Pages_Model->Ads();

		$this->render('home/index');

	}


}
