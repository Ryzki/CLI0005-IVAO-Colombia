<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

$query = "UPDATE rfe_config SET
	division = '".$_GET["division"]."',
	divisioniso = '".$_GET["divisioniso"]."',
	datestart = '".$_GET["datestart"]."',
	timestart = '".$_GET["timestart"]."',
	dateend = '".$_GET["dateend"]."',
	timeend = '".$_GET["timeend"]."',
	apticao = '".strtoupper($_GET["apticao"])."',
	aptname = '".$_GET["aptname"]."',
	timezone = '".$_GET["timezone"]."',
	privatebook = ".$_GET["privatebook"].",
	sendermail = '".$_GET["sendermail"]."',
	useradiocallsign = ".$_GET["useradiocallsign"].",
	status = ".$_GET["status"]."
	WHERE id=".$_GET["id"];
	
$query = mysqlexec($sqlconn,$query);
?>