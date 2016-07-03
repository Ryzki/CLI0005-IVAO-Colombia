<style>
.button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.button1 {
    background-color: #f44336;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.button2 {width: 100%;}
</style>
        <div class="content">
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Eventos ATC Reserva</h4>
                                <p class="category">Realizado por IVAO Colombia.</p>
                            </div>
                            <div class="content">
							<div class="table-full-width">
							<table class="table">
							<tr>
							 <?php
											
											
											include('./db_login.php');
	
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
$pp=0;
	
	$sql3 ="select * from eventosatc";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$pp++;
		$short_name= $row3["titulo"] . ' ' . $row3["fecha"] . ' (' . $row3["horario_inicio"] . ' Z ' . $row3["horario_fin"] . ' Z)';
		?>
	
                                <div class="col-md-12">
                                    <button class="button button2" onclick="location='./?page=modulosveratcevento&id=<?php echo $row3["id"]; ?>'"><?php echo $short_name; ?></button>
                               <br><br></div>
	<? } 
	
	

if($pp==0){
	
	echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">No hay eventos ATC creados.</div></div>';
	
}		

?>      
	</tr>
	</table>
</div>
                          
                            </div>
                        </div>
                    </div>
					
					
					  
					
					
					
					
					
					
					
					
					</div>
					</div>