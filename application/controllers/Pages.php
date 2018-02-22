<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->Model('Admin_Pages_Model');
	}
//About Page
	public function about()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Pages', 'About');

		//Get Page Description
		$this->data['about'] = $about = $this->Admin_Pages_Model->get_page(1);

		$this->data['page_description'] = 'About';

		$this->render('pages/about');
	}

//Faq Page
	public function faq()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('FAQ`s', 'Pages/faq');

		//Get Faq
		$this->data['faqs'] = $faqs = $this->Admin_Pages_Model->Faqs();

		$this->data['page_description'] = 'FAQ`s';

		$this->render('pages/faq');
	}

//Returns Page
	public function returns()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Returns', 'Pages/returns');

		$this->data['page_description'] = 'Returns';

		$this->render('pages/returns');
	}

//Terms Page
	public function terms()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Terms & Conditions', 'Pages/terms');

		//Get Page Description
		$this->data['data'] = $data = $this->Admin_Pages_Model->get_page(3);

		$this->data['page_description'] = 'Terms & Conditions';

		$this->render('pages/termandcondition');
	}

//Privacy & Policies Page
	public function policies()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Privacy & Policies', 'Pages/policies');

		$this->data['page_description'] = 'Privacy & Policies';

		$this->render('pages/privacyandpolicies');
	}

//Sitemap Page
	public function sitemap()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Sitemap', 'Pages/sitemap');

		$this->data['page_description'] = 'Sitemap';

		$this->render('pages/sitemap');
	}

//Sitemap Page
	public function service()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Customer Service', 'Pages/service');

		//Get Page Description
		$this->data['data'] = $data = $this->Admin_Pages_Model->get_page(5);

		$this->data['page_description'] = 'Customer Service';

		$this->render('pages/customservice');
	}

}
