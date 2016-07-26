
<?php




include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from modulosPCA where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$num= $row3["id"];
		$titulos= $row3["titulo"];
        $pdf= $row3["pdf"];
		$staffa= $row3["staff"];
		$rankPCA= $row3["rankPCA"];
		
		
		
		
			$sql33 ="select * from staff where id='$staffa'";

	if (!$result33 = $db->query($sql33)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row33 = $result33->fetch_assoc()) {
		$nombrese= $row33["nombres"] . ' ' . $row33["apellidos"];
		
		$staff_ivao = $row33["staff_ivao"];
		
		$sql338 ="select * from ranks where id='$staff_ivao'";

	if (!$result338 = $db->query($sql338)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row338 = $result338->fetch_assoc()) {
		 $cargose= $row338["callsign"];
	}
		
		
	}
		
		
		
		
		
		$sql3389 ="select * from ranksPCA where id='$rankPCA'";

	if (!$result3389 = $db->query($sql3389)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3389 = $result3389->fetch_assoc()) {
		 $cargoseee= $row3389["nombre"] . ' (' . $row3389["abreviacion"] . ')';
	}
	
	
	
	
		
		
	}
	
	

	

								
							

  
	

		

	?>
		
        <div class="content">
           
                    
				
				 <div class="header">
                               <h1>Módulos <?php echo $titulos; ?></h1>
				<h4>Rango: <?php echo $cargoseee; ?></h4>
                            </div>
				<br>
				<hr>
				<br>
					 <div class="content">
                               	 <div class="ct-chart ct-perfect-fourth">		
								 
								 
	
<script language="JavaScript">
<!--
function autoResize(id){
    var newheight;
    var newwidth;

    if(document.getElementById){
        newheight = document.getElementById(id).contentWindow.document .body.scrollHeight;
        newwidth = document.getElementById(id).contentWindow.document .body.scrollWidth;
    }

    document.getElementById(id).height = (newheight) + "px";
    document.getElementById(id).width = (newwidth) + "px";
}
//-->
</script>


<?php
$file ='../admin/intranet/modulosPCA/'.$pdf;
 

				
   ?> 
   
   <iframe src="<?php echo $file; ?>" width="100%" height="600px" id="iframe1" marginheight="0" frameborder="0" onLoad="autoResize('iframe1');"></iframe>
 
	<br>
	<br>
	<hr>
<br>
	<p>
										<span style="color: #2a4982; font-family: Arial; font-size: 11pt;"><strong><?php echo $nombrese; ?></strong></span><br />
										<span style="color: #666666; font-size: 10pt;"><strong><?php echo $cargose; ?></strong></span><br />
										<span style="color: #666666; font-size: 8pt;">International Virtual Aviation Organisation<br />
										<a href="http://co.ivao.aero/"><font color="blue">http://co.ivao.aero</font></a></span></p>					




</div>
					</div>
                       
</div>
					
				