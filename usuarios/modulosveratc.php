
 <?php
											
											
											include('./db_login.php');
	
	$id = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from ranksATC where id=$id";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$short_name= $row3["nombre"] . ' (' . $row3["abreviacion"] . ')';
	}
		?>
		
        <div class="content">
           
                    
				
				 <div class="header">
                               <h1>Módulos para Controladores</h1>
				<h4>Rango: <?php echo $short_name; ?></h4>
                            </div>
				<br>
				<hr>
				<br>
					 <div class="content">
                               	 <div class="ct-chart ct-perfect-fourth">		
								 
								 
								 <?
								 $i=0;
								 	$sql3i ="select * from modulosATC where rankatc=$id";

	if (!$result3i = $db->query($sql3i)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3i = $result3i->fetch_assoc()) {
		
		$i++;
		
	
		?>
		
		
		
	<li class="activity page modtype_page " id="module-18">
<div>
<div class="mod-indent-outer">
<div class="mod-indent"></div>
<div>
<div class="activityinstance">
<a class="" onclick="" href="./?page=muestraatcmodulos&id=<?php echo $row3i["id"]; ?>">
<img src="http://static.batanga.com/sites/default/files/styles/full/public/tech.batanga.com/files/627px-Wikipedia-logo-de.png?itok=-Z-tsI-S" class="iconlarge activityicon" alt=" " role="presentation" width="4%"/>
<span class="instancename"><?php echo $row3i["titulo"]; ?><span class="accesshide " > Documento</span></span></a></div>
<span class="actions">
</span>
<div class="contentafterlink">
<div class="no-overflow">
<div class="no-overflow">
<p>Con esta cartilla, aprenderás efectivamente mucha información dada por el Staff de IVAO Colombia..</p></div></div></div></div></div></div></li>

<?php } 

if ($i==0){
	echo '<div class="alert alert-danger" role="alert">No hay material subido a este módulo.</div>';
}
?>






</div>
					</div>
                       
</div>
					
				