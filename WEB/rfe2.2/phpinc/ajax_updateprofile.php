<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

$query = "UPDATE rfe_members SET
		email = '".$_REQUEST["email"]."',
		privacy = ".$_REQUEST["privacy"]."
		WHERE id=".$_REQUEST["id"];
$query = mysqlexec($sqlconn,$query);
?>