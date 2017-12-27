<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Food_Listing_Model extends CI_Model
{
	function __construct()
	{
		// Call the CI_Model constructor
		parent::__construct();
	}

	// Get User Listings form 'food_listings' table
	public function Listings($user_id = null, $food_category = null, $limit = null, $start = null)
	{
		if(!is_null($user_id) && is_null($food_category))
		{
			$this->db->limit($limit, $start);

			//$query = $this->db->get_where('food_listings', array('status' => '1', 'user_id' => $user_id));

			$this->db->where('status >=', '1');

			$this->db->where('user_id', $user_id);

			$query = $this->db->get('food_listings');

			$result = $query->result_array();
			//echo $this->db->last_query();exit;

		}
		elseif(is_null($user_id) && !is_null($food_category))
		{
			$this->db->select('food_list.*, food_categories.food_category types');

			$this->db->from('food_listings food_list');

			$this->db->join('food_category food_categories', 'food_categories.id = food_list.food_category');

			$this->db->where('food_list.status', '1');
			$this->db->where('food_categories.id', $food_category);
			$query = $this->db->get();
			$result = $query->result_array();
		}
		else
		{
			$this->db->limit($limit, $start);

			$this->db->select('food_list.*, food_categories.food_category types');

			$this->db->from('food_listings food_list');

			$this->db->join('food_category food_categories', 'food_categories.id = food_list.food_category');

			$this->db->where('food_list.status', '1');

			$this->db->order_by("updated_on", "desc");

			$query = $this->db->get();

			$result = $query->result_array();
		}

		return $result;
	}

	// Get no of Rows for Pagination
	public function listing_total_rows($user_id = null)
	{
		if(!is_null($user_id))
		{
			$query = $this->db->get_where('food_listings', array('status' => '1', 'user_id' => $user_id));
		}
		else
		{
			$query = $this->db->get_where('food_listings', array('status' => '1'));
		}

		$result = $query->num_rows();

		return $result;
	}

	// Get Food Listings form 'food_listings' table
	public function Food_Details($product_id = null)
	{
		$query = $this->db->get_where('food_listings', array('id' => $product_id));

		$result = $query->row_array();

		//echo $this->db->last_query(); exit;

		return $result;
	}

	// Get Food Listings Images form 'food_image' table
	public function Food_Listing_Images($id)
	{
		$query = $this->db->get_where('food_images', array('status' => '1', 'food_listing_id' => $id));
		$result = $query->result_array();
		return $result;

	}

	// Get Food All Single Food Types  form 'food_listings' table
	public function Type_Foods($category_id = null, $user_id = null, $type_id = null)
	{
		if(is_null($category_id))
		{
			$query = $this->db->get_where('food_category', array('status' => '1', 'food_type' => $type_id));
			$result = $query->result_array();
		}
		else
		{
			$query = $this->db->get_where('food_listings', array('status' => '1', 'user_id' => $user_id,'food_category' => $category_id));
			$result = $query->result_array();
		}
		return $result;

	}

	// Add User Listings in 'food_listings' table
	public function add_food_Listings($user_id, $food_name, $type, $food_category, $desc, $price, $day_meal, $other_category, $main_image)
	{
		$date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

			$data_create = array(
			'user_id ' => $user_id,
			'food_type' => $type,
			'food_category' => $food_category,
			'food_name' => $food_name,
			'breakfast_lunch_dinner' => $day_meal,
			'optional_category' => $other_category,
			'description' => $desc,
			'price' => $price,
			'image' => $main_image,
			'status' => '1',
			'created_on' => $date,
			'updated_on' => $date,
			);

		$this->db->insert('food_listings', $data_create);

		$food_listing_insert_id = $this->db->insert_id();

		// End Transaction
		$this->db->trans_complete();

		return $food_listing_insert_id;
	}

	// Insert Product Availability Data in 'product_available_on' table
	public function product_available($user_id, $add_food_listing, $availability, $from_time, $to_time, $week_id, $date)
	{
		$web_date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

			$data_create = array(
			'user_id ' => $user_id,
			'product_id' => $add_food_listing,
			'available_on' => $availability,
			'available_weak_days' => $week_id,
			'available_on_date' => $date,
			'available_from_time' => $from_time,
			'available_to_time' => $to_time,
			'status' => '1',
			'created_on' => $web_date,
			'updated_on' => $web_date,
			);

		$this->db->insert('product_available_on', $data_create);

		//$food_listing_insert_id = $this->db->insert_id();

		// End Transaction
		$this->db->trans_complete();

		return true;
	}


	// Update User Listings in 'food_listings' table
	public function update_food_Listings($food_listings_id, $type, $food_name, $food_category, $desc, $day_meal, $other_category, $price, $main_image)
	{
		$date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

			$data_create = array(
			'food_category' => $food_category,
			'food_name' => $food_name,
			'food_type' => $type,
			'breakfast_lunch_dinner' => $day_meal,
			'optional_category' => $other_category,
			'description' => $desc,
			'price' => $price,
			'image' => $main_image,
			'updated_on' => $date,
			);

		$this->db->where('id', $food_listings_id);
		$this->db->update('food_listings', $data_create);
		//echo $this->db->last_query();exit;
		// End Transaction
		$this->db->trans_complete();

		return true;
	}

	// Update User Listings in 'food_listings' table
	public function update_available_product($food_listings_id, $availability, $from_time, $to_time, $week_id, $date)
	{
		$update_date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

			$data_create = array(
			'available_on' => $availability,
			'available_from_time' => $from_time,
			'available_to_time' => $to_time,
			'available_weak_days' => $week_id,
			'available_on_date' => $date,
			'updated_on' => $update_date,
			);

		$this->db->where('product_id', $food_listings_id);
		$this->db->update('product_available_on', $data_create);
		//echo $this->db->last_query();exit;
		// End Transaction
		$this->db->trans_complete();

		return true;
	}


	// Add User Listings Images in 'food_listings' table
	public function addFoodImages($img, $add_food_listing)
	{
		$date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

		$data = array(
			'food_listing_id' => $add_food_listing,
			'image' => $img,
			'status' => '1',
		);

		$this->db->insert('food_images', $data);

		$food_image_insert_id = $this->db->insert_id();

		// End Transaction
		$this->db->trans_complete();
	}

	// Get All Food Category from 'food_category' table
	public function get_food_category($id = null)
	{
		if(!is_null($id))
		{
			$query = $this->db->get_where('food_category', array('status' => '1', 'id' => $id));
			$result = $query->result_array();
			//echo $this->db->last_query();exit;
		}
		else
		{
			$query = $this->db->get_where('food_category', array('status' => '1'));
			$result = $query->result_array();
		}
		return $result;
	}

	// Delete Food Main Image from 'food_listings' table
	public function Delete_Food_Main_Image($food_listing_id = null)
	{
		$date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

		$data = array(
			'image' => '',
			'updated_on' => $date
		);

		$this->db->where('id', $food_listing_id);

		$this->db->update('food_listings', $data);

		// End Transaction
		$this->db->trans_complete();

		return true;
	}

	// Delete Food Image from 'food_Image' table
	public function deleteImage($image_id = null)
	{
		// Start Transaction
		$this->db->trans_start();

			$this->db->where('id', $image_id);
			$this->db->delete('food_images');

		// End Transaction
		$this->db->trans_complete();

		return true;
	}

	//Delete Food Listing
	public function delete_listing($id, $status = null)
	{
		$date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

		if(empty($status))
		{
			$data = array(
				'status' => "0",
				'updated_on' => $date
			);
		}
		else
		{
			$data = array(
				'status' => $status,
				'updated_on' => $date
			);
		}

		$this->db->where('id', $id);

		$this->db->update('food_listings', $data);

		// End Transaction
		$this->db->trans_complete();

		return true;
	}

	//Enable or Disable all Product
	public function enableDisableProducts($user_id, $status)
	{
		$date = date('Y-m-d H:i:s');

		// Start Transaction
		$this->db->trans_start();

		if($status == 2)
		{
			$data = array(
				'status' => "1",
				'updated_on' => $date
			);
		}
		if($status == 1)
		{
			$data = array(
				'status' => "2",
				'updated_on' => $date
			);
		}

		$this->db->where('user_id', $user_id);
		$this->db->where('status', $status);

		$this->db->update('food_listings', $data);

		// End Transaction
		$this->db->trans_complete();

		return true;
	}

}