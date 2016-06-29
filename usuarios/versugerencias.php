


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><font color="red">Sistema de Reclamos, Opiniones y Sugerencias.</font></h4>
                            </div>
							
                            <div class="content">
                               
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
										<style type="text/css">	
											#chat{
			background-color: #eee;
			margin: 20px auto 0;
			width: 900px;
		}
		#chat #header-chat{
			background-color: #555;
			color: white;
			padding: 10px;
			text-align: center;
			text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
		}
		
		#caja-mensaje{
	background-color: #A8DCF7;
	margin: 0 auto;
	padding: 10px;
	width: 900px;
}
#caja-mensaje input{
	border: solid 1px #4193BF;
	outline: none;
	padding: 10px;
	width: 810px;
}
#caja-mensaje button{
	border: 0;
	background-color: #4193BF;
	color: white;
	font-size: 16px;
	padding: 8px;
	width: 50px;
}

#chat #mensajes{
	padding: 10px;
	height: 400px;
	width: 900px;
	overflow: hidden;
	overflow-y: scroll 
}

#chat #mensajes .mensaje-autor{
	margin-bottom: 50px;

}
#chat #mensajes .mensaje-autor img, #chat #mensajes .mensaje-amigo img{
	display: inline-block;
	vertical-align: top;
}
#chat #mensajes .mensaje-autor .contenido{
	background-color: white;
	border-radius: 5px;
	box-shadow: 2px 2px 3px rgba(0,0,0,0.3);
	display: inline-block;
	font-size: 13px;
	padding: 15px;
	vertical-align: top;
	width: 780px;
}
#chat #mensajes .mensaje-autor .fecha{
	color: #777;
	font-style: italic;
	font-size: 13px;
	text-align: right;
	margin-right: 35px;
	margin-top: 10px;
}
#chat #mensajes .mensaje-autor .flecha-izquierda{
	display: inline-block;
	margin-right: -6px;
	margin-top: 10px;
	width: 0; 
	height: 0; 
	border-top: 0px solid transparent;
	border-bottom: 15px solid transparent;
	border-right: 15px solid white;
}

#chat #mensajes .mensaje-amigo{
	margin-bottom: 50px;
}
#chat #mensajes .mensaje-amigo .contenido{
	background-color: #3990BF;
	border-radius: 5px;
	color: white;
	display: inline-block;
	font-size: 13px;
	padding: 15px;
	vertical-align: top;
	width: 780px;
}
#chat #mensajes .mensaje-amigo .flecha-derecha{
	display: inline-block;
	margin-left: -6px;
	margin-top: 10px;
	width: 0; 
	height: 0; 
	border-top: 0px solid transparent;
	border-bottom: 15px solid transparent;
	border-left: 15px solid #3990BF;
}
#chat #mensajes .mensaje-amigo img, #chat #mensajes .mensaje-autor img{
	border-radius: 5px;
}
#chat #mensajes .mensaje-amigo .fecha{
	color: #777;
	font-style: italic;
	font-size: 13px;
	text-align: left;
	
	margin-top: 10px;
}
		
		</style>
					<?php 
											
							
							
											include('./db_login.php');
	$id = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3a ="select * from buzonmensajes where id='$id'";

	if (!$result3a = $db->query($sql3a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3a = $result3a->fetch_assoc()) {
		$titulo= $row3a["titulo"];
		$mensaje= $row3a["mensaje"];
		$departamento= $row3a["departamento"];
		$fechaa= $row3a["fecha"];
		
	}
	
	date_default_timezone_set('America/Bogota');
	
	$vids = $user_array->vid;

$sql3457a ="select * from usuariosivao where vid=$vids";

	if (!$result3457a = $db->query($sql3457a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3457a = $result3457a->fetch_assoc()) {
		
		
			$imagena = $row3457a['foto'];
			$emails = $row3457a['email'];
			
			if($imagena!=""){
				$imageness = "./assets/img/faces/" . $row3457a['foto'];
				
			} else {
				$imageness = "assets/img/faces/face-3.jpg";
			}
		
	}
	
	
	
	$fechaprimaria = $fechaa;
$fechasecundaria = date('Y-m-d H:i:s');



$fechass = $fechasecundaria;
$fechassa = $fechaprimaria;

$fecha1 = new DateTime($fechass);
$fecha2 = new DateTime($fechassa);
$fecha = $fecha1->diff($fecha2);
	?>				
										<div id="chat">
	<div id="header-chat">
		<?php echo utf8_decode($user_array->firstname) . ' ' . utf8_decode($user_array->lastname) . ' -  Tema: ' . $titulo; ?>
	</div>
	<div id="mensajes">
	
		<div class="mensaje-autor">
			<img src="<?php echo $imageness; ?>" alt="" class="foto" width="5%">
			<div class="flecha-izquierda"></div>
			<div class="contenido">
				<?php echo $mensaje; ?>
			</div>
			<div class="fecha">Enviado hace <?php printf('%d h  %d minutos', $fecha->h, $fecha->i); ?></div>
		</div>

		<?php 
											
											
											
	$id = $_GET['id'];
	
	

	
	$sql3ap ="select * from respuestasdelbuzon where idmensaje='$id' order by fecha desc";

	if (!$result3ap = $db->query($sql3ap)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3ap = $result3ap->fetch_assoc()) {
		if($row3ap["staff"]!=""){
			
			
	$fechaprimariae = $row3ap["fecha"];		
			
			
$fechasse = $fechasecundaria;
$fechassae = $fechaprimariae;

$fecha1e = new DateTime($fechasse);
$fecha2e = new DateTime($fechassae);
$fechae = $fecha1e->diff($fecha2e);
			?>
			
			<div class="mensaje-amigo">
			<div class="contenido">
				<?php echo $row3ap["mensaje"]; ?>
			</div>
			<div class="flecha-derecha"></div>
			<img src="assets/img/faces/face-3.jpg" alt="" class="foto" width="5%">
			<div class="fecha">Enviado hace <?php printf('%d h  %d minutos', $fechae->h, $fechae->i); ?></div>
		</div>
			
			
			<?php
		} else if($row3ap["vid"]!=""){
			
				$fechaprimariaee = $row3ap["fecha"];		
			
			
$fechassee = $fechasecundaria;
$fechassaee = $fechaprimariaee;

$fecha1ee = new DateTime($fechassee);
$fecha2ee = new DateTime($fechassaee);
$fechaee = $fecha1ee->diff($fecha2ee);
			?>
			
			<div class="mensaje-autor">
			<img src="<?php echo $imageness; ?>" alt="" class="foto" width="5%">
			<div class="flecha-izquierda"></div>
			<div class="contenido">
				<?php echo $row3ap["mensaje"]; ?>
			</div>
			<div class="fecha">Enviado hace <?php printf('%d h  %d minutos', $fechaee->h, $fechaee->i); ?></div>
		</div>
			
			
			<?php 
			
		}
		
		
	}
	
	?>	
		
	</div>

</div>
 <form   action="./?page=addmensaje" method="post">
<div id="caja-mensaje">
	<input type="text" name="infos" placeholder="Escribir mensaje..."/>
	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
	<button type="submit">&#8594; </button>
</div>	
</form>
										
                                         
                                    </div>

                                  
		   <div class="clearfix"></div>
                               
                            </div>
                        </div>
                    </div>
                  

                </div>
            </div>
        </div>
</div>
        </div>
