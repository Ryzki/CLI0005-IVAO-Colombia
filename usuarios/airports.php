
								
								
						   	 <div class="content"> 
							
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Información de Aeropuertos</h4>
                            </div>
                            <div class="content">
							<div class="table-full-width">
							<table class="table">
							<tr><td>	
							
							
				<form   action="./?page=airport_info" method="post">		
 <div class="form-group">
                                            <label>Aeropuerto a Consultar</label>
						<select class="form-control" name="airport">					
<?php
header('Content-Type: text/html; charset=UTF-8');  
include('./db_login.php');


	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select DISTINCT * from airports where iso_country='CO' order by ident desc";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		
        $ids= $row3["id"];
		$icao= $row3["ident"];
		$name= $row3["name"];
	
$namea = $name;

  
	
	

	
	

		

	?>

											
  <option value="<?php echo $icao; ?>"><?php echo  $icao; ?></option>
	<? } ?>
</select>
<br>
<br>
<button type="submit" class="btn btn-info btn-fill pull-right">Buscar Información</button>
</form> </div>	
</td></tr></table>
                                       		

                                 
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
      