<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Auth_Controller {

	function __construct()
	{
		parent::__construct();
		
		# User is not allowed in admin panel
		if($_SESSION['user_group'] == 'user')
		{
			redirect('/');
		}
	}

	public function index()
	{
		# Only admin can access this function 
		$this->access->admin_only();

		$this->render('dashboard/admin_dashboard');
	}
	
	# Admin dashboard
	public function admin()
	{
		# Only admin can access this function 
		$this->access->admin_only();

		$this->render('dashboard/admin_dashboard');
	}
	
	# User dashboard
	public function user()
	{
		$this->render('dashboard/user_dashboard');
	}
}
