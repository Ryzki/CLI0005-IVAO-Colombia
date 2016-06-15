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

if(!($sqlconn=@mysql_connect("$host:$port",$login_db,$pass_db))) {
	$errormsg = '<div class="alert alert-error" style="width: 145%; margin: 0px 0px 5px -22px;"><h4>It wasn\'t possible to connect to MySQL server. Please, check the configurations.</h4></div>';
	$success  = false;
}

?>



<div class="span4 steps">
<h4>Installing Steps</h4>
	<ol>
		<li>About this system</li>
		<li>Initial files</li>
		<li>Database Configuration</li>
		<li>Data filling</li>
		<li class="active">Navdata</li>
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
	<h3><img src="../images/divlogous-sm.png"> NavData Filling</h3>
	
<?php
	mysql_select_db($navdatabase,$sqlconn);
	
	for ($i=1;$i<=9;$i++) {
		$file = file_get_contents("../sql/navdata".$i.".sql");
		$file = explode("\n\n",$file);
		foreach ($file as $query) {
			$return = mysql_query($query);
		}
	}
?>

<p>Data added.</p>

	<form action="6" method="post"><button name="step4" class="btn btn-success">Proceed >></button></form>
<?php
	} else {
?>

	<p>Check the configuration on step 3.</p>

	<form action="3" method="post"><button name="step4" class="btn btn-danger"><< Go back</button></form>
<?php
	}
?>

</div>