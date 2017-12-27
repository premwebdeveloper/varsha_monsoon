<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('templates/_parts/auth_master_head_view');

if ($this->ion_auth->is_admin())
{
	$this->load->view('templates/_parts/auth_master_admin_sidebar_view');
}
elseif ($this->ion_auth->in_group('user'))
{
	$this->load->view('templates/_parts/auth_master_user_sidebar_view');
}

$this->load->view('templates/_parts/auth_master_header_view');

echo $the_view_content;

$this->load->view('templates/_parts/auth_master_footer_view');

$this->load->view('templates/_parts/auth_master_footer_scripts_view');

?>