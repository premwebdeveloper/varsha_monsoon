<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Food_Listings extends Auth_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->Model('Food_Listing_Model');
		$this->load->Model('Users_Model');
		$this->load->library(array('ion_auth','form_validation'));
	}

	# User Listing
	public function index()
	{
		$user_uid = $this->access->get_user_uid();

		if($this->ion_auth->is_admin())
		{
			// Add breadcrumbs
			$this->breadcrumbs->push('Home', 'Dashboard');
			$this->breadcrumbs->push('Product Listing', 'Food_Listings');
			$this->data['page_description'] = 'Food Listing';
		}
		elseif($this->ion_auth->in_group("user"))
		{
			// Add breadcrumbs
			$this->breadcrumbs->push('Home', '/');
			$this->breadcrumbs->push('Product Listing', 'Food_Listings');
			$this->data['page_description'] = 'Food Listing';
		}

        $this->load->library("pagination");

        //Load Product MOdel
        $this->load->Model('Product_Model');

        //Setting for Pagination
        $config = array();

        $config["base_url"] = base_url() . "Food_Listings/index";

        $this->data['total_rows'] = $config["total_rows"] = $total_rows = $this->Food_Listing_Model->listing_total_rows($user_uid);

        $config["per_page"] = 9;

        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //Get Type
        $this->data['type'] = $type = $this->Product_Model->getFoodType();

        //Get Days Meal
        $this->data['day_meals'] = $day_meals = $this->Product_Model->getBreakfastLunchDinner();

        //Get Product Data
		$this->data['my_listings'] = $my_listings = $this->Food_Listing_Model->Listings($user_uid, $food_category = null, $config["per_page"], $page);

		//Get Product Category
		$this->data['category'] = $category = $this->Food_Listing_Model->get_food_category();

		//If Product is disable
		$disable = 0;
		foreach ($my_listings as $value) {

			if($value['status'] == 2)
			{
				$disable++;
			}
		}
		$this->data['disable'] = $disable;

		if ($_SESSION['user_group'] == "admin")
		{
			$this->data['user'] = $user = $this->Users_Model->get_user($user_uid);
			$this->render('admin_user/user_food_listings');
		}
		elseif($_SESSION['user_group'] == "user")
		{
			$this->data["links"] = $links = $this->pagination->create_links();

			$this->render('food_listings/index');
		}
	}

	# View User Listing
	public function view_listing()
	{
		//Load Product MOdel
        $this->load->Model('Product_Model');

		if($this->ion_auth->is_admin())
		{
			// Add breadcrumbs
			$this->breadcrumbs->push('Home', 'Dashboard');
			$this->breadcrumbs->push('Product Listing', 'Food_Listings');
			$this->breadcrumbs->push('View', 'Food_Listings/view_listing');
		}
		elseif($this->ion_auth->in_group("user"))
		{
			// Add breadcrumbs
			$this->breadcrumbs->push('Home', '/');
			$this->breadcrumbs->push('Product Listing', 'Food_Listings');
			$this->breadcrumbs->push('View', 'Food_Listings/view_listing');
		}
		$this->data['page_description'] = 'Product Listing';

		$user_id = $this->access->get_user_uid();

		$food_listing_id = $this->uri->segment(3);

		//Get Type
        $this->data['type'] = $type = $this->Product_Model->getFoodType();

		//Get Days Meal
        $this->data['day_meals'] = $day_meals = $this->Product_Model->getBreakfastLunchDinner();

        //Get Product Detail
		$this->data['food_details'] = $food_details = $this->Food_Listing_Model->Food_Details($food_listing_id);

		//Get Category
		$this->data['food_category'] = $food_category = $this->Food_Listing_Model->get_food_category();

		//Get Product Abvailability
		$this->data['product_availibility'] = $product_availibility = $this->Product_Model->product_availibility($food_listing_id);

		//Expload _ from week id
		if($product_availibility['available_on'] == 1)
		{
			// Remove last "|" character
				$temp = rtrim($product_availibility['available_weak_days'],'_');

				$this->data['week_id'] = $week_id = explode("_", $temp);
		}

		//get Food Listing Images
		$this->data['food_images'] = $food_images = $this->Food_Listing_Model->Food_Listing_Images($food_listing_id);

		if ($_SESSION['user_group'] == "admin")
		{
			$this->render('admin_user/view_food_listings');
		}
		elseif($_SESSION['user_group'] == "user")
		{
			$this->render('food_listings/view_listing');
		}
	}

	# Edit User Listing
	public function edit_listing()
	{
		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Product Listing', 'Food_Listings');
		$this->breadcrumbs->push('Edit', 'Food_Listings/edit_listing');

		$this->data['page_description'] = 'Product Listing';

		$user_id = $this->access->get_user_id();

		$food_listing_id = $this->uri->segment(3);

		//Get Food Category
		$this->data['food_category'] = $food_category = $this->Food_Listing_Model->get_food_category();

		//Get Product Detail
		$this->data['food_details'] = $food_details = $this->Food_Listing_Model->Food_Details($food_listing_id);

		//Get Product Abvailability
		$this->data['product_availibility'] = $product_availibility = $this->Product_Model->product_availibility($food_listing_id);

		//Get Type
		$this->data['type'] = $type = $this->Product_Model->getFoodType();

		//Get Day Meal
		$this->data['day_meals'] = $day_meals = $this->Product_Model->getBreakfastLunchDinner();

		//Get Week Days
		$this->data['week_days'] = $week_days = $this->Product_Model->week_days();

		//get Food Listing Images
		$this->data['food_images'] = $food_images = $this->Food_Listing_Model->Food_Listing_Images($food_listing_id);

		//Expload _ from week id
		if($product_availibility['available_on'] == 1)
		{
			// Remove last "|" character
				$data = rtrim($product_availibility['available_weak_days'],'_');

				$this->data['week_id'] = $week_id = explode("_", $data);
		}

		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('food_name','food_name', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
			$this->form_validation->set_rules('desc','desc', 'trim|required');
			$this->form_validation->set_rules('type','type', 'trim|required');
			$this->form_validation->set_rules('availability','Availability', 'trim|required');
			$availability = $this->input->post("availability");
			$other_category = $this->input->post("other_category");
			$food_category = $this->input->post("food_category");

			if(!$this->input->post("other_category") && !$this->input->post("food_category"))
			{
				$this->form_validation->set_rules('category','Category / Other Category', 'trim|required');
			}

			$week_name = null;
			$date = null;

			if($availability == 1)
			{
				$week_name = $this->input->post("week_name");
				if(empty($week_name))
				{
					$this->form_validation->set_rules('week_name','Week Name', 'trim|required');
				}
			}

			if($availability == 2)
			{
				$this->form_validation->set_rules('date','Date', 'trim|required');
			}

			if($this->form_validation->run() == TRUE)
			{
				$type = $this->input->post("type");
				$desc = $this->input->post("desc");
				$food_name = $this->input->post("food_name");
				$price = $this->input->post("price");
				$day_meal = $this->input->post("day_meal");
				$food_listings_id = $this->input->post("food_listings_id");
				$from_time = $this->input->post("from_time");
				$to_time = $this->input->post("to_time");

				// Delete Sub Image
				$deleted_images = $this->input->post("deleted_images");

				//Delete Main Image
				$deleted_main_images = $this->input->post("deleted_main_images");

				// Remove last "|" character
				$temp = rtrim($deleted_images,'|');

				$img_id = explode("|", $temp);

				$images = '';

				$week_id = '';

				//Week Name
				foreach($week_name as $week)
				{
					$week_id .= $week."_";
				}

				//Upload LIsings Images
				if(!empty($_FILES['userFiles']['name'][0]))
				{
					$filesCount = count($_FILES['userFiles']['name']);

					for($i = 0; $i < $filesCount; $i++)
					{
						$path = "uploads/listingImage/".$user_id;

						if(!file_exists($path))
						{
							mkdir($path, 0777, true);
						}

						$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
						$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
						$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
						$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
						$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

						$config['upload_path'] = $path;
						$config['allowed_types'] = 'bmp|jpg|png|jpeg';
						$config['max_size'] = 2000;

						// Set upload library
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('userFile'))
						{
							$upload_error = array('error' => $this->upload->display_errors());
						}
						else
						{
							$fileData = $this->upload->data();
							$uploadData[$i]['file_name'] = $fileData['file_name'];
							$uploadData[$i]['type'] = $fileData['image_type'];
							$uploadData[$i]['size'] = $fileData['file_size'];

							// Crop Image Size
							$configer =  array(
							  'image_library'   => 'gd2',
							  'source_image'    =>  $fileData['full_path'],
							  'maintain_ratio'  =>  FALSE,
							  'create_thumb'  =>  FALSE,
							  //'maintain_ratio'  =>  TRUE,
							  'quality'  		=>  '100%',
							  'width'           =>  600,
							  'height'          =>  500,
							);
							$this->image_lib->clear();
							$this->image_lib->initialize($configer);
							$this->image_lib->resize();
						}
					}
				}

				// Check Main Image Delete or Not
				if(!empty($deleted_main_images))
				{
					// If file is Large then show error
					if(!empty($upload_error))
					{
						$_SESSION['error'] = $upload_error['error'];
						$this->session->mark_as_flash('error');
						$this->render('Food_Listings/edit_listing');
					}
					else
					{
						if(!empty($uploadData))
						{
							foreach($uploadData as $upload)
							{
								$images .= $upload['file_name'] ."|";
							}

							$images = substr($images, 0, -1);
							$image = explode("|", $images);

							$main_image = $image[0];

							if($food_details['image'] == '')
							{
								unset($image[0]);
								$re_arrenge = Sort($image);

								//Insert Product Availability Data
								$update_available_product = $this->Food_Listing_Model->update_available_product($food_listings_id, $availability, $from_time, $to_time, $week_id, $date);

								// Update Listings
								$add_food_listing = $this->Food_Listing_Model->update_food_Listings($food_listings_id, $type, $food_name, $food_category, $desc, $day_meal, $other_category, $price, $main_image);
							}
							else
							{

								//Insert Product Availability Data
								$update_available_product = $this->Food_Listing_Model->update_available_product($food_listings_id, $availability, $from_time, $to_time, $week_id, $date);

								// Update Listings
								$add_food_listing = $this->Food_Listing_Model->update_food_Listings($food_listings_id, $type, $food_name, $food_category, $desc, $day_meal, $other_category, $price, $deleted_main_images);
							}

							// Delete food images
							if(!empty($img_id))
							{
								foreach($img_id as $img)
								{
									$deleteImage = $this->Food_Listing_Model->deleteImage($img);
								}
							}

							// Upload all images in listing_images table with user_id and food_listing ID
							foreach($image as $img)
							{
								$food_image = $this->Food_Listing_Model->addFoodImages($img, $food_listings_id);
							}

							$_SESSION['success'] = "Food Updated Successfully";
							$this->session->mark_as_flash('success');
							redirect('Food_Listings/edit_listing/'.$food_listing_id);
						}
						else
						{
							// Delete food images
							if(!empty($img_id))
							{
								foreach($img_id as $img)
								{
									$deleteImage = $this->Food_Listing_Model->deleteImage($img);
								}
							}

							//Insert Product Availability Data
								$update_available_product = $this->Food_Listing_Model->update_available_product($food_listings_id, $availability, $from_time, $to_time, $week_id, $date);

							// Update Listings
							$add_food_listing = $this->Food_Listing_Model->update_food_Listings($food_listings_id, $type, $food_name, $food_category, $desc, $day_meal, $other_category, $price, $food_details['image']);

							$_SESSION['success'] = "Food Updated Successfully";
							$this->session->mark_as_flash('success');
							redirect('Food_Listings/edit_listing/'.$food_listing_id);
						}
					}
				}
				else
				{
					//Get all Food Images by Id from food_image table
					$all_image = $this->Food_Listing_Model->Food_Listing_Images($food_listing_id);

					$all_img = count($all_image);
					$delete_img = count($img_id);

					//Check User delete all food images or not
					if(($all_img === $delete_img ) && (empty($deleted_main_images) && (empty($_FILES['userFiles']['name'][0]))) || ($delete_img === 0) )
					{
						$_SESSION['error'] = "You should upload min one Food Image.";
						$this->session->mark_as_flash('error');
						redirect('Food_Listings/edit_listing/'.$food_listing_id);
					}
					else
					{
						foreach($all_image as $image)
						{
							if(!in_array($image["id"], $img_id))
							{
								$new_main_image = $image['image'];
								if(empty($_FILES['userFiles']['name'][0]))
								{
									$deleteImage = $this->Food_Listing_Model->deleteImage($image['id']);
								}
								break;
							}
						}

						// If file is Large then show error
						if(!empty($upload_error))
						{
							$_SESSION['error'] = $upload_error['error'];
							$this->session->mark_as_flash('error');
							redirect('Food_Listings/edit_listing/'.$food_listing_id);
						}
						else
						{
							if(!empty($uploadData))
							{
								foreach($uploadData as $upload)
								{
									$images .= $upload['file_name'] ."|";
								}

								$images = substr($images, 0, -1);
								$image = explode("|", $images);

								$main_image = $image[0];

								unset($image[0]);
								$re_arrenge = Sort($image);

								//Insert Product Availability Data
								$update_available_product = $this->Food_Listing_Model->update_available_product($food_listings_id, $availability, $from_time, $to_time, $week_id, $date);

								// Update Listings
								$add_food_listing = $this->Food_Listing_Model->update_food_Listings($food_listings_id, $type, $food_name, $food_category, $desc, $day_meal, $other_category, $price, $main_image);

								// Upload all images in listing_images table with user_id and food_listing ID
								foreach($image as $img)
								{
									$food_image = $this->Food_Listing_Model->addFoodImages($img, $food_listings_id);
								}

								// Delete food images
								if(!empty($img_id))
								{
									foreach($img_id as $img)
									{
										$deleteImage = $this->Food_Listing_Model->deleteImage($img);
									}
								}

								$_SESSION['success'] = "Food Updated Successfully";
								$this->session->mark_as_flash('success');
								redirect('Food_Listings/edit_listing/'.$food_listing_id);
							}
							else
							{
								// Delete food images
								if(!empty($img_id))
								{
									foreach($img_id as $img)
									{
										$deleteImage = $this->Food_Listing_Model->deleteImage($img);
									}
								}

								//Insert Product Availability Data
								$update_available_product = $this->Food_Listing_Model->update_available_product($food_listings_id, $availability, $from_time, $to_time, $week_id, $date);

								// Update Listings
								$add_food_listing = $this->Food_Listing_Model->update_food_Listings($food_listings_id, $type, $food_name, $food_category, $desc, $day_meal, $other_category, $price, $new_main_image);

								$_SESSION['success'] = "Food Updated Successfully";
								$this->session->mark_as_flash('success');
								redirect('Food_Listings/edit_listing/'.$food_listing_id);
							}
						}
					}
				}
			}
			else
			{
				$this->render('food_listings/edit_listing');
			}
		}

		$this->render('food_listings/edit_listing');
	}

	# Get Singel food Type for Ajax
	public function get_food_category()
	{
		$type_id = $this->input->post('type_id');
		$user_id = $this->access->get_user_id();
		$food_details = $this->Food_Listing_Model->Type_Foods($type_id, $user_id);
		echo json_encode($food_details);
	}

	# Add/Post Listing
	public function add_listings()
	{
		//Load Model
		$this->load->model('Product_Model');

		// Add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push('Product Listing', 'Food_Listings');
		$this->breadcrumbs->push('Product Add', 'Food_Listings/add_listings');

		$this->data['page_description'] = 'Product Listing';

		$user_id = $this->access->get_user_id();

		//Get Type
		$this->data['type'] = $type = $this->Product_Model->getFoodType();

		//Get Day Meal
		$this->data['day_meals'] = $day_meals = $this->Product_Model->getBreakfastLunchDinner();

		//Get Category
		$this->data['food_category'] = $food_category = $this->Food_Listing_Model->get_food_category();

		//Get Week Days
		$this->data['week_days'] = $week_days = $this->Product_Model->week_days();

		if($this->input->post())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('desc','desc', 'trim|required');
			$this->form_validation->set_rules('food_name','food_name', 'trim|required');
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
			$this->form_validation->set_rules('type','Type', 'trim|required');
			$this->form_validation->set_rules('availability','Availability', 'trim|required');

			$availability = $this->input->post("availability");
			$other_category = $this->input->post("other_category");
			$food_category = $this->input->post("category");

			if(!$this->input->post("other_category") && !$this->input->post("category"))
			{
				$this->form_validation->set_rules('category','Category / Other Category', 'trim|required');
			}

			$week_name = null;
			$date = null;

			if($availability == 1)
			{
				$week_name = $this->input->post("week_name");
				if(empty($week_name))
				{
					$this->form_validation->set_rules('week_name','Week Name', 'trim|required');
				}
			}

			if($availability == 2)
			{
				$this->form_validation->set_rules('date','Date', 'trim|required');

			}

			if($this->form_validation->run() == TRUE)
			{

				$desc = $this->input->post("desc");
				$day_meal = $this->input->post("day_meal");
				$food_name = $this->input->post("food_name");
				$price = $this->input->post("price");
				$type = $this->input->post("type");
				$from_time = $this->input->post("from_time");
				$to_time = $this->input->post("to_time");

				if(!empty($other_category) && $food_category != 0)
				{
					$_SESSION['other_category'] = "You should select/choose only one Category.";
					$this->session->mark_as_flash('other_category');
					redirect('Food_Listings/edit_listing/'.$food_listing_id);
				}

				if($availability == 1)
				{
					if(empty($week_name))
					{
						$_SESSION['error'] = "Please select a Week Days.";
						$this->session->mark_as_flash('error');
						$this->render('Food_Listings/add_listing');
					}
				}
				elseif($availability == 2)
				{
					$date = $this->input->post("date");
					if(empty($date))
					{
						$_SESSION['error'] = "Please select a date.";
						$this->session->mark_as_flash('error');
						$this->render('Food_Listings/add_listing');
					}
				}
				$images = '';

				//Upload LIsings Images
				if(!empty($_FILES['userFiles']['name'][0]))
				{
					$filesCount = count($_FILES['userFiles']['name']);

					for($i = 0; $i < $filesCount; $i++)
					{
						$path = "uploads/listingImage/".$user_id;

						if(!file_exists($path))
						{
							mkdir($path, 0777, true);
						}

						$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
						$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
						$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
						$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
						$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

						$config['upload_path'] = $path;
						$config['allowed_types'] = 'bmp|jpg|png|jpeg';
						$config['max_size'] = 2000;

						// Set upload library
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('userFile'))
						{
							$upload_error = array('error' => $this->upload->display_errors());
						}
						else
						{
							$fileData = $this->upload->data();
							$uploadData[$i]['file_name'] = $fileData['file_name'];
							$uploadData[$i]['type'] = $fileData['image_type'];
							$uploadData[$i]['size'] = $fileData['file_size'];

							// Crop Image Size
							$configer =  array(
							  'image_library'   => 'gd2',
							  'source_image'    =>  $fileData['full_path'],
							  'maintain_ratio'  =>  FALSE,
							  'create_thumb'  =>  FALSE,
							  //'maintain_ratio'  =>  TRUE,
							  'quality'  		=>  '100%',
							  'width'           =>  600,
							  'height'          =>  500,
							);
							$this->image_lib->clear();
							$this->image_lib->initialize($configer);
							$this->image_lib->resize();
						}
					}
				}

				// If file is Large then show error
				if(!empty($upload_error))
				{
					$_SESSION['error'] = $upload_error['error'];
					$this->session->mark_as_flash('error');
					$this->render('Food_Listings/add_listing');
				}
				else
				{
					foreach($uploadData as $upload)
					{
						$images .= $upload['file_name'] ."|";
					}

					$images = substr($images, 0, -1);
					$image = explode("|", $images);

					$main_image = $image[0];
					unset($image[0]);
					$re_arrenge = Sort($image);

					$week_id = '';

					//Week Name
					foreach($week_name as $week)
					{
						$week_id .= $week."_";
					}

					// Add Listings
					$add_food_listing = $this->Food_Listing_Model->add_food_Listings($user_id, $food_name, $type, $food_category, $desc, $price, $day_meal, $other_category, $main_image);

					//Insert Product Availability Data
					$product_available = $this->Food_Listing_Model->product_available($user_id, $add_food_listing, $availability, $from_time, $to_time, $week_id, $date);

					// Upload all images in listing_images table with user_id and food_listing ID
					foreach($image as $img)
					{
						$food_image = $this->Food_Listing_Model->addFoodImages($img, $add_food_listing);
					}

					$_SESSION['success'] = "Food Added successfully";
					$this->session->mark_as_flash('success');
					redirect('Food_Listings');
				}
			}
			else
			{
				$this->render('food_listings/add_listing');
			}
		}

		$this->render('food_listings/add_listing');
	}

	// Delete Food Image
	public function deleteImage()
	{
		$image_id = $this->input->post('image_id');			// Imsge Id
		$food_listing_id = $this->input->post('food_listing_id');  // food_listing_id
		$image_name = $this->input->post('image_name');		// Image Name

		$Food_Details = $this->Food_Listing_Model->Food_Details($food_listing_id);		// Get House data

		$house_main_image = $Food_Details['image'];				// House main Image

		if($image_name == $house_main_image)
		{
			// Delete Image from food_listings table by image id
			$deleteImage = $this->Food_Listing_Model->Delete_Food_Main_Image($food_listing_id);
		}

		// Delete Image from food_images table by image idate
		$deleteImage = $this->Food_Listing_Model->deleteImage($image_id);

		if($deleteImage)
		{
			$response = '1';
		}
		else
		{
			$response = '0';
		}
		echo $response;
	}

	// Get Food Category for Add Listing by User
	public function get_category()
	{
		$type_id = $this->input->post('id');			// Type id
		$food_category = $this->Food_Listing_Model->Type_Foods($category_id = null, $user_id = null, $type_id);

		echo json_encode($food_category);
	}

	// Delete Food Listings
	public function delete_listing()
	{
		if ($_SESSION['user_group'] == "admin")
		{
			$id = $this->uri->segment(3);
			$change = $this->Food_Listing_Model->delete_listing($id);
			$this->session->set_flashdata('message', 'Food Listing Deleted Successfully.');
			redirect("Food_Listings");
		}
		elseif($_SESSION['user_group'] == "user")
		{
			$id = $this->input->post("food_id");

			//Change Listing Status
			$change = $this->Food_Listing_Model->delete_listing($id);

			$this->session->set_flashdata('success', 'Food Listing Deleted Successfully.');
			$redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
			redirect($redirect_to);
		}
	}

	// Product Listing Enable or Disable by user
	public function enableDisableProducts()
	{
		$status = $this->input->post('status');
		$user_id = $this->access->get_user_id();

		if($this->input->post('id') && $this->input->post('status'))
		{
			$id = $this->input->post('id');
			if($status == 1)
			{
				$status = 3;
				$change = $this->Food_Listing_Model->delete_listing($id, $status);
				echo true;
			}
			if($status == 3)
			{
				$status = 1;
				$change = $this->Food_Listing_Model->delete_listing($id, $status);
				echo true;
			}
		}
		if(!$this->input->post('id') && $this->input->post('status'))
		{
			if($status == 1)
			{
				$change = $this->Food_Listing_Model->enableDisableProducts($user_id, $status);
				echo true;
			}
			if($status == 2)
			{
				$change = $this->Food_Listing_Model->enableDisableProducts($user_id, $status);
				echo true;
			}
		}
	}
}