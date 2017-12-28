<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Auth_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Products_Model");
        $this->load->Model('Brands_Model');
        $this->load->Model('Categories_Model');
    }

    public function index()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Products', 'index');

        $this->data['page_description'] = 'Products';

        $this->data['products'] = $products = $this->Products_Model->index();

        $this->render('products/index');
    }

    // Add new address
    public function add_product()
    {
        // Add breadcrumbs
        $this->breadcrumbs->push('Home', 'Dashboard');
        $this->breadcrumbs->push('Products', 'Products/index');
        $this->breadcrumbs->push('Add Product', 'add_product');

        $this->data['page_description'] = 'Add Product';

        if($this->input->post())
        {
            $this->form_validation->set_rules('brand', 'Brand', 'required|trim');
            $this->form_validation->set_rules('category', 'Category', 'required|trim');
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('sku_code', 'SKU Code', 'required|trim');
            $this->form_validation->set_rules('price1', 'Price 1', 'required|trim');
            $this->form_validation->set_rules('price2', 'Price 2', 'required|trim');

            $product = array();

            if($this->form_validation->run() === true)
            {
                $product['brand'] = $brand = $this->input->post('brand');
                $product['category'] = $category = $this->input->post('category');
                $product['name'] = $name = $this->input->post('name');
                $product['sku_code'] = $sku_code = $this->input->post('sku_code');
                $product['price1'] = $price1 = $this->input->post('price1');
                $product['price2'] = $price2 = $this->input->post('price2');
                $product['description'] = $description = $this->input->post('description');

                $product_images = array();

                //Upload Product Images
                if(!empty($_FILES['images']['name'][0]))
                {
                    $filesCount = count($_FILES['images']['name']);

                    for($i = 0; $i < $filesCount; $i++)
                    {
                        $path = "uploads/products/";

                        if(!file_exists($path))
                        {
                            mkdir($path, 0777, true);
                        }

                        $_FILES['userFile']['name'] = $_FILES['images']['name'][$i];
                        $_FILES['userFile']['type'] = $_FILES['images']['type'][$i];
                        $_FILES['userFile']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                        $_FILES['userFile']['error'] = $_FILES['images']['error'][$i];
                        $_FILES['userFile']['size'] = $_FILES['images']['size'][$i];

                        $config['upload_path'] = $path;
                        $config['allowed_types'] = 'bmp|jpg|png|jpeg';
                        $config['max_size'] = 8000;

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
                        }
                    }
                }

                // If any error then show error
                if(!empty($upload_error))
                {
                    $_SESSION['error'] = $upload_error['error'];
                    $this->session->mark_as_flash('error');
                    //$this->render('products/insert');
                    redirect('Products/add_product');
                }
                else
                {
                    $i = 0;
                    foreach($uploadData as $upload)
                    {
                        $product_images[$i] = $upload['file_name'];
                        $i++;
                    }

                    $add = $this->Products_Model->add_product($product);

                    // Upload all images
                    /*foreach($product_images as $image)
                    {

                    }*/

                    if($add)
                    {
                        $this->session->set_flashdata('message', 'Product added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('message', 'Something went wrong.');
                    }
                    redirect('Products');
                }
            }
        }

        // Get All Brands
        $this->data['brands'] = $brands = $this->Brands_Model->index();

        // Get All Categories
        $this->data['categories'] = $categories = $this->Categories_Model->index();

        $this->render('products/insert');
    }

    // Delete user address
    public function deleteProduct()
    {
        $product_id = $this->uri->segment(3);

        $delete = $this->Products_Model->deleteProduct($product_id);

        if($delete)
        {
            $this->session->set_flashdata('message', 'Product deleted successfully.');
        }
        else
        {
            $this->session->set_flashdata('message', 'Something went wrong.');
        }
        redirect('Products');
    }

}
