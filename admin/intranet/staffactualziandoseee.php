
<?php
			include('./db_login.php');
			
		
		
		$correosa = $_POST['correos'];

	        $ides = $_POST['idase'];
	
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		

$sql = 'select * from staff where id="' . $ides . '"';
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
}
	else
	{
	$number_of_rows = $result->num_rows;
	if ($number_of_rows > 0)
	{
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

	for ($i = 0 ; $i < 12 ; $i++) {
		$cad .= substr($str , rand(0 , 62) , 1);
	}
	$clave = $cad;
	$con_encriptada = md5($clave);
	
	// update the password
	$sql = 'UPDATE staff SET password="' . $con_encriptada . '" where  id="' . $ides. '"';

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}


	





	$mensaje = "Se ha enviado un correo con la nueva clave.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=actualizarstaff&id=$ides';";
echo "</script>";  



							}
							else
							{
						$mensaje = "La informacion es incorrecta.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = './?page=actualizarstaff&id=$ides';";
echo "</script>";  
							}
						}
						?>

