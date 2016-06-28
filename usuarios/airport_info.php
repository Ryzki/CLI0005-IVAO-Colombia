
<?php
	include ("./helpers/get_metar.php");
	$airport =  strtoupper($_POST['airport']);
	/* Connect to Database */
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	// Execute SQL query
	$sql = "select * from runways where airport_ident='" . $airport . "'";

?>


 <div class="col-md-12">
					<?php
						get_metar($airport);
					?>
			</tr></td>


				<?php include 'airport_map.php'; ?>
		</tr></td>



			<table class="table table-hover">
				<?php
					if (!$result = $db->query($sql)) {
						die('There was an error running the query  [' . $db->error . ']');
					}
					while ($row = $result->fetch_assoc()) {
						?>

						<tr>
							<td><strong>Pista</strong></td>
							<td><?php echo $row["le_ident"]; ?></td>
							<td><strong>Longitud</strong></td>
							<td><?php echo $row["length_ft"] . ' ft'; ?></td>
							<td><strong>Ancho</strong></td>
							<td><?php echo $row["width_ft"] . ' ft'; ?></td>
						</tr>
						<tr>
							<td><strong>Elevación</strong></td>
							<td><?php echo $row["le_elevation_ft"] . ' ft'; ?></td>
							<td><strong>Umbral desplazado</strong></td>
							<td><?php echo $row["le_displaced_threshold_ft"]. ' ft'; ?></td>
							<td><strong>Rumbo de pista</strong></td>
							<td><?php echo number_format($row["le_heading_degT"] , 0); ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td><strong>Pista</strong></td>
							<td><?php echo $row["he_ident"]; ?></td>
							<td><strong>Longitud</strong></td>
							<td><?php echo $row["length_ft"]. ' ft' ; ?></td>
							<td><strong>Ancho</strong></td>
							<td><?php echo $row["width_ft"] . ' ft'; ?></td>
						</tr>
						<tr>
							<td><strong>Elevación</strong></td>
							<td><?php echo $row["he_elevation_ft"] . ' ft'; ?></td>
							<td><strong>Umbral desplazado</strong></td>
							<td><?php echo $row["he_displaced_threshold_ft"]. ' ft'; ?></td>
							<td><strong>Rumbo de Pista</strong></td>
							<td><?php echo number_format($row["he_heading_degT"] , 0); ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php
					}
				?>
			</table>
			<br>

		</div>
	</div>
</div>
<?php
	// Execute SQL query
	$sql = "select * from airport_frequencies where airport_ident='" . $airport . "'";

?>
		<div class="col-md-10">
					<?php
						if (!$result = $db->query($sql)) {
							die('There was an error running the query  [' . $db->error . ']');
						}
						while ($row = $result->fetch_assoc()) {
							?>
							<tr>
								<td><strong>Tipo</strong></td>
								<td><?php echo $row["type"]; ?></td>
								<td><strong>Nombre</strong></td>
								<td><?php echo $row["description"]; ?></td>
								<td><strong>Frequencia</strong></td>
								<td><?php echo $row["frequency_mhz"] . ' MHZ'; ?></td>
							</tr>

						<?php
						}
					?>
				</table>
				<br>

			</div>
	

<?php
	// Execute SQL query
	$sql = "select * from navaids where associated_airport='" . $airport . "'";

?>




	
				<?php
					if (!$result = $db->query($sql)) {
						die('There was an error running the query  [' . $db->error . ']');
					}
					while ($row = $result->fetch_assoc()) {
						?>
						<tr>
							<td><strong>Tipo</strong></td>
							<td><?php echo $row["type"]; ?></td>
							<td><strong>Nombre</strong></td>
							<td><?php echo $row["name"]; ?></td>
							<td><strong>Frequencia</strong></td>
							<td><?php echo $row["frequency_khz"] . ' KHZ'; ?></td>
						</tr>

					<?php
					}
				?>
			</table>
			<br>

		</div>
	</div>

<?php
	$db->close();
?>




