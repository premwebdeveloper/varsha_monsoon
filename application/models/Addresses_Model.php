<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Addresses_Model extends CI_Model
{
    function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    // Get all addresses
    public function index($user_id)
    {
        if(!is_null($user_id))
        {
            $query = $this->db->get_where('user_addresses', array('user_id' => $user_id, 'status' => '1'));
            $result = $query->result_array();
        }
        else
        {
            $query = $this->db->get_where('user_addresses', array('status' => '1'));
            $result = $query->result_array();
        }

        return $result;
    }

    // Get address by address id
    public function getAddressByID($address_id)
    {
        $query = $this->db->get_where('user_addresses', array('id' => $address_id));
        $result = $query->row_array();
        return $result;
    }

    // Add new address
    public function add_new_address($address)
    {
        $date = date('Y-m-d H:i:s');

        $this->db->trans_start();

            $data = array(
                'user_id'         => $address['user_id'],
                'default_address' => $address['default_address'],
                'name'            => $address['name'],
                'mobile'          => $address['mobile'],
                'address'         => $address['address'],
                'city'            => $address['city'],
                'state'           => $address['state'],
                'country'         => $address['country'],
                'zip'             => $address['zip'],
                'created_on'      => $date,
                'updated_on'      => $date,
                'status'          => 1,
            );

            $this->db->insert('user_addresses', $data);

            $insert_id = $this->db->insert_id();

            //echo $this->db->last_query(); exit;

        $this->db->trans_complete();

        return $insert_id;
    }

    // Delete user address
    public function delete_address($user_id, $address_id)
    {
        $date = date("Y-m-d H:i:s");

        if(!is_null($user_id) &&!is_null($address_id))
        {
            $data = array(
                'status' => 0,
                'updated_on' => $date,
            );

            $this->db->where('id', $address_id);
            $this->db->where('user_id', $user_id);

            # update Users_details
            $this->db->update('user_addresses', $data);
        }

        return true;
    }

    // Set as default address
    public function set_default_address($user_id, $address_id)
    {
        $date = date("Y-m-d H:i:s");

        if(!is_null($user_id) &&!is_null($address_id))
        {
            //  first unset all address as default
            $data = array(
                'default_address' => 0,
                'updated_on' => $date,
            );

            $this->db->where('user_id', $user_id);

            # update Users_details
            $this->db->update('user_addresses', $data);

            // Now set address as default
            $data = array(
                'default_address' => 1,
                'updated_on' => $date,
            );

            $this->db->where('id', $address_id);
            $this->db->where('user_id', $user_id);

            # update Users_details
            $this->db->update('user_addresses', $data);
        }

        return true;
    }

    // Update address
    public function update_address($edit_address)
    {
        $date = date("Y-m-d H:i:s");

        //  first unset all address as default
        $data = array(
            'name' => $edit_address['editName'],
            'mobile' => $edit_address['editMobile'],
            'address' => $edit_address['editAddress'],
            'city' => $edit_address['editCity'],
            'state' => $edit_address['editState'],
            'country' => $edit_address['editCountry'],
            'zip' => $edit_address['editZip'],
            'updated_on' => $date,
        );

        $this->db->where('id', $edit_address['address_id']);

        # update Users_details
        $this->db->update('user_addresses', $data);

        return true;
    }

    //Get Default Address
    public function default_address($user_id)
    {
        $query = $this->db->get_where('user_addresses', array('user_id' => $user_id, 'default_address' => 1, 'status' => '1'));
        $result = $query->row_array();

        return $result;
    }

}