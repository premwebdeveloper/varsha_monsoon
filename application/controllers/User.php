<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class User extends Auth_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->Model('Users_Model');
		$this->load->library(array('ion_auth','form_validation'));
	}

	# Get All Users
	public function index()
	{
		// Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('User', 'Users');

        $this->data['page_description'] = 'Users';

		# Get All Users
		$this->data['users'] = $users = $this->Users_Model->get_user();

		$this->render('admin_user/index');
	}

	# Get all inactive users
	public function inactive_users()
	{
		// Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Users', 'User');
        $this->breadcrumbs->push('In-Active Users', 'Users');

        $this->data['page_description'] = 'In-Active Users';

		# Get All Inactive Users
		$this->data['inactive_users'] = $inactive = $this->Users_Model->inactive_users();

		$this->render('admin_user/inactive_users');
	}

	# User View in admin console
	public function view()
	{
		$user_id = $this->access->get_user_id();

		$this->data['user'] = $user = $this->Users_Model->get_user($user_id);

		$this->render('admin_user/view');
	}

	# Disable user from admin console
	public function active_inactive()
	{
		$user_id = $this->access->get_user_id();

		$status = $this->uri->segment(4);

		$this->db->trans_begin();

			$additional_data = array('active' => $status);

			# Update status in users table
			$update_users = $this->ion_auth->update($user_id, $additional_data);

			# If the status updated in users table then update user_details table
			if($update_users)
			{
				$update_user_details = $this->Users_Model->active_inactive($user_id, $status);
			}

		$this->db->trans_commit();

		if($status == 0)
		{
			$message = "User inactive successfully.";
			$redirect = "User/";
		}
		else
		{
			$message = "User active successfully.";
			$redirect = "User/inactive_users";
		}

		if($update_user_details)	# If the status updated successfully
		{
			$this->session->set_flashdata('message', $message);
		}
		else	# If the status not updated successfully
		{
			$this->session->set_flashdata('message', 'Something went wrong.');
		}

		redirect($redirect);
	}

	# User Profile View
	public function profile()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Profile', 'user/profile');

		$this->data['page_description'] = 'Profile';

		$user_id = $this->access->get_user_id();

		$this->data['user_data'] = $user_data = $this->Users_Model->get_user($user_id);

		$this->data['fname'] = array(
			'name'  => 'fname',
			'id'    => 'fname',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('fname', $user_data['fname']),
		);
		$this->data['lname'] = array(
			'name'  => 'lname',
			'id'    => 'lname',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('lname', $user_data['lname']),
		);
		$this->data['gender'] = array(
			'name'  => 'gender',
			'id'    => 'gender',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('gender', $user_data['gender']),
		);
		$this->data['dob'] = array(
			'name'  => 'dob',
			'id'    => 'dob',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('dob', $user_data['dob']),
		);

		if($this->input->post())
		{
			$user = $this->ion_auth->user($user_id)->row();

			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$dob = $this->input->post('dob');
			$gender = $this->input->post('gender');
			$bio = $this->input->post('bio');

			$data = array(
				'fname' => $fname,
				'lname' => $lname,
				'dob' => $dob,
				'gender' => $gender,
				'bio' => $bio,
			);

			$data2 = array(
				'first_name' => $fname,
				'last_name' => $lname,
			);

			$this->ion_auth->update($user->id, $data2);

			$update = $this->Users_Model->edit($data);
			$_SESSION['user_full_name'] = $fname;
			redirect('user/profile');
		}

		$this->render('user/profile');
	}

	# User orders
	public function orders()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('My Order', 'user/orders');

		$this->data['page_description'] = 'My Order';

		$user_id = $this->access->get_user_id();

		$this->render('user/orders');
	}

	# User Payments
	public function payments()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Payments', 'user/payments');

		$this->data['page_description'] = 'Payments';

		$user_id = $this->access->get_user_id();

		$this->render('user/payments');
	}

	# User Wishliast
	public function wishlist()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Wishlist', 'user/wishlist');

		$this->data['page_description'] = 'Wishlist';

		$user_id = $this->access->get_user_id();

		$this->render('user/wishlist');
	}

	# User Reviews
	public function reviews()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Reviews', 'user/reviews');

		$this->data['page_description'] = 'Reviews';

		$user_id = $this->access->get_user_id();

		$this->render('user/reviews');
	}

	# User Cart
	public function cart()
	{
		// Add breadcrumbs
		// $this->breadcrumbs->push('Home', '/');
		// $this->breadcrumbs->push('Cart', 'user/cart');

		// $this->data['page_description'] = 'Cart';

		//$user_id = $this->access->get_user_id();

		$this->render('user/cart');
	}

	// Match Old Password
	public function match_old_password()
	{
		$old_password = $this->input->post("old_password");
		$hash = $this->ion_auth->user()->row()->password;
		if(password_verify($old_password, $hash))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	# Test anglar function
	public function changeEmail()
	{
		$this->load->helper('email');

		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
		 	$email_address = $data->email_address;

			if($email_address != '')
			{
				if(valid_email($email_address))
				{
				    //If this email is already exist
					$user = $this->ion_auth->where('email', $email_address)->users()->row();

					if($user)	# If this email is already exist
					{
						echo 1;
					}
					else
					{
						# Current user id
						$user_id = $this->access->get_user_id();

						$otp = random_password();

						$message = "High secuirity OTP Code is ".$otp."
									Thank You.";

				    	$subject = "Verify email to change your Email Address.";

				    	# Send email with High secuirity OTP Code
				    	$sendEmail = $this->send_email->sendEmail($email_address, $message, $subject);

				    	if($sendEmail == 1)		# If Email sent successfully
				    	{
				    		$additional_data = array('email_otp' => $otp);

							# Update Email id in users table
							$update_user = $this->ion_auth->update($user_id, $additional_data);
				    	}
				    	else 	# If Email sent Failed
				    	{
				    		echo 0;
				    	}
			    	}
				}
				else
				{
				        echo 2;
				}
			}
			else
			{
				echo -1;
			}
		}
	}

	// Verify Sent OTP and Filled OTP is same or not
	public function verify_otp_change_Email()
	{
		$user_id = $this->access->get_user_id();

		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
		 	$filled_otp = $data->filled_otp;
		 	$email_address = $data->email_address;

		 	$sent_otp = $this->ion_auth->user()->row()->email_otp;

		 	if($filled_otp == $sent_otp)
		 	{
		 		$additional_data = array('email_otp' => null, 'email' => $email_address, 'username' => $email_address);

		 		$update_users = $this->ion_auth->update($user_id, $additional_data);

		 		if($update_users)
		 		{
		 			$update_email = $this->Users_Model->update_email($user_id, $email_address);

		 			if($update_email)
		 			{
		 				echo 1;
		 			}
		 			else
		 			{
		 				echo 0;
		 			}
		 		}
		 		else
		 		{
		 			echo 0;
		 		}
		 	}
		 	else
		 	{
		 		echo 0;
		 	}
		}
	}

	# Send OTP on Email id
	public function sent_otp()
	{
		$this->load->helper('email');

		$email_id = $this->input->post("email_id");

		if($email_id)
		{
			if(valid_email($email_id))
			{
			    //check email is taken or not

				$user = $this->ion_auth->where('email', $email_id)->users()->row();

				if($user)
				{
					echo 1;
				}
				else
				{
					$user_id = $this->access->get_user_id();

					$otp = random_password();

					$message = "Email address change varification OTP is ".$otp."
								Thank You.";

			    	$subject = "Verify email to change your Email Address.";

			    	$sendEmail = $this->Send_email->sendEmail($email_id, $message, $subject);

			    	if($sendEmail == 1)
			    	{
			    		echo "$otp";
			    	}
			    	else
			    	{
			    		echo 0;
			    	}
		    	}
			}
			else
			{
			        echo 2;
			}
		}
		else
		{
			echo -1;
		}
	}

	// Resend OTP for update email id
	public function resend_edit_email_otp()
	{
		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
		 	$email_address = $data->email_address;

			if($email_address != '')
			{
				# Current user id
				$user_id = $this->access->get_user_id();

				$otp = random_password();

				$message = "High secuirity OTP Code is ".$otp."
							Thank You.";

		    	$subject = "Verify email to change your Email Address.";

		    	# Send email with High secuirity OTP Code
		    	$sendEmail = $this->send_email->sendEmail($email_address, $message, $subject);

		    	if($sendEmail == 1)		# If Email sent successfully
		    	{
		    		$additional_data = array('email_otp' => $otp);

					# Update Email id in users table
					$update_user = $this->ion_auth->update($user_id, $additional_data);

					echo 1;
		    	}
		    	else 	# If Email sent Failed
		    	{
		    		echo 0;
		    	}
			}
			else
			{
				echo -1;
			}
		}
		else
		{
			echo 0;
		}
	}

	//Check Password is Match or Not for change Email Address
	public function check_password()
	{
		$password = $this->input->post("password");

		$email = $this->input->post("email");

		$hash = $this->ion_auth->user()->row()->password;

		if(password_verify($password, $hash))
		{
			//update email id on users and user_details table

			$user_id = $this->access->get_user_id();

			$additional_data = array('email' => $email);

			# Update Email id in users table
			$update_user = $this->ion_auth->update($user_id, $additional_data);

			# Update Email id in users table

			if($update_user)
			{
				$update_user_details = $this->Users_Model->update_email($user_id, $email);
			}

			echo 1;
		}
		else
		{
			echo 0;
		}
	}

	//Send OTP by Mobile No.
	public function send_mobile_otp()
	{
		$userID = $this->access->get_user_id();

		$new_mobile = $this->input->post("new_mobile");

		// Get old mobile number
		$old_mobile = $this->ion_auth->user()->row()->phone;

		if($new_mobile == $old_mobile)
		{
			echo 2;
		}
		else
		{
			// Auto generate OTP
			$otp = random_password();

			$msg = 'High Secuirity OTP Number is '.$otp;
			$user_id = "9602947878";
			$password = "rj18ta0726";
			$sms_send = $this->send_sms->sms_send($user_id, $password, $new_mobile, $msg);

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

				// If OTP update in users table
				if($update_user)
				{
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
			else
			{
				echo 0;
			}
		}
	}

	// Resend OTP to new mobile number for update mobile number
	public function resend_mobile_otp()
	{
		$userID = $this->access->get_user_id();

		$new_mobile = $this->input->post("new_mobile");

		// Get old mobile number
		$old_mobile = $this->ion_auth->user()->row()->phone;

		if($new_mobile == $old_mobile)
		{
			echo 2;
		}
		else
		{
			// Auto generate OTP
			$otp = random_password();

			$msg = 'High Secuirity OTP Number is '.$otp;
			$user_id = "9602947878";
			$password = "rj18ta0726";
			$sms_send = $this->send_sms->sms_send($user_id, $password, $new_mobile, $msg);

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

				// If OTP update in users table
				if($update_user)
				{
					echo 1;
				}
				else
				{
					echo 0;
				}
			}
			else
			{
				echo 0;
			}
		}
	}

	// Verify OTP and Update new mobile number3
	public function verify_otp_mobile_update()
	{
		$userID = $this->access->get_user_id();

		$filled_otp = $this->input->post("filled_otp");
		$new_mobile = $this->input->post("new_mobile");

		$sent_otp = $this->ion_auth->user()->row()->mobile_otp;

		// If Sent OTP and filled OTP is same
		if($filled_otp == $sent_otp)
		{
			$additional_data = array('mobile_otp' => null, 'phone' => $new_mobile);

			# Update Email id in users table
			$update_user = $this->ion_auth->update($userID, $additional_data);

			// If mobile number is updated in users table
			if($update_user)
			{
				$update_mobile = $this->Users_Model->update_mobile($userID, $new_mobile);
				echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo 0;
		}
	}

	// Send High secuirity OTP code to user's email for deactivate user account
	public function deactivate_otp_send()
	{
		$user_id = $this->access->get_user_id();

		$email = $this->ion_auth->user()->row()->email;

		// Auto generate OTP
		$otp = random_password();

		$message = "High secuirity OTP for deactivate your account is ".$otp;

    	$subject = "Deactivate account.";

    	$sendEmail = $this->send_email->sendEmail($email, $message, $subject);
    	$sendEmail = 1;

    	if($sendEmail == 1)
    	{
    		$date = date('Y-m-d');

    		$additional_data = array('deactivate_acc_otp' => $otp, 'updated_on' => $date);

			# Update Email id in users table
			$update_user = $this->ion_auth->update($user_id, $additional_data);

			if($update_user)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
    	}
    	else
    	{
    		echo 0;
    	}
	}

	// Resend deactive account OTP code
	public function resend_deactive_otp()
	{
		$user_id = $this->access->get_user_id();

		$email = $this->ion_auth->user()->row()->email;

		// Auto generate OTP
		$otp = random_password();

		$message = "High secuirity OTP for deactivate your account is ".$otp;

    	$subject = "Deactivate account.";

    	$sendEmail = $this->send_email->sendEmail($email, $message, $subject);

    	if($sendEmail == 1)
    	{
    		$date = date('Y-m-d');

    		$additional_data = array('deactivate_acc_otp' => $otp, 'updated_on' => $date);

			# Update Email id in users table
			$update_user = $this->ion_auth->update($user_id, $additional_data);

			if($update_user)
			{
				echo 1;
			}
			else
			{
				echo 0;
			}
    	}
    	else
    	{
    		echo 0;
    	}
	}

	// Finally deactivate account
	public function finally_deactivate_account()
	{
		$user_id = $this->access->get_user_id();

		$data = json_decode(file_get_contents("php://input"));

		if(count($data) > 0)
		{
		 	$otp = $data->otp;
		 	$password = $data->password;

		 	$sent_otp = $this->ion_auth->user()->row()->deactivate_acc_otp;

		 	// If sent otp and filled otp is same
		 	if($sent_otp == $otp)
		 	{
		 		// Get user account password
		 		$hash = $this->ion_auth->user()->row()->password;

		 		// If user account password and filles password are same
				if(password_verify($password, $hash))
				{
					$date = date('Y-m-d');

					# Update Active status and deactivate otp code null for deactivate account in usrs
					$additional_data = array('active' => 2,'deactivate_acc_otp' => null, 'updated_on' => $date);

					$update_user = $this->ion_auth->update($user_id, $additional_data);

					// If user account deactivate from users table then disable user from user_details
					if($update_user)
					{
						$status = 2;
						$deactive_user = $this->Users_Model->active_inactive($user_id, $status);

						// Finally Deactivate account permanently
						if($deactive_user)
						{
							echo 1;
						}
						else
						{
							echo 0;
						}
					}
					else
					{
						echo 0;
					}
				}
				else
				{
					echo 3;
				}
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
	}

	//Change or upload Profile Image By User
	public function change_profile()
	{
		$user_id = $this->access->get_user_id();

		//Check Image is Upload or not
		if(!empty($_FILES['update_image']['name']))
		{
			$path = "uploads/users";

			if(!file_exists($path))
			{
				mkdir($path, 0777, true);
			}

			$config['upload_path'] = $path;
			$config['allowed_types']        = 'bmp|jpg|png|jpeg';
			$config['max_size']             = 512;

			// Set upload library
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('update_image'))
			{
				$upload_error = array('error' => $this->upload->display_errors());
				$_SESSION['error'] = $upload_error['error'];
				$this->session->mark_as_flash('success');
				$redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
				redirect($redirect_to);
			}
			else
			{
				$success = $this->upload->data();
				$image = $success['file_name'];

				// Crop Image Size
				$configer =  array(
				  'image_library'   => 'gd2',
				  'source_image'    =>  $success['full_path'],
				  'maintain_ratio'  =>  TRUE,
				);
				$this->image_lib->clear();
				$this->image_lib->initialize($configer);
				$this->image_lib->resize();
			}
		}
		else
		{
			$redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
			redirect($redirect_to);
		}

		$reslut = $this->Users_Model->upload_image($user_id, $image);

		if($reslut)
		{
			$_SESSION['success'] = "Profile image update Successfully.";
			$this->session->mark_as_flash('success');
			$redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
			redirect($redirect_to);
		}

	}

}