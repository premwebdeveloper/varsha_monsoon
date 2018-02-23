<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Product_Model");
        $this->load->model('Categories_Model');
        $this->load->model('Products_Model');
        $this->load->model('Brands_Model');
        $this->load->library('Ajax_pagination');
        $this->perPage = 4;
    }

    public function index()
    {
        $this->load->model('Brands_Model');
        $this->load->model('Categories_Model');

        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Product', 'Product');

        $this->data['page_description'] = 'All Product';

        $this->load->library("pagination");

        //Setting for Pagination
        $config = array();

        $config["base_url"] = base_url() . "Product/index";

        $this->data['total_rows'] = $config["total_rows"] = $total_rows = $this->Products_Model->products_total_rows();

        $config["per_page"] = 8;

        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //Get Product for Home Screen
        $this->data['products'] = $products = $this->Products_Model->index(null, $config["per_page"], $page);

        //Get Brands for Home Screen
        $this->data['brands'] = $brands = $this->Brands_Model->index();

        //Get Categories for Home Screen
        $this->data['categories'] = $categories = $this->Categories_Model->index();

        $this->data["links"] = $links = $this->pagination->create_links();

        /*echo "<pre>";
        print_r($products);
        die;
*/
        $this->render('product/index');
    }

    // Get products ajax function with angular
    public function getProducts()
    {
        if(!empty(file_get_contents("php://input")))
        {
            $data = json_decode(file_get_contents("php://input"));

            if(count($data) > 0)
            {
                // Get selected product types
                if(isset($data->selectedFoodTypes))
                {
                    $selectedFoodTypes = $data->selectedFoodTypes;
                    $foodTypes = 0;
                    foreach($selectedFoodTypes as $type)
                    {
                        if(!empty($type))
                        {
                            $foodTypes = 1;
                        }
                    }
                }

                // get selected day meals
                if(isset($data->selectedDayMeals))
                {
                    $selectedDayMeals = $data->selectedDayMeals;
                    $foodMeal = 0;
                    foreach($selectedDayMeals as $meal)
                    {
                        if(!empty($meal))
                        {
                            $foodMeal = 1;
                        }
                    }
                }

                // Get selected product category
                if(isset($data->category))
                {
                    $category = $data->category;
                }

                if($foodTypes == 1 && $foodMeal == 0 && $category == 0)   //product seraching according to product type
                {
                    $products = array();
                    $i = 0;
                    foreach($selectedFoodTypes as $type)
                    {
                        if(!empty($type))
                        {
                            $typeProducts = $this->Product_Model->getProductsByAll($type, null, null);

                            foreach ($typeProducts as $product) {
                                $products[$i] = $product;
                                $i++;
                            }
                        }
                    }
                }
                elseif($foodTypes == 0 && $foodMeal == 1 && $category == 0)   //product seraching according to day meals
                {
                    $products = array();
                    $i = 0;
                    foreach($selectedDayMeals as $meal)
                    {
                        $mealProducts = $this->Product_Model->getProductsByAll(null, $meal, null);

                        foreach ($mealProducts as $product) {
                            $products[$i] = $product;
                            $i++;
                        }
                    }
                }
                elseif($foodTypes == 0 && $foodMeal == 0 && $category > 0)   //product seraching according to product category
                {
                    $products = $this->Product_Model->getProductsByAll(null, null, $category);
                }
                elseif($foodTypes == 1 && $foodMeal == 1 && $category == 0)   //product seraching according to type and day meals
                {
                    $selectedTypesMeals = array();
                    $p = 0;
                    $q = 0;

                    foreach($selectedFoodTypes as $type)
                    {
                        if(!empty($type))
                        {
                            foreach($selectedDayMeals as $meal)
                            {
                                if(!empty($meal))
                                {
                                    $selectedTypesMeals[$q]['type'] = $type;
                                    $selectedTypesMeals[$q]['meal'] = $meal;
                                    $q++;
                                }
                            }
                        }
                        $p++;
                    }

                    $products = array();
                    $i = 0;
                    foreach($selectedTypesMeals as $typeMeal)
                    {
                        $allProducts = $this->Product_Model->getProductsByAll($typeMeal['type'], $typeMeal['meal'], null);

                        foreach ($allProducts as $product) {
                            $products[$i] = $product;
                            $i++;
                        }
                    }
                }
                elseif($foodTypes == 0 && $foodMeal == 1 && $category > 0)   //product seraching according to day meals and category
                {
                    $products = array();
                    $i = 0;
                    foreach($selectedDayMeals as $meal)
                    {
                        if(!empty($meal))
                        {
                            $mealProducts = $this->Product_Model->getProductsByAll(null, $meal, $category);

                            foreach ($mealProducts as $product) {
                                $products[$i] = $product;
                                $i++;
                            }
                        }
                    }
                }
                elseif($foodTypes == 1 && $foodMeal == 0 && $category > 0)   //product seraching according to type and category
                {
                    $products = array();
                    $i = 0;
                    foreach($selectedFoodTypes as $type)
                    {
                        if(!empty($type))
                        {
                            $mealProducts = $this->Product_Model->getProductsByAll($type, null, $category);

                            foreach ($mealProducts as $product) {
                                $products[$i] = $product;
                                $i++;
                            }
                        }
                    }
                }
                elseif($foodTypes == 1 && $foodMeal == 1 && $category > 0)   //product seraching according to type and meals and cat
                {
                    $selectedTypesMeals = array();
                    $p = 0;
                    $q = 0;

                    foreach($selectedFoodTypes as $type)
                    {
                        if(!empty($type))
                        {
                            foreach($selectedDayMeals as $meal)
                            {
                                if(!empty($meal))
                                {
                                    $selectedTypesMeals[$q]['type'] = $type;
                                    $selectedTypesMeals[$q]['meal'] = $meal;
                                    $selectedTypesMeals[$q]['category'] = $category;
                                    $q++;
                                }
                            }
                        }
                        $p++;
                    }

                    $products = array();
                    $i = 0;
                    foreach($selectedTypesMeals as $typeMeal)
                    {
                        $allProducts = $this->Product_Model->getProductsByAll($typeMeal['type'], $typeMeal['meal'], $typeMeal['category']);

                        foreach ($allProducts as $product) {
                            $products[$i] = $product;
                            $i++;
                        }
                    }
                }
                else    // Get all products without searching
                {
                    $products = $this->Product_Model->getProducts();
                }
            }
        }
        else
        {
            $products = $this->Product_Model->getProducts();
        }

        $json_response = json_encode($products);

        echo $json_response;
    }

    // Get all food types
    public function getFoodTypes()
    {
        $food_types = $this->Product_Model->getFoodType();
        $food_types = json_encode($food_types);

        echo $food_types;
    }

    // Get all Day meals
    public function getDayMeals()
    {
        $day_meals = $this->Product_Model->getBreakfastLunchDinner();
        $day_meals = json_encode($day_meals);

        echo $day_meals;
    }

    // Get Food Sub Categories
    public function getFoodCategory()
    {
        $food_category = $this->Product_Model->getFoodCategory();
        $food_category = json_encode($food_category);

        echo $food_category;

    }

    //Single Food View on User
    public function view()
    {
		 // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Products', 'Product');
        $this->breadcrumbs->push('View', 'Product/view');

        $this->data['page_description'] = 'View';
		
        $this->data['product_id'] = $product_id = $this->uri->segment(3);

        //Get Type
        $this->data['brand'] = $brand = $this->Brands_Model->index();

        //Get Food Details
        $this->data['product'] = $product = $this->Product_Model->index($product_id);

        //Get Category
        $this->data['categories'] = $categories = $this->Categories_Model->index();

        //Get Food Image
        $this->data['product_image'] = $product_image = $this->Products_Model->getProductImages($product_id);
		
		# If Any user order for some product
		if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('state', 'State', 'required|trim');
            $this->form_validation->set_rules('country', 'Country', 'required|trim');
            $this->form_validation->set_rules('zipcode', 'Zip Code', 'required|trim');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');

            $order = array();
			
			$order['product_id']   = $product_id = $this->input->post('product_id');

            if($this->form_validation->run() === true)
            {                
                $order['name']     = $name = $this->input->post('name');
                $order['email']    = $email = $this->input->post('email');
                $order['phone']    = $phone = $this->input->post('phone');
                $order['address']  = $address = $this->input->post('address');
                $order['city']     = $city = $this->input->post('city');
                $order['state']    = $state = $this->input->post('state');
                $order['country']  = $country = $this->input->post('country');
                $order['zipcode']  = $zip = $this->input->post('zipcode');
                $order['quantity'] = $quantity = $this->input->post('quantity');

                // Add new address
                $order = $this->Product_Model->order_now($order);
				
				# Send email to administrator for order deatails to this order
				//Send mail to Admin 
                $msg = 'Dear Sir,							
                            I want to purchase this product with quantity '.$quantity.'.
                            Name     : - '.$name.' 
                            Email Id : - '.$email.' 
                            Phone No : - '.$phone.'
                            Address  : - '.$address.', '.$city.', '.$state.', '.$country.'- '.$zip.'
                            Thank You.
                    ';

                $this->load->library('email');

                $this->email->from('premtundwal@gmail.com', 'Prem Tundwal');
                $this->email->to('premsaini9602@gmail.com');

                $this->email->subject('Product Order');
                $this->email->message($msg);

                if (!$this->email->send()) 
                {
                    $errors = $this->email->print_debugger();
                }

				# If order submitted successfully then show success message.
                if($order)
                {
                    $this->session->set_flashdata('order_success', 'Ordered product successfully.');
                }
                else
                {
                    $this->session->set_flashdata('order_success', 'Something went wrong.');
                }
                redirect('product/view/'.$product_id.'');
            }
			else
			{	
				$this->data['order_error'] = true;
			}
        }

        $this->render('product/view');
    }

    //Get Product for Ajax in Home page
    public function get_products()
    {
        $brands_id = $this->input->post("brand");
        $categories_id = $this->input->post("category");

        $product_details = array();
        $html = '';
        $i = 0;

        if($brands_id != null)
        {
            foreach ($brands_id as $b_id)
            {
                $data = $this->Products_Model->index(null, null, null, $b_id);
                foreach ($data as $value)
                {
                    $product_details[$i] = $value;
                    $i++;
                }

            }
        }
        if($categories_id != null)
        {
            foreach ($categories_id as $id)
            {
                $data = $this->Products_Model->index(null, null, null, null, $id);
                foreach ($data as $value)
                {
                    if(array_search($value['id'], array_column($product_details, 'id')) !== false)
                    {
                        $i++;
                    }
                    else
                    {
                        $product_details[$i] = $value;
                        $i++;
                    }

                }
            }
        }

        if(!empty($product_details))
        {
            foreach ($product_details as $product)
            {
                // Get product images
                $images = $this->Products_Model->getProductImages($product['id']);
                /*echo "<pre>";
                print_r($images);
                die;*/

                $html .='<div class="col-md-3 col-sm-4 shop-grid-item">
                    <div class="product-slide-entry shift-image style_border">
                        <div class="product-image">
                            <img style="height: 200px;" src="'.base_url().'uploads/products/'.$images[0]['image'].'" alt="" />
                            <img style="height: 200px;" src="'.base_url().'uploads/products/'.$images[1]['image'].'" alt="" />
                            <!-- <div class="bottom-line left-attached">
                                <a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>
                                <a class="bottom-line-a square"><i class="fa fa-heart"></i></a>
                                <a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>
                                <a class="bottom-line-a square"><i class="fa fa-expand"></i></a>
                            </div> -->
                        </div>
                        <a class="tag" href="#">'.$product['brand'].'</a>
                        <a class="title" href="#">'.$product['name'].'</a>
                        <div class="price">
                            <div class="prev">'.$product['price2'].'</div>
                            <div class="current">'.$product['price1'].'</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>';
            }
        }
        else
        {
            $html = 0;
        }
        echo json_encode($html);
    }
	
	// Search Products from the top of the website
    public function search()
    {
        if($this->input->post())
        {
            $search_for = $this->input->post('search_for');
			
            $products = $this->Product_Model->searchProducts($search_for);

            if(!empty($products))
            {
                foreach($products as $key => $product)
                {
                    $product_images = $this->Product_Model->getProductImagesByID($product['id']);
					
					$product += ['image' => $product_images[0]['image']];
					unset($products[$key]);
					$products[$key] = $product;
                }
            }
            else
            {
                $products = array();
            }
			
            $this->data['search_for'] = $search_for;
            $this->data['products'] = $products;
        }

        $this->render('product/search_product');
    }
	
	# Order Product
	public function order_now()
	{
		if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('state', 'State', 'required|trim');
            $this->form_validation->set_rules('country', 'Country', 'required|trim');
            $this->form_validation->set_rules('zipcode', 'Zip Code', 'required|trim');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|trim');

            $order = array();
			
			$order['product_id']   = $product_id = $this->input->post('product_id');

            if($this->form_validation->run() === true)
            {                
                $order['name']     = $name = $this->input->post('name');
                $order['email']    = $email = $this->input->post('email');
                $order['phone']    = $phone = $this->input->post('phone');
                $order['address']  = $new_address = $this->input->post('address');
                $order['city']     = $city = $this->input->post('city');
                $order['state']    = $state = $this->input->post('state');
                $order['country']  = $country = $this->input->post('country');
                $order['zipcode']      = $zip = $this->input->post('zipcode');
                $order['quantity'] = $quantity = $this->input->post('quantity');

                // Add new address
                $order = $this->Product_Model->order_now($order);

                if($order)
                {
                    $this->session->set_flashdata('order_success', 'Ordered product successfully.');
                }
                else
                {
                    $this->session->set_flashdata('order_success', 'Something went wrong.');
                }
                redirect('product/view/'.$product_id.'');
            }
			else
			{
				// Add breadcrumbs
				$this->breadcrumbs->push('Home', '/');
				$this->breadcrumbs->push('Products', 'Product');
				$this->breadcrumbs->push('View', 'Product/view');

				$this->data['page_description'] = 'View';
				
				$this->data['product_id'] = $product_id;

				//Get Type
				$this->data['brand'] = $brand = $this->Brands_Model->index();

				//Get Food Details
				$this->data['product'] = $product = $this->Product_Model->index($product_id);

				//Get Category
				$this->data['categories'] = $categories = $this->Categories_Model->index();

				//Get Food Image
				$this->data['product_image'] = $product_image = $this->Products_Model->getProductImages($product_id);
				
				$this->data['order_error'] = true;
		
				$this->render('product/view');
			}
        }
		redirect('product/view/');
	}

}
