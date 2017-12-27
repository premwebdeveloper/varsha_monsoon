<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BREADCRUMB CONFIG
| -------------------------------------------------------------------
| This file will contain some breadcrumbs' settings.
|
| $config['crumb_divider']		The string used to divide the crumbs
| $config['tag_open'] 			The opening tag for breadcrumb's holder.
| $config['tag_close'] 			The closing tag for breadcrumb's holder.
| $config['crumb_open'] 		The opening tag for breadcrumb's holder.
| $config['crumb_close'] 		The closing tag for breadcrumb's holder.
|
| Defaults provided for twitter bootstrap 2.0
*/

$config['crumb_divider'] = '';
$config['tag_open'] = '<div class="breadcrumb-box"><ul class="breadcrumb">';
$config['tag_close'] = '</ul></div>';
//$config['crumb_open'] = '<li>';
$config['crumb_last_open'] = '<a class="active" style="cursor: pointer;"><strong class="text_bold">';
$config['crumb_close'] = '</strong></a>';


/* End of file breadcrumbs.php */
/* Location: ./application/config/breadcrumbs.php */