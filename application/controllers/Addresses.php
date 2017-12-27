<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Addresses extends Auth_Controller
{
    // Parent Construct function
    function __construct()
    {
        parent::__construct();
        $this->load->Model('Addresses_Model');
        $this->load->Model('Users_Model');
        $this->load->library(array('ion_auth','form_validation'));
    }

    // index function || Show all addresses
    public function index()
    {
        $user_id = $this->access->get_user_id();

        $this->data['addresses'] = $addresses = $this->Addresses_Model->index($user_id);

        $this->render('addresses/index');
    }

    // Add New Address
    public function add_address()
    {
        $user_id = $this->access->get_user_id();

        $data = json_decode(file_get_contents("php://input"));

        $address = array();

        if(count($data) > 0)
        {
            $address['user_id'] = $user_id;
            $address['name']    = $name = $data->name;
            $address['mobile']  = $mobile = $data->mobile;
            $address['address'] = $addr = $data->address;
            $address['city']    = $city = $data->city;
            $address['state']   = $state = $data->state;
            $address['country'] = $country = $data->country;
            $address['zip']     = $zip = $data->zip;

            // Get addresses If any address is available for this user
            $addresses = $this->Addresses_Model->index($user_id);

            if(!empty($addresses))
            {
                $address['default_address'] = 0;
            }
            else
            {
                $address['default_address'] = 1;
            }

            // Add new address
            $insert_id = $this->Addresses_Model->add_new_address($address);

            if($insert_id > 0)
            {
                //echo 1;
                echo $insert_id.'|'.$name.'|'.$mobile.'|'.$addr.'|'.$city.'|'.$state.'|'.$country.'|'.$zip;
            }
            else
            {
                echo 0;
            }
        }
    }

    // Update user address
    public function update_address()
    {
        $user_id = $this->access->get_user_id();

        $edit_address = array();

        $edit_address['address_id']  = $address_id  = $this->input->post('address_id');
        $edit_address['editName']    = $editName    = $this->input->post('editName');
        $edit_address['editMobile']  = $editMobile  = $this->input->post('editMobile');
        $edit_address['editAddress'] = $editAddress = $this->input->post('editAddress');
        $edit_address['editCity']    = $editCity    = $this->input->post('editCity');
        $edit_address['editState']   = $editState   = $this->input->post('editState');
        $edit_address['editCountry'] = $editCountry = $this->input->post('editCountry');
        $edit_address['editZip']     = $editZip     = $this->input->post('editZip');

        if($editName != '' && $editMobile != '' && $editAddress != '' && $editCity != '' && $editState != '' && $editCountry != '' && $editZip != '')
        {
            if(strlen($editMobile) != 10)
            {
                echo 2;
            }
            else
            {
                // Finally update addres
                $updated = $this->Addresses_Model->update_address($edit_address);

                if($updated)
                {
                    $address = $this->Addresses_Model->getAddressByID($address_id);

                    $updated_address = $address_id.'|'.$editName.'|'.$editMobile.'|'.$editAddress.'|'.$editCity.'|'.$editState.'|'.$editCountry.'|'.$editZip.'|'.$address['default_address'];

                    echo $updated_address;
                }
                else
                {
                    echo 3;
                }
            }
        }
        else
        {
            echo 0;
        }
    }

    // Edit address form view
    public function get_edit_address_form()
    {
        $user_id = $this->access->get_user_id();

        $data = json_decode(file_get_contents("php://input"));

        if(count($data) > 0)
        {
            $address_id = $data->address_id;

            $address = $this->Addresses_Model->getAddressByID($address_id);

            $form_html = '<div class="col-md-12 mb10 p0">   <div class="col-md-6 pt15 col-xs-12 red">Please fill all required field with *</div><div class="col-md-6 col-xs-12 pt15 text-right"> <a href="javascript:;" class="cancel_edit_address" id="cancel_edit_address_'.$address_id.'" ng-click="cancel_edit_address($event)">Cancel</a> </div> <div class="col-md-12"><div class="col-md-12 pt10 alert alert-warning finally_edit_errors" style="display:none;"></div></div>    <form novalidate method="post" name="edit_address" id="edit_address" class="m-t" ng-submit="editAddressClick()">     <div class="col-sm-6 pt10"><label class="required-label">Name</label><input name="editName" value="'.$address["name"].'" class="simple-field" id="editName" ng-model="editAdd.editName" required="required" placeholder="Name" type="text"></div>       <div class="col-sm-6 pt10"><label class="required-label">Mobile</label><input name="editMobile" value="'.$address["mobile"].'" class="simple-field" ng-pattern="/^[7-9][0-9]{9}$/" id="editMobile" ng-model="edirAdd.editMobile" "required="required" maxlength="10" placeholder="10 digit valid mobile number" type="text"></div>    <div class="col-sm-6 pt10"><label class="required-label">Address</label><input name="editAddress" value="'.$address["address"].'" class="simple-field" ng-model="editAdd.editAddress" required="required" id="editAddress" placeholder="Address" type="text"></div>    <div class="col-sm-6 pt10"><label class="required-label">City</label><input name="editCity" value="'.$address["city"].'" class="simple-field" ng-model="editAdd.editCity" required="required" id="editCity" placeholder="City" type="text"></div>   <div class="col-sm-6 pt10"><label class="required-label">State</label><input name="editState" value="'.$address["state"].'" class="simple-field" ng-model="editAdd.editState" required="required" id="editState" placeholder="State" type="text"></div>      <div class="col-sm-6 pt10"><label class="required-label">Country</label><input name="editCountry" value="'.$address["country"].'" class="simple-field" ng-model="editAdd.editCountry" required="required" id="editCountry" placeholder="Country" type="text"></div>    <div class="col-sm-6 pt10"><label class="required-label">Zip Code</label><input name="editZip" maxlength="6" value="'.$address["zip"].'" class="simple-field" ng-model="editAdd.editZip" required="required" id="editZip" placeholder="Zip Code" type="text"></div>      <div class="col-lg-12 col-md-12 col-sm-12 pt10"> <input name="editAddressFinally" value="Update Address" class="button style-10 btn btn-block editAddressFinally" id="editAddressFinally_'.$address_id.'" ng-disabled="edit_address.$invalid" type="button"> </div> </form> </div>';

            echo $form_html;
        }
    }

    // Add new address
    /*public function add_new_address()
    {
        $user_id = $this->access->get_user_id();

        if($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'required|trim');
            $this->form_validation->set_rules('mobile', 'Mobile', 'required|trim|min_length[10]|max_length[10]');
            $this->form_validation->set_rules('address', 'Address', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('state', 'State', 'required|trim');
            $this->form_validation->set_rules('country', 'Country', 'required|trim');
            $this->form_validation->set_rules('zip', 'Zip Code', 'required|trim');

            $address = array();

            if($this->form_validation->run() === true)
            {
                $address['user_id'] = $user_id;
                $address['name']    = $name = $this->input->post('name');
                $address['mobile']  = $mobile = $this->input->post('mobile');
                $address['address'] = $new_address = $this->input->post('address');
                $address['city']    = $city = $this->input->post('city');
                $address['state']   = $state = $this->input->post('state');
                $address['country'] = $country = $this->input->post('country');
                $address['zip']     = $zip = $this->input->post('zip');

                // Get addresses If any address is available for this user
                $addresses = $this->Addresses_Model->index($user_id);

                if(!empty($addresses))
                {
                    $address['default_address'] = 0;
                }
                else
                {
                    $address['default_address'] = 1;
                }

                // Add new address
                $add = $this->Addresses_Model->add_new_address($address);

                if($add)
                {
                    $this->session->set_flashdata('add_address', 'Address added successfully.');
                }
                else
                {
                    $this->session->set_flashdata('add_address', 'Something went wrong.');
                }
                redirect('addresses');
            }
        }

        $this->data['addresses'] = $addresses = $this->Addresses_Model->index($user_id);

        $this->render('addresses/index');
    }*/

    // Delete user address
    public function delete_address()
    {
        $user_id = $this->access->get_user_id();

        $address_id = $this->uri->segment(3);

        $delete = $this->Addresses_Model->delete_address($user_id, $address_id);

        if($delete)
        {
            $this->session->set_flashdata('address_msg', 'Address deleted successfully.');
        }
        else
        {
            $this->session->set_flashdata('address_msg', 'Something went wrong.');
        }
        redirect('addresses');
    }

    // Set as default address
    public function set_default_address()
    {
        $user_id = $this->access->get_user_id();

        $address_id = $this->uri->segment(3);

        $default = $this->Addresses_Model->set_default_address($user_id, $address_id);

        if($default)
        {
            $this->session->set_flashdata('address_msg', 'Address set as default successfully.');
        }
        else
        {
            $this->session->set_flashdata('address_msg', 'Something went wrong.');
        }

        redirect('addresses');
    }

    // Get user's exist addresses angular function
    public function getAllAddresses()
    {
        $user_id = $this->access->get_user_id();

        $addresses = $this->Addresses_Model->index($user_id);

        $addresses = json_encode($addresses);

        echo $addresses;
    }


}