<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
// About Page
	public function index()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('About', 'About');

		$this->data['page_description'] = 'About';

		$this->render('frontend/about');
	}

//  Faq Page
	public function faq()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('FAQ`s', 'About/faq');

		$this->data['page_description'] = 'FAQ`s';

		$this->render('frontend/faq');
	}

//Returns Page
	public function returns()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Returns', 'About/returns');

		$this->data['page_description'] = 'Returns';

		$this->render('frontend/returns');
	}

//Terms Page
	public function terms()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Terms & Conditions', 'About/terms');

		$this->data['page_description'] = 'Terms & Conditions';

		$this->render('frontend/termandcondition');
	}

//Privacy & Policies Page
	public function policies()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Privacy & Policies', 'About/policies');

		$this->data['page_description'] = 'Privacy & Policies';

		$this->render('frontend/privacyandpolicies');
	}

//Sitemap Page
	public function sitemap()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Sitemap', 'About/sitemap');

		$this->data['page_description'] = 'Sitemap';

		$this->render('frontend/sitemap');
	}

//Sitemap Page
	public function service()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Customer Service', 'About/service');

		$this->data['page_description'] = 'Customer Service';

		$this->render('frontend/customservice');
	}

}
