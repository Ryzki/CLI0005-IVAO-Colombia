<html>
<head>
<meta http-equiv="refresh" content="600">
<title>...</title>
<style type="text/css">
.bg {
width:900px;
background:#333;
border:1px solid #999;
border-radius:10px;
margin-left:auto;
margin-right:auto;
}
</style>
</head>
<body>
 <table class="table table-striped"  width="100%" bgcolor="#FFFFFF">
<thead>
  <tr>
    <th>DEPENDENCIA</th><th>CONTROLADOR</th><th>FECHA Y HORA INICIO</th><th>FECHA Y HORA FINALIZACIÓN</th><th>EVENTO</th>
  </tr>
</thead>
<tbody>
<?php
include('./db_login.php');

$filecontents = file_get_contents('http://www.ivao.aero/schedule/indd.asp');
//$filecontents = file_get_contents('whazzup.txt'); //Testing file
$rows = split("\n", $filecontents);
$filepart = '';
$controllers = array();

 $var = 0;
foreach ($rows as $row) {

if (substr($rows,0,2) == '!') {
                $filepart = substr($rows,2);
        }


	$fields = split(":", $row);
	
	$pilotos = $fields[0];
	
	$rest = substr($pilotos, 0,2); 
	
	if ($rest == "SK") {
		
		$fechauno=$fields[6];
		$fechados=$fields[7];
		$fechaprimaria = substr($fechauno, 0, 4) . '-' . substr($fechauno, 4, 2) . '-' . substr($fechauno, 6, 2) . ' ' . substr($fechauno, 8, 2) . ':' . substr($fechauno, 10, 2) . ':' . substr($fechauno, 12, 2);
$fechasecundaria = substr($fechados, 0, 4) . '-' . substr($fechados, 4, 2) . '-' . substr($fechados, 6, 2) . ' ' . substr($fechados, 8, 2) . ':' . substr($fechados, 10, 2) . ':' . substr($fechados, 12, 2);
	
	$eventa= $fields[8];
	$infosp = substr($eventa, 0,1);
	
	if ($infosp=="h") {
		
		$infor = '<span class="label label-success"><a href="' . $eventa . '">Ver Evento</a></span>';
		
	} else {
	$infor='<span class="label label-warning">No hay evento.</span>';
	
	}
	
	
	
	
	$icaos=substr($fields[0],0,4);
	
	
	
	
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql399 ="select * from airports where ident='$icaos'";

	if (!$result399 = $db->query($sql399)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row399 = $result399->fetch_assoc()) {
		
        $callsignes= $row399["name"];
		$iso_country= $row399["iso_country"];
	}
	
	echo '<tr bgcolor="#FFFFFF"><td bgcolor="#FFFFFF"><img src="../admin/intranet/country-flags/' . $iso_country . '.png"><font color="black"> (' . $fields[0] . ')</font><br><font color="black"><b>' . $callsignes . '</b></font></td><td><a href="http://www.ivao.aero/members/person/details.asp?id=' . $fields[1] . '"><font color="red">' . $fields[1] . '</font></a></td><td><font color="black">' . $fechaprimaria . '</font></td><td><font color="black">' . $fechasecundaria . '</font></td><td><font color="black">' . $infor .'</font></td></tr>';


$var++;

} else 
	
	{
		
		
	}

}

echo '</tbody>
</table>';

if ($var == 0) {
	echo '<div class="alert alert-danger" role="alert">No hay reservas de dependencias ATC en el espacio aereo Colombiano</div>';
	
}

?>

</body>
</html>



 

	