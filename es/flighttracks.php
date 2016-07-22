<div class="container">
<?php

	$cs = $_GET['cs'];
	



	
			
$filecontents = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = split("\n", $filecontents);
foreach ($rows as $row) {

	$fields = split(":", $row);
	
if ($fields[0]==$cs) {
	
$callsign = $fields[0];
$vid = $fields[1];
$nombres = $fields[2];
$posicionuna = $fields[5];				  
$posiciondos = $fields[6];	
$altitud = $fields[7];
$groundspeed = $fields[8];	
$aeronave = substr($fields[9], 2, 4);		
$tipes = substr($fields[9], 7, 1);	
$cruisingspeed = $fields[10];
$departure = $fields[11];	
$requestlevel = $fields[12];	
$arrival = $fields[13];	
$trasponder = $fields[17];	
$ranks = $fields[41];	//26
$rmk = $fields[29];	
$ruta = $fields[30];	
$rumbo = $fields[45];					
$fechados = $fields[37];	


}




}

if ($tipes == "L") {
	$tipe ="Light";
} else if ($tipes == "M") {
	$tipe ="Medium";
	
} else if ($tipes == "H") {
	$tipe ="Heavy";
	
}


if ($ranks==1){
	$rank="Observer (OBS)";
} else if ($ranks==2){
	$rank="Basic Flight Student (FS1)";
} else if ($ranks==3){
	$rank="Flight Student (FS2)";
} else if ($ranks==4){
	$rank="Advanced Flight Student (FS3)";
} else if ($ranks==5){
	$rank="Private Pilot (PP)";
} else if ($ranks==6){
	$rank="Senior Private Pilot (SPP)";
} else if ($ranks==7){
	$rank="Commercial Pilot (CP)";
} else if ($ranks==8){
	$rank="Airline Transport Pilot (ATP)";
} else if ($ranks==9){
	$rank="Senior Flight Instructor (SFI)";
} else if ($ranks==10){
	$rank="Chief Flight Instructor (CFI)";
} else if ($ranks==11){
	$rank="Supervisor (SUP)";
} else if ($ranks==12){
	$rank="Administrator (ADM)";
}

$fechaprimaria = date("Y-m-d H:i:s");  
$fechasecundaria = substr($fechados, 0, 4) . '-' . substr($fechados, 4, 2) . '-' . substr($fechados, 6, 2) . ' ' . substr($fechados, 8, 2) . ':' . substr($fechados, 10, 2) . ':' . substr($fechados, 12, 2);



$fechass = $fechasecundaria;
$fechassa = $fechaprimaria;

$fecha1 = new DateTime($fechass);
$fecha2 = new DateTime($fechassa);
$fecha = $fecha1->diff($fecha2);





	?>
<h1><font color="red">Información de Piloto</font></h1>
<hr>
<br>
<h3><b>Piloto</b></h3>
 <div class="form-group">
          <label>Nombre Piloto</label>
          <input class="form-control" name="1" value="<?php echo $nombres; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>VID IVAO</label>
          <input class="form-control" name="2" value="<?php echo $vid; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Rango IVAO</label>
          <input class="form-control" name="3" value="<?php echo $rank; ?>" readonly="readonly"/>
 </div>
 <br>
<h3><b>Plan de Vuelo</b></h3>
 <div class="form-group">
          <label>Origen</label>
          <input class="form-control" name="14" value="<?php echo $departure; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Destino</label>
          <input class="form-control" name="24" value="<?php echo $arrival; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Nivel de Vuelo</label>
          <input class="form-control" name="34" value="<?php echo $altitud; ?> ft AMSL" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Velocidad</label>
          <input class="form-control" name="34" value="<?php echo $groundspeed; ?> kts" readonly="readonly"/>
 </div>
 <div class="form-group">
                                            <label>Ruta</label>
											<textarea class="form-control" name="info" readonly="readonly" ><?php echo $ruta; ?></textarea>
                                        </div>
										 <div class="form-group">
                                            <label>Remarks</label>
											<textarea class="form-control" name="info" readonly="readonly" ><?php echo $rmk; ?></textarea>
                                        </div>
										<h3><b>Aeronave</b></h3>
										 <div class="form-group">
          <label>Tipo</label>
          <input class="form-control" name="34" value="<?php echo $aeronave; ?>" readonly="readonly"/>
 </div>
  <div class="form-group">
          <label>Categoria</label>
          <input class="form-control" name="34" value="<?php echo $tipe; ?>" readonly="readonly"/>
 </div>
										
									
  <div class="form-group">
          <label>Tiempo en línea</label>
          <input class="form-control" name="34" value="<?php printf('%d h  %d minutos', $fecha->h, $fecha->i); ?>" readonly="readonly"/>
 </div>
 
  <div class="form-group">
          <label>Ubicación del Control</label>
         
		 <td ><iframe src="./mappca.php?ubicacion=<?php echo $posicionuna; ?>&ubicaciondos=<?php echo $posiciondos; ?>&icaos=<?php echo $cs; ?>&freq=<?php echo $departure . ' - ' . $arrival ; ?>&rank=<?php echo $aeronave; ?>&vid=<?php echo $vid; ?>&name=<?php echo $nombres; ?>&hdg=<?php echo $rumbo; ?>&altura=<?php echo $altitud; ?>&speed=<?php echo $groundspeed; ?>" width="100%" height="600px"></iframe></td>
		 
		 
 </div>
 
 
 </div>