<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Settings extends Auth_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Settings_Model');
        $this->load->library(array('ion_auth','form_validation'));
    }

    # Get All Users
    public function index()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Setting', 'Settings');

        $this->data['page_description'] = 'Settings';

        # Get All Users
        $this->data['users'] = $users = $this->Users_Model->get_user();

        // click on save button
        if(isset($_POST['saveUser']))
        {
            $user_uid = $this->input->post('user_uid');

            if(!empty($user_uid))
            {
                $_SESSION['user_uid'] = $user_uid;

                $current_url = $this->input->post('current_url');
                if(!empty($current_url))
                {
                    redirect($current_url);
                }
            }
            else
            {
                unset($_SESSION['user_uid']);
            }
        }

        // Click on clear button
        if(isset($_POST['clearUser']))
        {
            unset($_SESSION['user_uid']);
        }

        $this->render('settings/index');
    }

}