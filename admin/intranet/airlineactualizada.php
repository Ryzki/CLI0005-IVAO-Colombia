
<?php
			include('./db_login.php');
			
		
		
		
$ides = $_POST['id'];
	      $nombresa = $_POST['nombre'];
	$tipe = $_POST['tipe'];
	$sistema = $_POST['sistema'];
	$icao = $_POST['icao'];
	$iata = $_POST['iata'];
	$radio = $_POST['radio'];
	$ceo = $_POST['ceo'];
	$url = $_POST['url'];
	$pca = $_POST['pca'];
	$stat = $_POST['stat'];
	$vuelo = $_POST['vuelo'];
	$info = $_POST['info'];
	$numeros = $_POST['numeros'];
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql2 = "SELECT * FROM airlines where id='$ides'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {
		$imagens = $row2['imagen_va'];
	}
		
		
		

$nombrearch = $_FILES['image_file']['name'];
if ($nombrearch != "") {
	
	unlink('./imagenair/' . $imagens);


$target_path = "./imagenair/";
$target_path = $target_path . basename($_FILES['image_file']['name']); 
	if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { 
echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$nombressse = $_FILES['image_file']['name'];

$sql112 = "UPDATE airlines set nombre_aerolinea='$nombresa', icao_aerolinea='$icao', imagen_va='$nombressse', iata_aerolinea='$iata', ceo='$ceo', informacion='$info', url_pilotos='$pca', url_estadistica='$stat', url_horas_mes='$vuelo', sistema='$sistema', web='$url', tipo_aerolinea='$tipe', numeros='$numeros', radio='$radio' where id='$ides'";

		if (!$result112 = $db->query($sql112)) {
			die('There was an error running the query [' . $db->error . ']');
		}


		
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
		
		
	
} else {
	
	

	$sql11 = "UPDATE airlines set nombre_aerolinea='$nombresa', icao_aerolinea='$icao', iata_aerolinea='$iata', ceo='$ceo', informacion='$info', url_pilotos='$pca', url_estadistica='$stat', url_horas_mes='$vuelo', sistema='$sistema', web='$url', tipo_aerolinea='$tipe', numeros='$numeros', radio='$radio' where id='$ides'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}

			
		}
	
		
	
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=airlines';
</script>


