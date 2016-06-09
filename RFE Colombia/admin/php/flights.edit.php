<?php
/*========================================================================
Objetivo: Listagem de membros.
   Autor: Filipe Fonseca    09/09/2013
Revisões: 
========================================================================*/

if (isset($_GET["ide"])) {

if (!empty($_POST["flightnumber"]) AND !empty($_POST["origin"]) AND !empty($_POST["destination"]) AND !empty($_POST["acft"])) {

		$query = "UPDATE rfe_flights SET
		flightnumber = '".strtoupper($_POST["flightnumber"])."',
		origin = '".strtoupper($_POST["origin"])."',
		destination = '".strtoupper($_POST["destination"])."',
		deptime = ".(empty($_POST["deptime"]) ? "null" : "'".$_POST["deptime"]."'").",
		arrtime = ".(empty($_POST["arrtime"]) ? "null" : "'".$_POST["arrtime"]."'").",
		gate = ".(empty($_POST["gate"]) ? "null" : "'".strtoupper($_POST["gate"])."'").",
		acft = '".strtoupper($_POST["acft"])."',
		route = ".(empty($_POST["route"]) ? "null" : "'".strtoupper($_POST["route"])."'")."
		WHERE id=".$_GET["ide"];

		$query = mysqlexec($sqlconn,$query);
		$saida = '<div class="message green"><span>Flight edited successfully! Click <a href="flights.edit">here</a> to return.</span></div>';
}

?>

<div class="section">
<?php echo $saida; ?>
	<div class="box">
		<div class="title">
			Edit
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

<?php
} else {

$query = "SELECT id,flightnumber,origin,destination
            FROM rfe_flights ORDER BY id";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);
?>

			<div class="section">
				<div class="box">
					<div class="title">
						Flight List
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th><center>ID</center></th>
									<th><center>Flight</center></th>
									<th><center>Origin</center></th>
									<th><center>Destination</center></th>
									<th><center>&nbsp;</center></th>
								</tr>
							</thead>
							<tbody>
<?php

for ($i=0;$i<$queryn;$i++) {

?>
								<tr>
									<td><center><?php echo mysql_result($query,$i,'id'); ?></center></td>
									<td><center><?php echo mysql_result($query,$i,'flightnumber'); ?></center></td>
									<td><center><?php echo mysql_result($query,$i,'origin'); ?></center></td>
									<td><center><?php echo mysql_result($query,$i,'destination'); ?></center></td>
									<td><center><a href="flights.edit.<?php echo mysql_result($query,$i,'id'); ?>" class="item small"><img src="gfx/icons/big/edit.png"></a></center></td>
								</tr>
<?php

}

?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
<?php
}
?>