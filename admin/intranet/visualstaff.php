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
                            Administración de Staff 
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombres y Apellidos</th><th>Vid IVAO</th><th>Primer IP</th><th>Último IP y Fecha</th><th>Email</th><th>Cargo</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM staff";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];

			$pid =  $row2['staff_ivao'];
			
			
			$sql3 = "SELECT * FROM ranks where id=$pid";

	if (!$result3 = $db->query($sql3)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row3 = $result3->fetch_assoc()) {
		
		$callsign_name =  $row3['callsign'];
		
		$spot =  $row3['posicion'];
		
	}
	
		
			
			echo' <tr>
	<td>' . $row2['nombres'] . ' ' . $row2['apellidos'] . '</td>
	<td><a href="https://www.ivao.aero/Member.aspx?ID=' . $row2['vid_ivao'] . '">' . $row2['vid_ivao'] . '</a></td>
	<td>' . $row2['ip_first'] . '</td>
	<td>' . $row2['last_visit_date'] . ' (' . $row2['last_ip'] . ')</td>
	<td>' . $row2['email'] . '</td>
	<td>' . $callsign_name . '  <img border="0" src="https://www.ivao.aero/data/images/badge/' . $spot .'.gif"><img border="0" src="https://www.ivao.aero/data/images/badge/CO.gif"></td>
	
	
	<td><form  action="?page=deletestaff&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
  </tr>';


	}
	
   
						
   ?> 
					  

</tbody>
</table>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
					
					
					
					
                </div>
            </div>
                <!-- /. ROW  -->
               
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>        