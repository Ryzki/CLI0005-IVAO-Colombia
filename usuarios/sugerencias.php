


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Sistema de Reclamos, Opiniones y Sugerencias.</h4>
                            </div>
                            <div class="content">
                                <form  enctype="multipart/form-data" action="./page=mensajesug" method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
											
											
											<?php
											
											
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
	
	
	
	
	
	
	
	
	
	$ranks= $user_array->ratingpilot;
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



$ranks2= $user_array->ratingatc;
	if ($ranks2==1){
	$rank2="Observer (OBS)";
} else if ($ranks2==2){
	$rank2="ATC Applicant (AS1)";
} else if ($ranks2==3){
	$rank2="ATC Trainee (AS2)";
} else if ($ranks2==4){
	$rank2="Advanced ATC Trainee (AS3)";
} else if ($ranks2==5){
	$rank2="Aerodrome Controller (ADC)";
} else if ($ranks2==6){
	$rank2="Approach Controller (APC)";
} else if ($ranks2==7){
	$rank2="Centre Controller (ACC)	";
} else if ($ranks2==8){
	$rank2="Senior Controller (SEC)";
} else if ($ranks2==9){
	$rank2="Senior ATC Instructor (SAI)";
} else if ($ranks2==10){
	$rank2="Chief ATC Instructor (CAI)";
} else if ($ranks2==11){
	$rank2="Supervisor (SUP)";
} else if ($ranks2==12){
	$rank2="Administrator (ADM)";
}



	?>
                                                <label>Fecha</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo date('Y-m-d'); ?>"/>
                                            </div>
                                        </div>
										 <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hora</label>
                                                <input type="email" class="form-control" disabled placeholder="skype" value="<?php echo date('H:i:s'); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Código IVAO</label>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="<?php echo $user_array->vid; ?>"/>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo utf8_decode($user_array->firstname); ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" disabled placeholder="Last Name" value="<?php echo utf8_decode($user_array->lastname); ?>"/>
                                            </div>
                                        </div>
                                    </div>

									  <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>División</label>
                                                <input type="text" class="form-control" disabled placeholder="City" value="<?php echo $short_name; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Departamento</label>
												<select class="form-control" name="">
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
                                                <input type="text" class="form-control" placeholder="Titulo del Mensaje" value=""/>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>URL de IMAGEN <font color="red">*Opcional</font></label>
                                                <input type="text" class="form-control" placeholder="Titulo del Mensaje" value=""/>
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
									</form>
                                    <div class="clearfix"></div>
                               
                            </div>
                        </div>
                    </div>
                  

                </div>
            </div>
        </div>

