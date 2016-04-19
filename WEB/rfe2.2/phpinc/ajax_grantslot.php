<?php
include("func_mysqlexec.php");

$action = $_REQUEST["action"];

if ($action == "grant") {

	$query = 'SELECT flightnumber,origin,destination,acft,route,vid
	          FROM rfe_privatependent
				 WHERE id = '.$_REQUEST["id"];
	$query = mysqlexec($sqlconn,$query);
	
	$query2 = "UPDATE rfe_private SET 
		flightnumber = '".mysql_result($query,0,'flightnumber')."', 
		origin = '".mysql_result($query,0,'origin')."', 
		destination = '".mysql_result($query,0,'destination')."', 
		acft = '".mysql_result($query,0,'acft')."', 
		route = ".(is_null(mysql_result($query,0,'route')) ? 'NULL' : "'".mysql_result($query,0,'route')."'").", 
		vid = '".mysql_result($query,0,'vid')."' 
		WHERE slottime='".$_REQUEST["slot"]."'";
	$query2 = mysqlexec($sqlconn,$query2);
} else if ($action == 'revoke') {
	$query2 = "UPDATE rfe_private SET 
		flightnumber = null, 
		origin = null, 
		destination = null, 
		acft = null, 
		route = null, 
		vid = null,
		bookingtimestamp = null
		WHERE slottime='".$_REQUEST["slot"]."'";
	$query2 = mysqlexec($sqlconn,$query2);
}
?>