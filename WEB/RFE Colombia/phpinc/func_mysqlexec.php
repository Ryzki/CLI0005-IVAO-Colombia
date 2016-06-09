<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: File for database connection
   Author: Filipe Fonseca    03/09/2013
Revisions: Filipe Fonseca    13/06/2014
========================================================================*/
$ini = parse_ini_file("data.ini.php");
$host        = $ini["host"];
$rfedatabase = $ini["rfedatabase"];
$navdatabase = $ini["navdatabase"];
$login_db    = $ini["login_db"];
$pass_db     = $ini["pass_db"];
$port        = $ini["port"];

// Website
/*$rfedatabase = "ivaouso_rfe";     // Banco de Dados que conterá os dados
$navdatabase = "ivaouso_navdata";     // Banco de Dados que conterá os dados
$login_db    = "ivaouso_rfe";      // Login usado no MySQL
$pass_db     = "rferfe";      // Senha usada no MySQL
$port        = "";          // Porta usada na conexão*/

// Connecting to Database
if(!($sqlconn=@mysql_connect("$host:$port",$login_db,$pass_db))) {
	echo "<p align=\"center\"><big><img src=\"images/redx.png\"><br/><strong>It wasn't possible to connect to MySQL server. Please, check the configurations.</strong></big></p>";
	exit;
}

// Select Database
if(!($con=@mysql_select_db($rfedatabase,$sqlconn))) {
	echo "<p align=\"center\"><big><img src=\"images/redx.png\"><br/><strong>It wasn't possible to connect to database <i>$rfedatabase</i>. Please, check the configurations.</strong></big></p>";
	exit;
}

// Change charset to UTF-8
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

/*========================================================================
 Function: mysqlexec
    Usage: This function executes a SQL command in a MySQL database
Arguments:
	$sqlconn - Connection pointer
	$sql     - SQL Command to be executed
	$error   - Specifies if the function contains a retrieve (1=error,0=ok)
	$res     - Function's return
========================================================================*/
function mysqlexec($sqlconn,$sql,$error=1) {
	
	global $sqlconn;

	if(empty($sql) OR !($sqlconn))
		return 0;  // Connection's error or SQL error
		
	$res = @mysql_query($sql,$sqlconn);

	return $res;
}

/*========================================================================
 Function: change_db
    Usage: This function changes the pointer to another MySQL Database
Arguments:
	$sqlconn - Connection pointer
	$db      - Destnation's database
========================================================================*/
function change_db($sqlconn,$db) {

	global $sqlconn;
	
	if(!($con=mysql_select_db($db,$sqlconn))) {
		echo "<p align=\"center\"><big><img src=\"images/redx.png\"><br/><strong>It wasn't possible to connect to database <i>$db</i>. Please, check the configurations.</strong></big></p>";
		exit;
	}
	
	return $con;
}

?>