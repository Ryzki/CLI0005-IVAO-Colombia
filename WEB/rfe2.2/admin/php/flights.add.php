<?php

if (!empty($_POST["flightnumber"]) AND !empty($_POST["origin"]) AND !empty($_POST["destination"]) AND !empty($_POST["acft"])) {

  $query0 = "SELECT id FROM rfe_flights WHERE (flightnumber = '".$_POST["flightnumber"]."' AND origin = '".$_POST["origin"]."' AND destination = '".$_POST["destination"]."')";
	$query0 = mysqlexec($sqlconn,$query0);
	$queryn = mysql_num_rows($query0);

	
	if ($queryn == 0) {
	
		$query = "INSERT INTO rfe_flights VALUES
		('',
		'".strtoupper($_POST["flightnumber"])."',
		'".strtoupper($_POST["origin"])."',
		'".strtoupper($_POST["destination"])."',
		".(empty($_POST["deptime"]) ? "null" : "'".$_POST["deptime"]."'").",
		".(empty($_POST["arrtime"]) ? "null" : "'".$_POST["arrtime"]."'").",
		".(empty($_POST["gate"]) ? "null" : "'".strtoupper($_POST["gate"])."'").",
		'".strtoupper($_POST["acft"])."',
		".(empty($_POST["route"]) ? "null" : "'".strtoupper($_POST["route"])."'").",
		null,
		null)";
		
		$query = mysqlexec($sqlconn,$query);
		$saida = '<div class="message green"><span>Flight registered successfully!</span></div>';
	} else {
		$saida = '<div class="message orange"><span>There\'s already a flight with that info (id: <b>'.mysql_result($query0,0,'id').'</b>). Your flight wasn\'t added.</span></div>';
	}
}

?>

<div class="section">
<?php echo $saida; ?>
	<div class="box">
		<div class="title">
			Add flight
		</div>
		<div class="content">
			<p>Use the form below. Fields <span style="color: red;">with the red asterisk</span> are <strong>mandatory</strong>!</p>
			<form action="<?php echo $PHP_SELF; ?>" method="post" class="valid">
			<?php
				include_once("php/tpl_flight.php");
			?>
			<button type="submit" class="green"><span>Send</span></button>
			</form>
		</div>
	</div>
</div>