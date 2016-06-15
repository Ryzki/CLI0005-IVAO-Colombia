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
		<li>Navdata</li>
		<li class="active">Initial configuration</li>
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
	<h3><img src="../images/divlogous-sm.png"> Initial Configuration</h3>
	
	<p>Please, fill the configuration information below:</p>
	
	<form action="7" method="post">
	
	<table align="center" class="table" id="tabledata" style='width: 100%'>
		<tr>
			<th style='width: 25%'><center>Division Name</center></th>
			<td style='width: 85%'><input type="text" name="division" id="division" style="width: 90%;" placeholder="e.g. United States" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Division ISO</center></th>
			<td style='width: 85%'><input type="text" name="divisioniso" id="divisioniso" style="width: 90%;" placeholder="e.g. US" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Event's Date</center></th>
			<td style='width: 85%'><input type="date" name="date" id="date" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Starting Time (Zulu)</center></th>
			<td style='width: 85%'><input type="time" step="1" name="timestart" id="timestart" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Ending Time (Zulu)</center></th>
			<td style='width: 85%'><input type="time" step="1" name="timeend" id="timeend" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Airport's ICAO</center></th>
			<td style='width: 85%'><input type="text" name="apticao" id="apticao" style="width: 90%;" placeholder="e.g. KDFW" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Airport/City Name</center></th>
			<td style='width: 85%'><input type="text" name="aptname" id="aptname" style="width: 90%;" placeholder="e.g. Dallas" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Timezone</center></th>
			<td style='width: 85%'><input type="text" name="timezone" id="timezone" style="width: 90%;" placeholder="e.g. +08:00, -03:00, +06:30, -04:30" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Sender (Mail)</center></th>
			<td style='width: 85%'><input type="text" name="sendermail" id="sendermail" style="width: 90%;" placeholder="e.g. rfe@ivaous.org" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Admin VID</center></th>
			<td style='width: 85%'><input type="text" name="adminvid" id="adminvid" style="width: 90%;" maxlength="6" placeholder="e.g. 123456" required/></td>
		</tr>
		
	</table>

	<button name="step3" class="btn btn-success">Proceed >></button></form>

<?php
	} else {
?>

	<p>Check the configuration on step 3.</p>

	<form action="3" method="post"><button name="step4" class="btn btn-danger"><< Go back</button></form>
<?php
	}
?>

</div>