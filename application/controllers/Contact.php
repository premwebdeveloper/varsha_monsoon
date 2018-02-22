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

        //Send Email
        if($this->input->post())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name','Name', 'trim|required');
            $this->form_validation->set_rules('phone','Phone', 'trim|required|numeric|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('email','Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('message','Meassage', 'trim|required');

            if($this->form_validation->run() == TRUE)
            {
                $name = $this->input->post("name");
                $phone = $this->input->post("phone");
                $email = $this->input->post("email");
                $message = $this->input->post("message");

                //Send mail to Admin 
                $msg = '
                            Dear Sir/Maam,
                            '.$name.' is send message to Prem Tundwal.
                            Email Id : - '.$email.'. 
                            Phone No : - '.$phone.'. 
                            Message : - '.$message.'.
                            Thank You.
                    ';

                $this->load->library('email');

                $this->email->from('premtundwal@gmail.com', 'Prem Tundwal');
                $this->email->to('premsaini9602@gmail.com');

                $this->email->subject('Contact Message');
                $this->email->message($msg);

                if (!$this->email->send()) 
                {
                    $errors = $this->email->print_debugger();
                } 
                else 
                {                            
                    //INsert new email sent entry
                    //Add Message in Database
                	$add_contact_mail = $this->Admin_Pages_Model->contact_mail($name, $phone, $email, $message);
                	$_SESSION['message'] = 'Message Send Successfully.';

	                $this->session->mark_as_flash('message');
	                redirect('Contact');
                }
            }
        }

		$this->render('frontend/contact');
	}


}
