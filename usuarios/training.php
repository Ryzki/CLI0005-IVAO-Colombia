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
        <div class="content" style="background-image: url(http://www.financecolombia.com/wp-content/uploads/2015/06/copa-and-avianca.jpg); no-repeat; height: 160%; width: 100%; border: 0px solid black;">
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Módulos para Pilotos</h4>
                                <p class="category">Preparación por parte de IVAO Colombia.</p>
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

	
	$sql3 ="select * from ranksPCA";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$short_name= $row3["nombre"] . ' (' . $row3["abreviacion"] . ')';
		?>
	
                                <div class="col-md-12">
                                    <button class="button button2" onclick="location='./?page=modulosver&id=<?php echo $row3["id"]; ?>'"><?php echo $short_name; ?></button>
                               <br><br></div>
	<? } ?>
	</tr>
	</table>
</div>
                                
                            </div>
                        </div>
                    </div>
					
					
					  <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Módulos para Controladores</h4>
                                <p class="category">Preparación por parte de IVAO Colombia.</p>
                            </div>
                            <div class="content">
                               	 <div class="table-full-width">
							<table class="table">
							<tr>
							 <?php
											
											
	
	
	$sql38 ="select * from ranksATC";

	if (!$result38 = $db->query($sql38)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row38 = $result38->fetch_assoc()) {
		$short_names= $row38["nombre"] . ' (' . $row38["abreviacion"] . ')';
		?>
	
                                <div class="col-md-12">
                                    <button class="button1 button2" onclick="location='./?page=modulosveratc&id=<?php echo $row38["id"]; ?>'"><?php echo $short_names; ?></button>
                               <br><br></div>
	<? } ?>
	</tr>
	</table>
</div>

                            
                            </div>
                        </div>
                    </div>
					
					
					
					
					
					
					
					
					</div>
					</div>
					</div>