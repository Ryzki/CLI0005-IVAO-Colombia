<?php
include("func_mysqlexec.php");

if (!empty($_REQUEST["membermail"])) {
	$query = "UPDATE rfe_members SET 
		email = '".$_REQUEST["membermail"]."'
		WHERE id='".$_REQUEST["id"]."'";
	$query = mysqlexec($sqlconn,$query);
}
?>