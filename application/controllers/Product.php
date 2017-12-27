<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Product_Model");
        $this->load->model('Food_Listing_Model');
    }

    public function index()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Product', 'Product');

        $this->data['page_description'] = 'All Product';

        $this->load->library("pagination");

        //Setting for Pagination
        $config = array();

        $config["base_url"] = base_url() . "Product/index";

        $this->data['total_rows'] = $config["total_rows"] = $total_rows = $this->Food_Listing_Model->listing_total_rows();

        $config["per_page"] = 12;

        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //Get All Listings
        $this->data['product_listing'] = $product_listing = $this->Food_Listing_Model->Listings($user_id = null, $food_category = null, $config["per_page"], $page);

        $this->data['product_category'] = $product_category = $this->Product_Model->product_category();

        $this->data["links"] = $links = $this->pagination->create_links();

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
        $this->data['food_list_id'] = $food_id = $this->uri->segment(3);

        //Get Type
        $this->data['type'] = $type = $this->Product_Model->getFoodType();

        //Get Days Meal
        $this->data['day_meals'] = $day_meals = $this->Product_Model->getBreakfastLunchDinner();

        //Get Food Details
        $this->data['food_detail'] = $food_detail = $this->Food_Listing_Model->Food_Details($food_id);

        //Get Category
        $this->data['food_category'] = $food_category = $this->Food_Listing_Model->get_food_category();

        //Get Food Image
        $this->data['food_image'] = $food_image = $this->Food_Listing_Model->Food_Listing_Images($food_id);

        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Products', 'Product');
        $this->breadcrumbs->push('View', 'Product/view');

        $this->data['page_description'] = 'View';

        $this->render('product/view');
    }

    //Get Food Data for Pop-up on Home Page(Script Data)
    public function food_view()
    {
       $id = $this->input->post("id");
       $food_detail = $this->Food_Listing_Model->Food_Details($id);
       echo json_encode($food_detail);
    }

    //Get Food Images for Pop-up on Home Page(Script Data)
    public function food_images()
    {
       $id = $this->input->post("id");
       $food_image = $this->Food_Listing_Model->Food_Listing_Images($id);
       echo json_encode($food_image);
    }

    //Change Delivery Status
    public function delivery()
    {
        $data = $this->input->post("data");

        //Get UserId
        $user_id = $this->access->get_user_id();

        //Change delivery status
        $change = $this->Product_Model->delivery($user_id, $data);

        if($change)
        {
            echo "1";
        }
    }

}
