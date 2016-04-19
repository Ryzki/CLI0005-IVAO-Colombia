<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Check if an IVAO Cookie is valid. If not, send it to login screen.
   Author: Filipe Fonseca    03/09/2013
Revisions: Filipe Fonseca    13/06/2014
========================================================================*/

include("func_general.php");

// If the token is set in the link:
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Administrator!');
}

/*========================================================================
 Function: redirectLogin
    Usage: Redirect the page to login screen
Arguments: None
========================================================================*/
function redirectLogin() {
	setcookie(cookie_name, '', time()-3600);
	header('Location: '.login_url.'?url='.url);
	exit;
}

?>
