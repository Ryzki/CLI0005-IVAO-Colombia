


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><font color="red">Sistema de Reclamos, Opiniones y Sugerencias.</font></h4>
                            </div>
							 <form   action="./?page=mensajesug" method="post">
                            <div class="content">
                               
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
											
											
											<?php
											date_default_timezone_set('America/Bogota');
											
											include('./db_login.php');
	$idaa = $user_array->division;
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from country_t where iso2='$idaa'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$short_name= $row3["short_name"];
	}
	
	
	
	
	



	?>
                                                <label>Fecha</label>
                                                <input type="text" name="fecha" class="form-control" disabled placeholder="Company" value="<?php echo date('Y-m-d'); ?>"/>
                                            </div>
                                        </div>
										 <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hora</label>
                                                <input type="text" name="hora" class="form-control" disabled placeholder="skype" value="<?php echo date('H:i:s'); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Código IVAO</label>
                                                <input type="text" name="vids" class="form-control" disabled placeholder="Username" value="<?php echo $user_array->vid; ?>"/>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" name="names" class="form-control" disabled placeholder="Company" value="<?php echo utf8_decode($user_array->firstname); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" name="surnames" class="form-control" disabled placeholder="Last Name" value="<?php echo utf8_decode($user_array->lastname); ?>"/>
                                            </div>
                                        </div>
                                    </div>

									  <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>División</label>
                                                <input type="text" name="division" class="form-control" disabled placeholder="City" value="<?php echo $short_name; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Departamento</label>
												<select class="form-control" name="departamento">
												<?php 
												
												$vids = $user_array->vid;

$sql3457a ="select * from typestaff";

	if (!$result3457a = $db->query($sql3457a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3457a = $result3457a->fetch_assoc()) {
		
		?>
		
		
  <option value="<?php echo $row3457a['id']; ?>"><?php echo $row3457a['nombre']; ?></option>

		
		
		<?php
		
	}
	?>
     </select>                                         
                                            </div>
                                        </div>
                                    </div>
									
                                   <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Titulo</label>
                                                <input type="text" name="titulos" class="form-control" placeholder="Titulo del Mensaje" value=""/>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>URL de IMAGEN <font color="red">*Opcional</font></label>
                                                <input type="text" name="urls" class="form-control" placeholder="Titulo del Mensaje" value=""/>
                                            </div>
                                        </div>
                                    </div> 
									
									 <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mensaje</font></label>
                                                <textarea name="comment" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div> 

									
 <button type="submit" class="btn btn-info btn-fill pull-right">Enviar Mensaje</button>
								
                                    <div class="clearfix"></div>
                               
                            </div>
								</form>
                        </div>
                    </div>
					
					
					
					
					
					
					
					
					
					<div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><font color="red">Mis Reclamos, Opiniones y Sugerencias.</font></h4>
                            </div>
                            <div class="content">
                                
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
	$vidsa = $user_array->vid;
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3a ="select * from buzonmensajes where vidusuario='$vidsa'";

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
	$vares = '<span class="label label-success">Mensaje Enviado</span>';
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
		<td><a href="./?page=versugerencias&id=<?php echo $row3a["id"]; ?>" class="btn btn-success" role="button">Responder</a>&nbsp;&nbsp;<a href="./?page=archivarsug&id=<?php echo $row3a["id"]; ?>" class="btn btn-danger" role="button">Archivar</a></td>
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

