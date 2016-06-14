<?php
$success = true;
$alerts  = false;
$infos   = false;

// Attempting Connection
$host        = $_POST['host'];
$rfedatabase = $_POST['rfedatabase'];
$navdatabase = $_POST['navdatabase'];
$login_db    = $_POST['login_db'];
$pass_db     = $_POST['pass_db'];
$port        = $_POST['port'];

if(!($sqlconn=@mysql_connect("$host:$port",$login_db,$pass_db))) {
	$errormsg .= '<div class="alert alert-error" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>It wasn\'t possible to connect to MySQL server. Please, check the configurations.</h4></div>';
	$success   = false;
}

if ($success) {
	if(!($con=@mysql_select_db($rfedatabase,$sqlconn))) {
		$return = mysql_query("CREATE DATABASE ".$rfedatabase);
		if(! $return ) {
			die('Could not create database: ' . mysql_error());
		}
		$alertmsg .= '<div class="alert alert-warning" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>Database \''.$rfedatabase.'\' wasn\'t found. It was created.</h4></div>';
		$alerts    = true;
/*		$return = mysql_query("DROP DATABASE ".$rfedatabase);
		if(! $return ) {
			die('Could not create database: ' . mysql_error());
		}*/
	} else {
		$infomsg .= '<div class="alert alert-success" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>Database \''.$rfedatabase.'\' already existent.</h4></div>';
		$infos    = true;
	}
	
if(!($con=@mysql_select_db($navdatabase,$sqlconn))) {
		$return = mysql_query("CREATE DATABASE ".$navdatabase);
		if(! $return ) {
			die('Could not create database: ' . mysql_error());
		}
		$alertmsg .= '<div class="alert alert-warning" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>Database \''.$navdatabase.'\' wasn\'t found. It was created.</h4></div>';
		$alerts    = true;
	} else {
		$infomsg .= '<div class="alert alert-success" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>Database \''.$navdatabase.'\' already existent.</h4></div>';
		$infos    = true;
	}
}
?>



<div class="span4 steps">
<h4>Installing Steps</h4>
	<ol>
		<li>About this system</li>
		<li>Initial files</li>
		<li>Database Configuration</li>
		<li class="active">Data filling</li>
		<li>Navdata</li>
		<li>Initial configuration</li>
		<li>Ready to use!</li>
	</ol>
</div>

<div class="span7 text">

<?php
	if (!$success OR $alerts OR $infos) {
		echo $errormsg;
		echo $alertmsg;
		echo $infomsg;
	}

	if ($success) {
?>
	<h3><img src="../images/divlogous-sm.png"> Data Filling</h3>
	
<?php
	mysql_select_db($rfedatabase,$sqlconn);
	$file = file_get_contents("../sql/rfe.sql");
	$file = explode("\n\n",$file);
	foreach ($file as $query) {
		$return = mysql_query($query);
	}
?>

<p>Data added.</p>

<?php	
	$inifile = fopen('../phpinc/data.ini.php', 'w');
	fwrite($inifile, ';<?php\r\n');
	fwrite($inifile, ';die ();\r\n');
	fwrite($inifile, ';/*\r\n');
	fwrite($inifile, 'host        = '.$host.'\r\n');
	fwrite($inifile, 'rfedatabase = '.$rfedatabase.'\r\n');
	fwrite($inifile, 'navdatabase = '.$navdatabase.'\r\n');
	fwrite($inifile, 'login_db    = '.$login_db.'\r\n');
	fwrite($inifile, 'pass_db     = '.$pass_db.'\r\n');
	fwrite($inifile, 'port        = '.$port.'\r\n');
	fwrite($inifile, ';*/\r\n');
	fwrite($inifile, ';?>');
	fclose($inifile);
?>

	<form action="5" method="post"><button name="step4" class="btn btn-success">Proceed >></button></form>
<?php
	} else {
?>

	<p>Check the configuration on previous step.</p>

	<form action="3" method="post"><button name="step4" class="btn btn-danger"><< Go back</button></form>
<?php
	}
?>

</div>