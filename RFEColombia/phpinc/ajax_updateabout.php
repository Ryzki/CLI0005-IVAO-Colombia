<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

$type = $_REQUEST["type"];

if ($type == "text") {
	$query = "UPDATE rfe_about SET
		description = '".addslashes($_REQUEST["text"])."'
		WHERE id=".$_REQUEST["id"];
	$query = mysqlexec($sqlconn,$query);
} else if ($type == 'scenery') {
	$query = "UPDATE rfe_about SET 
		fs9free = ".($_REQUEST["fs9free"] ? "'".urldecode($_REQUEST["fs9free"])."'" : "null" ).", 
		fs9pay = ".($_REQUEST["fs9pay"] ? "'".urldecode($_REQUEST["fs9pay"])."'" : "null" ).", 
		fsxfree = ".($_REQUEST["fsxfree"] ? "'".urldecode($_REQUEST["fsxfree"])."'" : "null" ).", 
		fsxpay = ".($_REQUEST["fsxpay"] ? "'".urldecode($_REQUEST["fsxpay"])."'" : "null" ).", 
		p3dfree = ".($_REQUEST["p3dfree"] ? "'".urldecode($_REQUEST["p3dfree"])."'" : "null" ).", 
		p3dpay = ".($_REQUEST["p3dpay"] ? "'".urldecode($_REQUEST["p3dpay"])."'" : "null" ).", 
		xplanefree = ".($_REQUEST["xplanefree"] ? "'".urldecode($_REQUEST["xplanefree"])."'" : "null" ).", 
		xplanepay = ".($_REQUEST["xplanepay"] ? "'".urldecode($_REQUEST["xplanepay"])."'" : "null" )." 
		WHERE id=".$_REQUEST["id"];
	$query = mysqlexec($sqlconn,$query);
} else if ($type == 'charts') {
	$query = "UPDATE rfe_about SET 
		charts = '".$_REQUEST["charts"]."' 
		WHERE id=".$_REQUEST["id"];
	$query = mysqlexec($sqlconn,$query);
} else if ($type == 'briefing') {
	$query = "UPDATE rfe_about SET 
		briefatc = '".$_REQUEST["briefatc"]."', 
		briefpilots = '".$_REQUEST["briefpilots"]."' 
		WHERE id=".$_REQUEST["id"];
	$query = mysqlexec($sqlconn,$query);
}
?>