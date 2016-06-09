<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

$query = "UPDATE rfe_admins SET
	level = ".$_GET["level"]."
	WHERE id=".$_GET["id"];
	
$query = mysqlexec($sqlconn,$query);
?>