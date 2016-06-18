
<?php




include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from modulosATC where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$num= $row3["id"];
		$titulos= $row3["titulo"];
        $pdf= $row3["pdf"];
		$staffa= $row3["staff"];
		$rankatc= $row3["rankatc"];
		
		
		
		
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
		
		
		
		
		
		$sql3389 ="select * from ranksATC where id='$rankatc'";

	if (!$result3389 = $db->query($sql3389)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3389 = $result3389->fetch_assoc()) {
		 $cargoseee= $row3389["nombre"] . ' (' . $row3389["abreviacion"] . ')';
	}
	
	
	
	
		
		
	}
	
	

	

								
							

  
	

		

	?>
	
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
                            Información Módulo
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
								
                                <div class="col-md-11">
								<br>
                                   
								<hr>
								
                                        <?php
										
										echo '<h1>' . $titulos . '</h1>';
										echo '<hr>';
										echo '<h3>' . $cargoseee . '</h2>';
										echo '<br>';
										
									

?>

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
$file ='./modulosATC/'.$pdf;
 

				
   ?> 
   
   <iframe src="<?php echo $file; ?>" width="100%" height="600px" id="iframe1" marginheight="0" frameborder="0" onLoad="autoResize('iframe1');"></iframe>
 
   
	

	
	
<br>
	<p>
										<span style="color: #2a4982; font-family: Arial; font-size: 11pt;"><strong><?php echo $nombrese; ?></strong></span><br />
										<span style="color: #666666; font-size: 10pt;"><strong><?php echo $cargose; ?></strong></span><br />
										<span style="color: #666666; font-size: 8pt;">International Virtual Aviation Organisation<br />
										<a href="http://co.ivao.aero/"><font color="blue">http://co.ivao.aero</font></a></span></p>										

                                 
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