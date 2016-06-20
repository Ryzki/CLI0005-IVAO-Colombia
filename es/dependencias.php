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
 <table class="table table-striped" width="100%">
<thead>
  <tr>
    <th>DEPENDENCIA</th><th>CONTROLADOR</th><th>FECHA Y HORA INICIO</th><th>FECHA Y HORA FINALIZACIÓN</th><th>EVENTO</th>
  </tr>
</thead>
<tbody>
<?php


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
		$infor = '<a href"' . $eventa . '">Ver Evento</a>';
	
	
	
echo '<tr><td>' . $fields[0] . '</td><td>' . $fields[1] . '</td><td> ' . $fechaprimaria . '</td><td>' . $fechasecundaria . '</td><td>' . $infor .'</td></tr>';

$var++;

} else 
	
	{
		
		
	}

}

echo '</tbody>
</table>';

if ($var == 0) {
	echo "No hay reservas de dependencias ATC en el espacio aereo Colombiano";
	
}

?>

</body>
</html>



 

	