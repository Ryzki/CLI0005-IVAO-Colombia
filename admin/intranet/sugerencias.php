


         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>IVAO Colombia</h2>   
                        <h5>Bienvenido <?php echo $nombres . ' ' . $apellidos; ?> , Encantado de volverte a ver. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mis Reclamos, Opiniones y Sugerencias.
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
                                        <div class="col-md-12">
                                            <div class="form-group">
											 <table class="table table-striped"  width="100%" >
<thead>
  <tr>
    <th>Titulo</th><th>Mensaje</th><th>Departamento</th><th>Fecha</th><th>Estado</th><th>OPCIONES</th>
  </tr>
</thead>
<tbody>
										
											<?php
											
											
											include('./db_login.php');
	
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3a ="select * from buzonmensajes where departamento='$idaa'";

	if (!$result3a = $db->query($sql3a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3a = $result3a->fetch_assoc()) {
		$titulo= $row3a["titulo"];
		$mensaje= $row3a["mensaje"];
		$departamento= $row3a["departamento"];
		$fecha= $row3a["fecha"];
		$estado = $row3a["estado"];
		
		
		$sql3aa ="select * from typestaff where id='$departamento'";

	if (!$result3aa = $db->query($sql3aa)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3aa = $result3aa->fetch_assoc()) {
	$departamentoa= $row3aa["nombre"];	
	}
	
	$conts=0;
	// Estado
// 0 = Nuevo
// 1 = Leido
// 2 = Respondido
// 3 = Nuevo mensaje
// 4 = Eliminado

if($estado==0) {
	$vares = '<span class="label label-success">Mensaje Recibido</span>';
} else if($estado==1) {
	$vares = '<span class="label label-warning">Mensaje Leído</span>';
} else if($estado==2) {
	$vares = '<span class="label label-danger">Mensaje Respondido</span>';
} else if($estado==3) {
	$vares = '<span class="label label-info">Mensaje Nuevo</span>';
}
	
if	($estado<>4) {
	$conts++;
		?>
		
		<tr>
		<td><?php echo $titulo; ?></td>
		<td><?php echo $mensaje; ?></td>
		<td><?php echo $departamentoa; ?></td>
		<td><?php echo $fecha; ?></td>
		<td><font color="black"><?php echo $vares; ?></font></td>
		<td><a href="./?page=versugerencias&id=<?php echo $row3a["id"]; ?>" class="btn btn-success" role="button">Responder</a>&nbsp;&nbsp;<a href="./?page=archivarsug&id=<?php echo $row3a["id"]; ?>" class="btn btn-danger" role="button">Eliminar</a></td>
		</tr>	
		<?
	}
	}
	
	?>
                                      
		</tbody>
</table>							
                   <?php

if($conts==0){
	
	echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">No hay reclamos, opiniones o sugerencias.</div></div>';
	
}		

?>
		   <div class="clearfix"></div>
                               
                            </div>
                        </div>
                    </div>
                  

                </div>
            </div>
        </div>
		 </div>
        </div>
		</div>


