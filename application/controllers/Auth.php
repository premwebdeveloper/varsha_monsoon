<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->Model('Users_Model');
		$this->load->Model('App_Model');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	// redirect if needed, otherwise display the user list
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			//list the users
			$this->data['users'] = $this->ion_auth->users()->result();
			foreach ($this->data['users'] as $k => $user)
			{
				$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}

			$this->_render_page('auth/index', $this->data);
		}
	}

	// log the user in
	public function login()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Login', 'Auth/login');

		$this->data['page_description'] = 'Login';

		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page

				$_SESSION['user_id'] = $this->ion_auth->get_user_id();

				$_SESSION['user_full_name'] = $this->ion_auth->user()->row()->first_name;

				// If cart session is set then cart products insert in cart table
				if(isset($_SESSION['cart_value']))
				{
					$this->load->Model('Cart_Model');

					foreach($_SESSION['cart_value'] as $cart)
					{
						// Already products in cart
						$cart_products = $this->Cart_Model->cart($_SESSION['user_id']);

						$product_in_cart = array();
						$p = 0;
						// If the product is already is in cart table then update quantity only
						foreach($cart_products as $item)
						{
							$product_in_cart[$p] = $item['product_id'];
							$p++;
						}

						if(!in_array($cart['product_id'], $product_in_cart))
						{
							$add_cart = $this->Cart_Model->add_cart($_SESSION['user_id'], $cart['product_id'], $cart['quantity']);
						}
						else
						{
							$pro_quantity = $this->Cart_Model->cart($_SESSION['user_id'], $cart['product_id']);

							$original_quantity = $pro_quantity['quantity'] + $cart['quantity'];
							$update_cart = $this->Cart_Model->update_cart($pro_quantity['id'], $original_quantity);
						}
					}
				}

				// Unset the cart session
				unset($_SESSION['cart_value']);

				if ($this->ion_auth->is_admin())
				{
					$_SESSION['user_group'] = "admin";
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('Dashboard/admin', 'refresh');
				}
				elseif ($this->ion_auth->in_group("user"))
				{
					$_SESSION['user_group'] = "user";
					redirect('/', 'refresh');
					/* $this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('Dashboard/user', 'refresh');	 */
				}
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			//$this->_render_page('auth/login', $this->data);
			$this->render('auth/login');
		}
	}

	// log the user out
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('/', 'refresh');
	}

	// change password
	public function change_password()
	{
		/* $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required'); */

		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();
		$user->id;


		/* if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name'    => 'new',
				'id'      => 'new',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'id'      => 'new_confirm',
				'type'    => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('auth/change_password', $this->data);
		}
		else
		{ */

		$identity = $this->session->userdata('identity');
		if(strlen($new_pass) >= 8)
		{
			$change = $this->ion_auth->change_password($identity, $old_pass, $new_pass);
		}
		else
		{
			echo 2;
			exit;
		}

		if ($change)
		{
			echo 1;
			// if the password was successfully changed
			// $this->session->set_flashdata('message', $this->ion_auth->messages());
			// $this->logout();
			exit;
		}
		else
		{
			echo 0;
			// $this->session->set_flashdata('message', $this->ion_auth->errors());
			// redirect('auth/change_password', 'refresh');
		}

		/* }  */
	}

	// forgot password
	public function forgot_password()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Forgot Password', 'Auth/forgot_password');

		$this->data['page_description'] = 'Forgot Password';

		// setting validation rules by checking whether identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->render('auth/forgot_password');
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity))
			{

        		if($this->config->item('identity', 'ion_auth') != 'email')
            	{
            		$this->ion_auth->set_error('forgot_password_identity_not_found');
            	}
            	else
            	{
            	   $this->ion_auth->set_error('forgot_password_email_not_found');
            	}

                $this->session->set_flashdata('message', $this->ion_auth->errors());
        		redirect("auth/forgot_password", 'refresh');
    		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				//$this->_render_page('auth/reset_password', $this->data);
				$this->render('auth/reset_password');
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	public function activate_account()
	{
		$this->data['csrf'] = $csrf = $this->_get_csrf_nonce();

		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('registered_email', 'Email', 'required|trim|valid_email');

			if($this->form_validation->run() === true)
			{
				$email = $this->input->post('registered_email');

				$hostname = $_SERVER["HTTP_HOST"];

				// Check hostname and append accordingly
				if(strpos($hostname, "localhost")===false)
				{
					$hostname = "http://" . $hostname . "/food_management/trunk/";
				}
				else
				{
					$hostname = "http://" . $hostname . "/food_management/";
				}

				$get_user = $this->App_Model->getUserByEmail($email);

				if(!empty($get_user))
				{
					$user_id = $get_user['id'];

					$activation_code = sha1(md5(microtime()));

					$url = $hostname ."auth/activate/".$user_id."@".$activation_code;

			    	$message = "To verify email <a href='".$url."'>Click Here</a>";

			    	$subject = "Verify email to activate your account.";

			    	$sendEmail = $this->send_email->sendEmail($email, $message, $subject);

			    	if($sendEmail)
			    	{
			    		$date = date('Y-m-d');

			    		$additional_data = array('activation_code' => $activation_code, 'updated_on' => $date);

						# Update Email id in users table
						$update_user = $this->ion_auth->update($user_id, $additional_data);

						if($update_user)
						{
							$this->session->set_flashdata('message', 'Please verify your email.');
							redirect("auth/activate_account", 'refresh');
						}
						else
						{
							return false;
						}
			    	}
				}
				else
				{
					$this->session->set_flashdata('message', 'This email is not registered.');
					redirect("auth/activate_account", 'refresh');

				}
			}
		}

		$this->render('auth/activate_account');

	}

	// activate the user
	public function activate($id, $code=false)
	{
		$temp = explode('@', $id);
		$id = $temp[0];
		$code = $temp[1];

		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			$status = 1;
			$update_user_details = $this->Users_Model->active_inactive($id, $status);

			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/login", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth/deactivate_user', $this->data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	// create a new user
	public function create_user()
    {
    	// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Register User', 'Auth/create_user');

		$this->data['page_description'] = 'Register User';

        $this->data['title'] = $this->lang->line('create_user_heading');

        /* if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        } */

        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim|required|is_unique[' . $tables['users'] . '.phone]|min_length[10]|max_length[10]');
		$this->form_validation->set_rules('dob', $this->lang->line('create_user_validation_dob_label'), 'trim|required');
		$this->form_validation->set_rules('gender', $this->lang->line('create_user_validation_gender_label'), 'trim|required');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');

        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        $user_details = array();

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');

            # generate verify Token
            $this->load->helper('string');
			$verify_token = random_string('alnum',40);

			# make additional data to user table
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
                'verify_token' => $verify_token,
                'phone' => $this->input->post('phone'),
            );

            # Users Detail
            $user_details['email'] = $email;
            $user_details['fname'] = $this->input->post('first_name');
            $user_details['lname'] = $this->input->post('last_name');
            $user_details['phone'] = $this->input->post('phone');
            $user_details['dob'] = $this->input->post('dob');
            $user_details['gender'] = $this->input->post('gender');

			$group = array('2'); // Sets user group to User.

			# Register User
			$user_id = $this->ion_auth->register($identity, $password, $email, $additional_data, $group);

			# Get User Id
			$user_details['user_id'] = $user_id;

			# Create user in user_detais table
			$insert_user = $this->Users_Model->create_user($user_details);

			# If use create successfully
			if ($insert_user) {

				# If the user create successfully then send email to user's Email ID
				$email_sent = $this->verifyEmail($email, $verify_token);

				if($email_sent)
				{
					// check to see if we are creating the user
		            // redirect them back to the admin page
		            $message = 'Registered Successfully. But verify email to activate your account.';
		            $this->session->set_flashdata('message', $message);

				}
				else
				{
					$this->session->set_flashdata('message', 'Something went wrong !');
				}
				redirect("auth/create_user");

			}
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            //$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? //$this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $this->data['phone'] = array(
                'name'  => 'phone',
                'id'    => 'phone',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $this->data['gender'] = array(
                'name'  => 'gender',
                'id'    => 'gender',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('gender'),
            );
            $this->data['dob'] = array(
                'name'  => 'dob',
                'id'    => 'dob',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('dob'),
            );
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $this->data['password_confirm'] = array(
                'name'  => 'password_confirm',
                'id'    => 'password_confirm',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            //$this->_render_page('auth/create_user', $this->data);
			$this->render('auth/create_user');

        }
    }


    # Verify Email
    public function verifyEmail($email, $verify_token)
    {

    	$hostname = $_SERVER["HTTP_HOST"];

		// Check hostname and append accordingly
		if(strpos($hostname, "localhost")===false)
		{
			$hostname = "http://" . $hostname . "/food_management/trunk/";
		}
		else
		{
			$hostname = "http://" . $hostname . "/food_management/";
		}

		$url = $hostname ."auth/verifiedEmail/".$email."/".$verify_token;

    	$message = "To verify email <a href='".$url."'>Click Here</a>";

    	$subject = "Verify email to activate your account.";

    	$sendEmail = $this->send_email->sendEmail($email, $message, $subject);

    	if($sendEmail)
    	{
    		return true;
    	}
    }

    public function verifiedEmail()
    {
    	$email = $this->uri->segment(3);
    	$verify_token = $this->uri->segment(4);

    	$user_avail = $this->App_Model->verify_email($email, $verify_token);

    	if($user_avail)
    	{
    		$this->session->set_flashdata('message', 'Your account is activated. You can login now.');
    	}
    	else
    	{
    		$this->session->set_flashdata('message', 'Something went wrong !');
    	}
    	redirect("auth/login", 'refresh');
    }

	// edit a user
	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'company'    => $this->input->post('company'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('auth', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$this->data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		);
		$this->data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		);

		$this->_render_page('auth/edit_user', $this->data);
	}

	// create a new group
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth/create_group', $this->data);
		}
	}

	// edit a group
	public function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth/edit_group', $this->data);
	}


	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

	// Update password
	public function update_password()
	{
		$encrypted = $_SERVER['REQUEST_URI'];

		$temp = explode("update_password/", $encrypted);

		if(!empty($temp[1]))
		{
			$encrypted = $temp[1];

			$action = 'decrypt';

			$plaintext = encrypt_decrypt($action, $encrypted);

			$tempr = explode("|", $plaintext);

			$this->data['user_email'] = $user_email = $tempr[0];
			$this->data['user_id'] = $user_id = $tempr[1];
		}

		$this->render('auth/change_password');
	}

	// User login from checout page with angular without reload page
	public function user_login()
	{
		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
			$identity = $data->identity;
			$password = $data->password;

			$response = array();

			if (filter_var($identity, FILTER_VALIDATE_EMAIL))
			{
				if(strlen($password) >= 8)
				{
					$identity = strtolower($identity);
					// Call login function
					$this->logInWithEmailOrMobile($identity, $password);
				}
			}
			elseif(is_numeric($identity))
			{
				if (strlen($identity) == 10)
				{
					if(strlen($password) >= 8)
					{
						// Call login function
						$this->logInWithEmailOrMobile($identity, $password);
					}
				}
			}
			else
			{
				echo 0;
			}
		}
	}

	// Common function for login with email id and mobile number
	public function logInWithEmailOrMobile($identity, $password)
	{
		// Login with email id
		if ($this->ion_auth->login($identity, $password))
		{
			//if the login is successful
			$_SESSION['user_id'] = $user_id = $this->ion_auth->get_user_id();

			$_SESSION['user_full_name'] = $user_full_name = $this->ion_auth->user()->row()->first_name ." ". $this->ion_auth->user()->row()->last_name;


			// If cart session is set then cart products insert in cart table
			if(isset($_SESSION['cart_value']))
			{
				$this->load->Model('Cart_Model');

				foreach($_SESSION['cart_value'] as $cart)
				{
					// Already products in cart
					$cart_products = $this->Cart_Model->cart($_SESSION['user_id']);

					$product_in_cart = array();
					$p = 0;
					// If the product is already is in cart table then update quantity only
					foreach($cart_products as $item)
					{
						$product_in_cart[$p] = $item['product_id'];
						$p++;
					}

					if(!in_array($cart['product_id'], $product_in_cart))
					{
						$add_cart = $this->Cart_Model->add_cart($_SESSION['user_id'], $cart['product_id'], $cart['quantity']);
					}
					else
					{
						$pro_quantity = $this->Cart_Model->cart($_SESSION['user_id'], $cart['product_id']);

						$original_quantity = $pro_quantity['quantity'] + $cart['quantity'];
						$update_cart = $this->Cart_Model->update_cart($pro_quantity['id'], $original_quantity);
					}
				}
			}

			// Unset the cart session
			unset($_SESSION['cart_value']);

			if ($this->ion_auth->is_admin())
			{
				$_SESSION['user_group'] = $user_group = "admin";
			}
			elseif ($this->ion_auth->in_group("user"))
			{
				$_SESSION['user_group'] = $user_group = "user";
			}

			// Send response
			$response['user_id'] = $user_id;
			$response['user_full_name'] = $user_full_name;
			$response['user_group'] = $user_group;

			echo json_encode($response);
		}
		else
		{
			echo 0;
		}
	}

	// User registration during checkout page with angular js
	public function user_registration()
	{
		$this->load->Model('App_Model');

		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
			$email = $data->email;
			$email = strtolower($email);
			$mobile = $data->mobile;
			$password = $data->password;

			// Check Email is already exist
			$email_exist = $this->App_Model->getUserByEmail($email);

			// Check Mobile is already exist
			$mobile_exist = $this->App_Model->getUserByMobile($mobile);

			if(!empty($email_exist))
			{
				echo 5;
			}
			else
			{
				if(!empty($mobile_exist))
				{
					echo 6;
				}
				else
				{
					if (filter_var($email, FILTER_VALIDATE_EMAIL))
					{
						if(strlen($mobile) == 10)
						{
							if(strlen($password) >= 8)
							{
								# make additional data to user table
					            $additional_data = array(
					                'first_name' => 'Guest',
					                'last_name'  => 'User',
					                'phone' => $mobile,
					            );

					            # Users Detail
					            $user_details['email'] = $email;
					            $user_details['fname'] = 'Guest';
					            $user_details['lname'] = 'User';
					            $user_details['phone'] = $mobile;
					            $user_details['dob'] = '';
					            $user_details['gender'] = '';

								$group = array('2'); // Sets user group to User.

								# Register User
								$userID = $this->ion_auth->register($email, $password, $email, $additional_data, $group);

								# Get User Id
								$user_details['user_id'] = $userID;

								# Create user in user_detais table
								$insert_user = $this->Users_Model->create_user($user_details);

								echo 1;

								# If use create successfully
								if ($insert_user)
								{
									// After create user send sms on mobile for verify mobile number
									$otp = random_password();

									$msg = 'High Secuirity OTP Number for mobile number verification is '.$otp;
									$user_id = "9602947878";
									$password = "rj18ta0726";
									$sms_send = $this->send_sms->sms_send($user_id, $password, $mobile, $msg);

									foreach($sms_send as $response)
									{
										$response_status = $response['result'];
									}

									// If OTP sent on mobile
									if($response_status == 1)
									{
										$additional_data = array('mobile_otp' => $otp);

										# Update Email id in users table
										$update_user = $this->ion_auth->update($userID, $additional_data);
									}
								}
								//else { echo 0; }
							}
							else { echo 2; }
						}
						else { echo 3; }
					}
					else { echo 4; }
				}
			}
		}
	}

	// Mobile verification
	public function mobile_verification()
	{
		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
			$mobile_otp = $data->mobile_otp;
			$registered_mobile = $data->registered_mobile;

			$this->load->Model('App_Model');

			// Check Mobile is already exist
			$mobile_exist = $this->App_Model->getUserByMobile($registered_mobile);

			if(!empty($mobile_exist))
			{
				$sent_otp = $mobile_exist['mobile_otp'];
				$user_id = $mobile_exist['id'];

				if($sent_otp == $mobile_otp)
				{
					$additional_data = array('active' => 1, 'mobile_otp' => null);

					# Update mobile otp null in users table
					$update_user = $this->ion_auth->update($user_id, $additional_data);

					if($update_user)
					{
						$update_user_details = $this->Users_Model->active_inactive($user_id, 1);
					}

					echo 1;
				}
				else
				{
					echo 2;
				}
			}
			else
			{
				echo 0;
			}

			exit;
		}
	}
}
