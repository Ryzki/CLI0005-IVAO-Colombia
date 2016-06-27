<?php
//define variables
define('cookie_name', 'ivao_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
define('url', 'http://www.ivaocol.com.co/usuarios/index.php');

//redirect function
function redirect() {
	setcookie(cookie_name, '', time()-3600);
	header('Location: '.login_url.'?url='.url);
	exit;
}

//if the token is set in the link
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Adminstrator!');
}

//check if the cookie is set and/or is correct
if($_COOKIE[cookie_name]) {
	$user_array = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
	if($user_array->result) {
		//Success! A user has been found!
		//echo 'Hello '.utf8_decode($user_array->firstname).' '.utf8_decode($user_array->lastname).'!';
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	} else {
		redirect();
    }
} else {
	redirect();
}


		
		
		
		
?>
