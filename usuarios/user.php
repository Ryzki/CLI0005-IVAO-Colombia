


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Editar Perfil</h4>
                            </div>
                            <div class="content">
                                <form>
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
	
	
	$idaaa = $user_array->division;
	

	
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
	?>
                                                <label>Division</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo $short_name; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Código IVAO</label>
                                                <input type="text" class="form-control" disabled placeholder="Username" value="<?php echo $user_array->vid; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Skype</label>
                                                <input type="email" class="form-control" disabled placeholder="email" value="<?php echo $user_array->skype; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="<?php echo utf8_decode($user_array->firstname); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" disabled placeholder="Last Name" value="<?php echo utf8_decode($user_array->lastname); ?>">
                                            </div>
                                        </div>
                                    </div>

                                 <!--   <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Horas como Piloto</label>
                                                <input type="text" class="form-control" disabled placeholder="Home Address" value="<?php echo $user_array->hours_pilot; ?>">
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>División Vista</label>
                                                <input type="text" class="form-control" disabled placeholder="City" value="IVAO Colombia!">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>País</label>
                                                <input type="text" class="form-control" disabled placeholder="Country" value="<?php echo $short_name4; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Código Postal</label>
                                                <input type="number" class="form-control" disabled placeholder="ZIP Code" value="<?php echo $calling_code; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Actualizar Perfil</button>
                                    <div class="clearfix"></div>
                                </form>
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
                                    <img class="avatar border-gray" src="assets/img/faces/face-3.jpg" alt="..."/>

                                      <h4 class="title"><?php echo utf8_decode($user_array->firstname) . ' ' . utf8_decode($user_array->lastname); ?><br />
                                         <small><?php echo $user_array->skype; ?></small>
                                      </h4>
                                    </a>
                                </div>
								<br>
								<hr>
                                <p class="description text-center">
								<b>Rango PCA &nbsp;&nbsp;</b>  <img  src="https://www.ivao.aero/data/images/ratings/pilot/<?php echo $user_array->ratingatc ?>.gif" alt="..."/><br>
                                <b>Rango ATC &nbsp;&nbsp;</b> <img  src="https://www.ivao.aero/data/images/ratings/atc/<?php echo $user_array->ratingpilot ?>.gif" alt="..."/><br>
                                                   
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

