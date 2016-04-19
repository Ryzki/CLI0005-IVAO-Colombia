<?php
/*========================================================================
Objetivo: Listagem de membros.
   Autor: Filipe Fonseca    09/09/2013
Revisões: 
========================================================================*/

if (isset($_GET["ide"])) {

if (!empty($_POST["vid"]) AND !empty($_POST["name"])) {

	foreach ($_POST["id"] as $key => $idid) {
	
		$query = "UPDATE rfe_atc SET
		vid = ".(empty($_POST["vid"][$key]) ? "null" : "'".$_POST["vid"][$key]."'").",
		name = ".(empty($_POST["name"][$key]) ? "null" : "'".$_POST["name"][$key]."'")."
		WHERE id=".$idid;

		$query = mysqlexec($sqlconn,$query);
		$saida = '<div class="message green"><span>ATC edited successfully! Click <a href="atcs.edit">here</a> to return.</span></div>';
	
	}
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
				include_once("php/tpl_atcs.php");
			?>
			<button type="submit" class="green"><span>Send</span></button>
			</form>
		</div>
	</div>
</div>

<?php
} else {

$query = "SELECT DISTINCT position FROM rfe_atc";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);
?>

			<div class="section">
				<div class="box">
					<div class="title">
						ATC List
					</div>
					<div class="content">
						<table cellspacing="0" cellpadding="0" border="0" class="all"> 
							<thead> 
								<tr>
									<th><center>Position</center></th>
									<th><center>&nbsp;</center></th>
								</tr>
							</thead>
							<tbody>
<?php

for ($i=0;$i<$queryn;$i++) {

?>
								<tr>
									<td><center><?php echo mysql_result($query,$i,'position'); ?></center></td>
									<td><center><a href="atcs.edit.<?php echo str_replace("_","",mysql_result($query,$i,'position')); ?>" class="item small"><img src="gfx/icons/big/edit.png"></a></center></td>
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