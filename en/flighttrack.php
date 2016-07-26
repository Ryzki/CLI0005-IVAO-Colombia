<div class="container">
<?php

	$cs = $_GET['cs'];
	

$ctrlevel = array(
   1 => 'OBS',
   2 => 'AS1',
   3 => 'AS2',
   4 => 'AS3',
   5 => 'ADC',
   6 => 'ADP',
   7 => 'ACC',
   8 => '<span class="green">SEC</span>',
   9 => '<span class="green">SAI</span>',
  10 => '<span class="green">CAI</span>',
  11 => '<span class="red">SUP</span>',
  12 => '<span class="red">ADM</span>'
);

	
			
$filecontents = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = split("\n", $filecontents);
foreach ($rows as $row) {

	$fields = split(":", $row);
	
if ($fields[0]==$cs) {
	
$dependencia = $fields[0];
$vid = $fields[1];
$nombres = $fields[2];
$frecuencia = $fields[4];
$posicionuna = $fields[5];				  
$posiciondos = $fields[6];	
$atis = utf8_encode($fields[35]);	
$fechauno = $fields[36];					
$fechados = $fields[37];	

 $level = $ctrlevel[$fields[16]];
 $pesos = substr($dependencia,5,3);
 $spotes = $pesos;
}




}

$fechaprimaria = substr($fechauno, 0, 4) . '-' . substr($fechauno, 4, 2) . '-' . substr($fechauno, 6, 2) . ' ' . substr($fechauno, 8, 2) . ':' . substr($fechauno, 10, 2) . ':' . substr($fechauno, 12, 2);
$fechasecundaria = substr($fechados, 0, 4) . '-' . substr($fechados, 4, 2) . '-' . substr($fechados, 6, 2) . ' ' . substr($fechados, 8, 2) . ':' . substr($fechados, 10, 2) . ':' . substr($fechados, 12, 2);

$resultado = str_replace("^§", ". &nbsp;", $atis);

$fechass = $fechasecundaria;
$fechassa = $fechaprimaria;

$fecha1 = new DateTime($fechass);
$fecha2 = new DateTime($fechassa);
$fecha = $fecha1->diff($fecha2);

if ($spotes=="DEL") {
	
	$infors = "Delivery Controller";
} else if ($spotes=="GND") {
	
	$infors = "Ground Controller";
} else if ($spotes=="TWR") {
	
	$infors = "Tower Controller";
} else if ($spotes=="DEP") {
	
	$infors = "Departures Controller";
} else if ($spotes=="APP") {
	
	$infors = "Approach Controller";
} else if ($spotes=="CTR") {
	
	$infors = "Center Controller";
} else if ($spotes=="FSS") {
	
	$infors = "Flight Service Controller";
} 



	?>
<h1><font color="red">Air Controller's Information</font></h1>
<hr>
<br>
<h3><b>Controller</b></h3>
 <div class="form-group">
          <label>Controller Name</label>
          <input class="form-control" name="1" value="<?php echo $nombres; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>VID IVAO</label>
          <input class="form-control" name="2" value="<?php echo $vid; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>IVAO Rank</label>
          <input class="form-control" name="3" value="<?php echo $level; ?>" readonly="readonly"/>
 </div>
 <br>
<h3><b>Place</b></h3>
 <div class="form-group">
          <label>Controller Callsign</label>
          <input class="form-control" name="14" value="<?php echo $dependencia; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Position</label>
          <input class="form-control" name="24" value="<?php echo $infors; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Frequency</label>
          <input class="form-control" name="34" value="<?php echo $frecuencia; ?>" readonly="readonly"/>
 </div>
 <div class="form-group">
                                            <label>ATIS</label>
											<textarea class="form-control" name="info" readonly="readonly" ><?php echo $resultado; ?></textarea>
                                        </div>
										
									
  <div class="form-group">
          <label>Time Online</label>
          <input class="form-control" name="34" value="<?php printf('%d h  %d minutos', $fecha->h, $fecha->i); ?>" readonly="readonly"/>
 </div>
 
  <div class="form-group">
          <label>ATC's Location</label>
         
		 <td ><iframe src="./mapatc.php?ubicacion=<?php echo $posicionuna; ?>&ubicaciondos=<?php echo $posiciondos; ?>&icaos=<?php echo $dependencia; ?>&freq=<?php echo $frecuencia; ?>&spot=<?php echo $infors; ?>&rank=<?php echo $level; ?>&vid=<?php echo $vid; ?>&name=<?php echo $nombres; ?>" width="100%" height="600px"></iframe></td>
		 
		 
 </div>
 
 
 </div>