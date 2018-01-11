<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	Protected $data = array();
	function __construct()
	{
		parent::__construct();
       /* $this->load->Model('Cart_Model');
        $this->load->Model('Product_Model');
		$this->load->Model('Food_Listing_Model');*/

		$this->data['page_title'] = 'Food Management System';
        $this->data['page_description'] = 'Food Management System';
        $this->data['copyright'] = date("Y") . ' © Food Management System.';

        // If logged in user is USER not admin
        /*if($this->ion_auth->logged_in())
        {
            $user_id = $this->access->get_user_id();

            $this->data['cart_items'] = $cart_items = $this->Cart_Model->cartProducts($user_id);

            $this->data['cart_item_count'] = count($cart_items);
        }*/
	}

	protected function render($the_view = NULL, $template = 'public_master')
    {
        if($template == 'json' || $this->input->is_ajax_request())
        {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        }
        elseif(is_null($template))
        {
            $this->load->view($the_view,$this->data);
        }
        else
        {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, TRUE);

			$this->load->view('templates/' . $template . '_view', $this->data);
        }
    }

}

include_once(APPPATH.'core/Auth_Controller.php');