<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Kolkata');

# Convert date Format
function convert_date_format($date)
	{
		$date = date('jS M, Y', strtotime($date));
		return $date;
	}


# Generate random Color
function generateRandomColor() {

		$colorsArr = array("#FF0F00",
							"#FF9E01",
							"#C6A70F",
							"#7A7A52",
							"#9BC408",
							"#04D215",
							"#0D8ECF",
							"#0D52D1",
							"#8A0CCF",
							"#CD0D74");

		$randomColor = $colorsArr[rand(0,9)];
		return $randomColor;
	}

# Get Real IP Address
function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

function setUser ()
	{
		if(!isset($_SESSION['user_uid']))
		{
			$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			$current_url = base64_encode($current_url);
			$_SESSION['current_url'] = $current_url;
			redirect("Settings");
		}

		unset($_SESSION['current_url']);
		return $user_uid = $_SESSION['user_uid'];
	}

# Get dates between two dates
function range_date($first, $last)
	{
	  $arr = array();
	  $now = strtotime($first);
	  $last = strtotime($last);

	  while($now <= $last ) {
		$arr[] = date('Y-m-d', $now);
		$now = strtotime('+1 day', $now);
	  }

	  return $arr;
}

/**
 * Returns the number of week in a month for the specified date.
 *
 * @param string $date
 * @return int
 */
function weekOfMonth($date) {
    // estract date parts
    list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));

    // current week, min 1
    $w = 1;

    // for each day since the start of the month
    for ($i = 1; $i <= $d; ++$i) {
        // if that day was a sunday and is not the first day of month
        if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
            // increment current week
            ++$w;
        }
    }

    // now return
    return $w;
}

// Encrypt function with 24 digit key
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

//Generate Rendom Password
function random_password()
{
	$alphabet = '1234567890';
	$password = array();
	$alpha_length = strlen($alphabet) - 1;
	for ($i = 0; $i < 6; $i++)
	{
		$n = rand(0, $alpha_length);
		$password[] = $alphabet[$n];
	}
	return implode($password);
}