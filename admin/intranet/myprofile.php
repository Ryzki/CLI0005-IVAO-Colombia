
	
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
                            Información Personal
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
							
                                <div class="col-md-6">
								
								
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombres; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
                                            <label>Apellidos</label>
                                           <input class="form-control" name="icaossa" value="<?php echo $apellidos; ?>" readonly="readonly" />
											
                                        </div>
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="icaoss" value="<?php echo $email; ?>"/ readonly="readonly" >
											
                                        </div>
										 <div class="form-group">
                                            <label>VID IVAO</label>
											<input class="form-control" name="icao" value="<?php echo $vid_ivao; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>Primer IP</label>
											<input class="form-control" name="iata" value="<?php echo $ip_first; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>Última Visita</label>
											<input class="form-control" name="radio" value="<?php echo $last_visit_date . ' (' . $last_ip . ')'; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>Cargo Staff</label>
											<input class="form-control" name="radaio" value="<?php echo $cargol . ' (CO' . $posl . ')'; ?>" readonly="readonly" />
                                        </div>
										
										
										<br>
										<hr>
										
										<h2>Actualizar Perfil</h2>
										
										  <form action="./?page=actualizarperfil" method="post" >
										<div class="form-group">
                                            <label>Email</label>
											<input class="form-control" name="email" value="<?php echo $email; ?>" />
                                        </div>
										<div class="form-group">
                                            <label>Clave</label>
                                            <input class="form-control" name="pass" value=""  />
                                        </div>
										
										 <button type="submit" class="btn btn-default">Actualizar Información</button>
										 </form>
										

                                 
                                </div>
								
								
								
									   
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