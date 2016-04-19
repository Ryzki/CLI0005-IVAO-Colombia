<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Contains configuration setup for usage in the RFE System.
   Author: Filipe Fonseca    18/08/2014
Revisions:
========================================================================*/

if (!file_exists("phpinc/data.ini.php")) {
	header('Location: install/');
}

// Header Definition
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Loading Incorporation Fonts
set_time_limit(0);
include("phpinc/func_mysqlexec.php");
include("phpinc/func_general.php");

// Check if configuration for RFE exists. If don't, terminate.
$query = "SELECT * FROM rfe_config";
$query = mysqlexec($sqlconn,$query);
if (mysql_num_rows($query)==0) {
	echo "<p align=\"center\"><big><img src=\"images/redx.png\"><br/><strong>Please add configuration for RFE in <i>rfe_config</i> table in the database.</strong></big></p>";
	exit();
}

//if the token is set in the link
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Administrator!');
}

if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

// Check event's status. If not active, go to landing page.
$status = mysql_result($query,0,'status');
	
if (!empty($IVAO_Info->vid)) {

	$query = "SELECT * FROM rfe_admins WHERE vid = ".$IVAO_Info->vid;
	$query = mysqlexec($sqlconn,$query);
	
	if (($status != 1) AND (mysql_num_rows($query)==0)) {
		header('Location: landingpage/');
	}
	
} else {

	if ($status != 1) {
		header('Location: landingpage/');
	}

}

// Check if user is in members database
if (isset($IVAO_Info)) {
	change_db($sqlconn,$rfedatabase);
	$querymember = "SELECT id,vid FROM rfe_members WHERE vid = '".$IVAO_Info->vid."'";
	$querymember = mysqlexec($sqlconn,$querymember);
	$result = mysql_num_rows($querymember);
	
	if (empty($result)) {
		$query = "INSERT INTO rfe_members VALUES
			('',
			'".$IVAO_Info->vid."',
			'".$IVAO_Info->firstname." ".$IVAO_Info->lastname."',
			null,
			'".$IVAO_Info->ratingpilot."',
			'".$IVAO_Info->ratingatc."',
			'".$IVAO_Info->division."',
			1)";
		$query = mysqlexec($sqlconn,$query);
	/*} else {
	
		$query = "UPDATE rfe_members SET
			name = '".$IVAO_Info->firstname." ".$IVAO_Info->lastname."',
			ratingpilot = '".$IVAO_Info->ratingpilot."',
			ratingatc = '".$IVAO_Info->ratingatc."',
			division = '".$IVAO_Info->division."'
			WHERE id = ".mysql_result($querymember,0,'id');
		$query = mysqlexec($sqlconn,$query);*/
	}
}

// Get airport name for title/logo
$querysel = "SELECT apticao,aptname FROM rfe_config";
$querysel = mysqlexec($sqlconn,$querysel);

// Check if the user is admin
$query = "SELECT vid,level FROM rfe_admins WHERE vid='".$IVAO_Info->vid."'";
$query = mysqlexec($sqlconn,$query);

$is_admin = (mysql_num_rows($query) > 0 ? true : false);

if ($is_admin) {
	$is_admin_level = mysql_result($query,0,'level');
}

// Loading header information
include("phpinc/header.inc.php");
?>