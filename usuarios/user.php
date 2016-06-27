


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil</h4>
                            </div>
                            <div class="content">
                                
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
	
	
	$idaaa = $user_array->country;
	

	
	$sql34 ="select * from country_t where iso2='$idaaa'";

	if (!$result34 = $db->query($sql34)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row34 = $result34->fetch_assoc()) {
		$short_name4= $row34["short_name"];
		$calling_code= $row34["calling_code"];
	}
	
	$ii=0;
		$sql345 ="select * from airlines";

	if (!$result345 = $db->query($sql345)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row345 = $result345->fetch_assoc()) {
		$ii++;
	}
	
	$aleatorio = rand(1, $ii);
	$iip=0;
	
	
	$sql3457 ="select * from airlines";

	if (!$result3457 = $db->query($sql3457)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3457 = $result3457->fetch_assoc()) {
		$iip++;
		if($iip==$aleatorio) {
			$imagen = "../admin/intranet/imagenair/" . $row3457['imagen_va'];
		}
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
	?>
                                                <label>Division</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo $short_name; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Código IVAO</label>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="<?php echo $user_array->vid; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Skype</label>
                                                <input type="email" class="form-control" disabled placeholder="skype" value="<?php echo $user_array->skype; ?>"/>
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Rangos</label>
                                                <input type="text" class="form-control" disabled placeholder="Home Address" value="Piloto: <?php echo $rank; ?> & Controlador: <?php echo $rank2; ?>"/>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>División Vista</label>
                                                <input type="text" class="form-control" disabled placeholder="City" value="IVAO Colombia!"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>País</label>
                                                <input type="text" class="form-control" disabled placeholder="Country" value="<?php echo $short_name4; ?>"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Código Postal</label>
                                                <input type="number" class="form-control" disabled placeholder="ZIP Code" value="<?php echo $calling_code; ?>"/>
                                            </div>
                                        </div>
                                    </div>
<form  enctype="multipart/form-data" action="./page=usuarioactualizado" method="post">
									<div class="row">
									<div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>Registra Tu Correo Electrónico!</b></label>
                                                <input name="email" class="form-control" value="<?php echo $emails; ?>" placeholder="cuenta@dominio.com" />
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="form-group">
                                                <label><b>Subir Su Imagen! <font color="red">120 px * 120px</font></b></label>
                                                <input name="image_file"  type="file">
                                            </div>
                                        </div>
										 <input type="hidden" class="form-control" name="id" value="<?php echo $user_array->vid;?>"/>
                                   
                                    </div>
 <button type="submit" class="btn btn-info btn-fill pull-right">Actualizar Perfil</button>
									</form>
                                    <div class="clearfix"></div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="<?php echo $imagen; ?>" alt="..." width="30%"/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="<?php echo $imageness; ?>" alt="..."/>

                                      <h4 class="title"><?php echo utf8_decode($user_array->firstname) . ' ' . utf8_decode($user_array->lastname); ?><br />
                                         <small><?php echo $user_array->skype; ?></small>
                                      </h4>
                                    </a>
                                </div>
								<br>
								<hr>
                                <p class="description text-center">
								<b>Rango PCA &nbsp;&nbsp;</b>  <img  src="https://www.ivao.aero/data/images/ratings/pilot/<?php echo $user_array->ratingpilot; ?>.gif" alt="..."/><br>
                                <b>Rango ATC &nbsp;&nbsp;</b> <img  src="https://www.ivao.aero/data/images/ratings/atc/<?php echo $user_array->ratingatc; ?>.gif" alt="..."/><br>
                                                   
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

