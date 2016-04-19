<?php
$success = true;
$alerts  = false;
$infos   = false;

// Attempting Connection
$ini = parse_ini_file("../phpinc/data.ini.php");
$host        = $ini["host"];
$rfedatabase = $ini["rfedatabase"];
$navdatabase = $ini["navdatabase"];
$login_db    = $ini["login_db"];
$pass_db     = $ini["pass_db"];
$port        = $ini["port"];


$division    = $_POST["division"];
$divisioniso = $_POST["divisioniso"];
$date        = $_POST["date"];
$timestart   = $_POST["timestart"];
$timeend     = $_POST["timeend"];
$apticao     = $_POST["apticao"];
$aptname     = $_POST["aptname"];
$timezone    = $_POST["timezone"];
$sendermail  = $_POST["sendermail"];
$adminvid    = $_POST["adminvid"];


if(!($sqlconn=@mysql_connect("$host:$port",$login_db,$pass_db))) {
	$errormsg .= '<div class="alert alert-error" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>It wasn\'t possible to connect to MySQL server. Please, check the configurations.</h4></div>';
	$success   = false;
}

if ($success) {
	mysql_select_db($rfedatabase,$sqlconn);
	$return = mysql_query("INSERT INTO rfe_config (division, divisioniso, datestart, timestart, dateend, timeend, apticao, aptname, timezone, privatebook, status, sendermail, useradiocallsign) VALUES ('".$division."', '".$divisioniso."', '".$date."', '".$timestart."', '".$date."', '".$timeend."', '".$apticao."', '".$aptname."', '".$timezone."', 0, 1, '".$sendermail."', 0);");
	if(! $return ) {
		die('Could not work: ' . mysql_error());
	}
	$return = mysql_query("INSERT INTO rfe_admins (vid, level) VALUES (".$adminvid.", 2);");
	if(! $return ) {
		die('Could not work: ' . mysql_error());
	}
	$return = mysql_query("INSERT INTO rfe_about VALUES ('', null, null, null, null, null, null, null, null, null, null, null, null);");
	if(! $return ) {
		die('Could not work: ' . mysql_error());
	}
}
?>



<div class="span4 steps">
<h4>Installing Steps</h4>
	<ol>
		<li>About this system</li>
		<li>Initial files</li>
		<li>Database Configuration</li>
		<li>Data filling</li>
		<li>Navdata</li>
		<li>Initial configuration</li>
		<li class="active">Ready to use!</li>
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
	<h3><img src="../images/divlogous-sm.png"> Ready to use!</h3>


<p>Congratulations! The system is installed and prepared to be used. Access it <a href="../">here</a>.</p>

<?php
	} else {
?>

	<p>Check the configuration on step 3.</p>

	<form action="3" method="post"><button name="step4" class="btn btn-danger"><< Go back</button></form>
<?php
	}
?>

</div>