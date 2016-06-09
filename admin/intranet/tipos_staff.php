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
                            Tipos de Staff
                        </div>
                        <div class="panel-body">
                            <div class="row">
<<<<<<< HEAD
                                <div class="col-md-6">
=======
                                
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e
                                    <h3>IVAO AERO</h3>
                                    <form role="form" action="./register_staff.php" method="post">
                                        <div class="form-group">
                                            <label>Nombre Posicion</label>
                                            <input class="form-control" name="callsign" />
                                        </div>
										
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" />
                                        </div>
										
										<div class="form-group">
                                            <label>Grupo de Posicion</label>
										<select name="pst">
										<?php
										
										include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sql = "SELECT * FROM typestaff";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		
  echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
  
	}
  
  ?>
</select>
	</div>									
										<div class="form-group">
                                            <label>Posicion Callsign</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="-DIR" checked />Director
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="-ADIR"/>Assistant Director
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="-SOC"/>Special Operations Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios4" value="-SOAC"/>Special Operations Assistant Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios5" value="-FOC"/>Flight Operations Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios6" value="-FOAC"/>Flight Operations Assistant Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios7" value="-AOC"/>ATC Operations Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios8" value="-AOAC"/>ATC Operations Assistant Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios9" value="-TC"/>Training Coordinator
                                                </label>
                                            </div>
											 <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios10" value="-TAC"/>Training Assistant Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios11" value="-TA1"/>Division Training Advisor 1
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios12" value="-TA2"/>Division Training Advisor 2
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios13" value="-TA3"/>Division Training Advisor 3
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios14" value="-TA4"/>Division Training Advisor 4
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios15" value="-MC"/>Membership Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios16" value="-MAC"/>Membership Assistant Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios17" value="-MA2"/>Membership Advisor 2
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios18" value="-EC"/>Event Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios19" value="-EAC"/>Event Assistant Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios20" value="-EA1"/>Division Event Advisor 1
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios21" value="-PRC"/>Public Relations Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios22" value="-PRAC"/>Public Relations Assistant Coordinator
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios23" value="-WM"/>Webmaster	
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios24" value="-AWM"/>Assistant Webmaster
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios25" value="-CH"/>Barranquilla Center Chief
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios26" value="-CH"/>Bogota FIR Chief
                                                </label>
                                            </div>
											<div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios27" value="-ACH"/>Bogota FIR Assistant Chief
                                                </label>
                                            </div>
                                        </div>
										
										
								
<<<<<<< HEAD
                                        <button type="submit" class="btn btn-default">Añadir Tipo Staff</button>
=======
                                        <button type="submit" class="btn btn-default">Submit Button</button>
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e

                                    </form>
                                  

                                 
<<<<<<< HEAD
                                </div>
=======
                                
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
                <!-- /. ROW  -->
             
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>        