<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model('Cart_Model');
        $this->load->model('Food_Listing_Model');
    }

    public function index()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', '/');
        $this->breadcrumbs->push('Cart', 'Cart');

        $this->data['page_description'] = 'Cart';

        $cart_products = array();

        if($this->ion_auth->logged_in())
        {
            $user_id = $this->access->get_user_id();

            $cart_products = $this->Cart_Model->cartProducts($user_id);
        }
        elseif(isset($_SESSION['cart_value']))
        {

            /*$temp = rtrim($_SESSION['cart_value'],'_');
            $cart_product = explode("_", $temp);
            foreach($cart_product as $id)
            {
                // Get Details for Cart
                $product_detail[$i] = $this->Food_Listing_Model->Food_Details($id);
                $i++;
            }*/
        }

        $this->data['cart_products'] = $cart_products;
        $this->render('cart/index');
    }

    //Add Product to Cart
    public function add_cart()
    {
        $product_id = $this->uri->segment(3);

        $quantity = $this->input->post('quantity');

        if($this->ion_auth->logged_in())
        {
            $user_id = $this->access->get_user_id();

            //Check This product is already in table with status 0 or not
            $count = $this->Cart_Model->cart($user_id, $product_id);

            if($count)
            {
                $exist_quantity = $count['quantity'];
                $updated_quantity = $exist_quantity + $quantity;
                $quantity = $updated_quantity;

                $update_cart = $this->Cart_Model->update_cart($count['id'], $quantity);
                $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                redirect($redirect_to);
            }
            else
            {
                $add_cart = $this->Cart_Model->add_cart($user_id, $product_id, $quantity);
                $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
                redirect($redirect_to);
            }
        }
        else
        {
            $temp_user_cart = array();
            $i = 0;

            if(!isset($_SESSION['cart_value']))
            {
                $temp_user_cart[$i]['product_id'] = $product_id;
                $temp_user_cart[$i]['quantity'] = $quantity;

                $_SESSION['cart_value'] = $temp_user_cart;

                $_SESSION['increament'] = $i;
            }
            else
            {
                $i = $_SESSION['increament'];
                $i++;

                // If the product already is in cart
                if(in_array($product_id, array_column($_SESSION['cart_value'], 'product_id')))
                {
                    $new_cart_array = array();
                    $p = 0;

                    // Already exist product quantity increament
                    foreach($_SESSION['cart_value'] as $old_cart)
                    {
                        if($product_id == $old_cart['product_id'])
                        {
                            $increament_quantity = $old_cart['quantity'] + $quantity;

                            $new_cart_array[$p]['product_id'] = $old_cart['product_id'];
                            $new_cart_array[$p]['quantity'] = $increament_quantity;
                        }
                        else
                        {
                            $new_cart_array[$p]['product_id'] = $old_cart['product_id'];
                            $new_cart_array[$p]['quantity'] = $old_cart['quantity'];
                        }
                        $p++;
                    }

                    // Regenerate array after increament quantity
                    $_SESSION['cart_value'] = $new_cart_array;
                }
                else
                {
                    $temp_user_cart['product_id'] = $product_id;
                    $temp_user_cart['quantity'] = $quantity;

                    array_push($_SESSION['cart_value'],$temp_user_cart);

                    $_SESSION['increament'] = $i;
                }

            }

            $redirect_to = str_replace(base_url(),'',$_SERVER['HTTP_REFERER']);
            redirect($redirect_to);
        }
    }

    //Remove Cart Product
    public function remove_cart()
    {
        $cart_id = $this->uri->segment(3);

        if($this->ion_auth->logged_in())
        {
            $user_id = $this->access->get_user_id();

            $remove = $this->Cart_Model->remove_cart_product($user_id, $cart_id);

        }
        else
        {
            $cartArray = array();
            $k = 0;
            foreach($_SESSION['cart_value'] as $cart)
            {
                if($cart['product_id'] == $cart_id)
                {
                    // Remove this entry
                }
                else
                {
                    $cartArray[$k]['product_id'] = $cart['product_id'];
                    $cartArray[$k]['quantity'] = $cart['quantity'];
                    $k++;
                }
            }

            if(count($cartArray) > 0)
            {
                $_SESSION['cart_value'] = $cartArray;
            }
            else
            {
                unset($_SESSION['cart_value']);
            }
        }

        redirect('Cart');
    }

    // Update cart product quantity
    public function updateCart()
    {
        $cart_id = $this->uri->segment(3);

        $quantity = $this->input->post('quantity');

        if($this->ion_auth->logged_in())
        {
            $update_cart = $this->Cart_Model->update_cart($cart_id, $quantity);
        }
        else
        {
            $cartArray = array();
            $k = 0;
            foreach($_SESSION['cart_value'] as $cart)
            {
                if($cart['product_id'] == $cart_id)
                {
                    //$updated_quantity = $cart['quantity'] + $quantity;

                    $cartArray[$k]['product_id'] = $cart['product_id'];
                    $cartArray[$k]['quantity'] = $quantity;
                }
                else
                {
                    $cartArray[$k]['product_id'] = $cart['product_id'];
                    $cartArray[$k]['quantity'] = $cart['quantity'];
                }
                $k++;
            }

            $_SESSION['cart_value'] = $cartArray;
        }

        redirect('Cart');
    }

    // Get all cart products / show in checkout page
    public function getCartProducts()
    {
        $user_id = $this->access->get_user_id();

        $cart_products = $this->Cart_Model->cartProducts($user_id);

        $cart_products = json_encode($cart_products);

        echo $cart_products;
    }

    //Check out Product
    public function checkout()
    {
        $this->render('cart/checkout');
    }
}
