	<?php 

$ida = $_GET['id'];
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql25a = "SELECT * FROM eventosatc where id='$ida'";

	if (!$result25a = $db->query($sql25a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row25a = $result25a->fetch_assoc()) {
		$titulos = $row25a['titulo'];
		$horario_inicio = $row25a['horario_inicio'];
		$horario_fin = $row25a['horario_fin'];
		$fechas = $row25a['fecha'];
		$informacions = utf8_decode($row25a['informacion']);
		
		
	}
?>
<style>
.button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.button1 {
    background-color: #f44336;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.button2 {width: 100%;}
</style>
        <div class="content">
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="title">Evento <b><?php $titulos; ?></b> ATC Reserva</h2>
                                <p class="category">Realizado por IVAO Colombia.</p>
								<hr>
								<h4>Fecha: <?php echo $fechas; ?></h4><br>
								<h4>Hora Inicio ZULU: <?php echo $horario_inicio; ?></h4><br>
								<h4>Hora Fin ZULU: <?php echo $horario_fin; ?></h4><br>
								<h4>Información: <?php echo $informacions; ?></h4><br>
								
								<br>
								<hr>
								<h2>Aeropuertos o Dependencias del Evento:</h2>
								<br>
                            </div>
                            <div class="content">
							<div class="table-full-width">
							<table class="table">
							<tr>
							 <?php
											
								$plasa=0;			
					
	$sql3 ="select * from eventosatcaeropuertos where ideventoatc='$ida'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$plasa++;
		$short_name= $row3["icao"];
		?>
	
                                <div class="col-md-12">
                                    <button class="button button2" onclick="location='./?page=veraeropuertoevento&id=<?php echo $row3["icao"]; ?>'"><?php echo $short_name; ?></button>
                               <br><br></div>
	<? } 
	
	if($plasa==0){
		
		echo ' <div class="col-md-12"><div class="alert alert-danger" role="alert">No hay aeropuertos agregados al evento.</div></div>';
	}?>
	</tr>
	</table>
	
</div>
                    
                            </div>
				     
                        </div>
						
                    </div>
					 </div>
                        </div>
                    </div>