<div class="container">

            <div id="page-inner">
             
           
                 
					
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                 
 <table class="table table-condensed" width="100%">
    <tr>
      <td>
      <table class="table table-condensed" width="100%">
        <tr class="bg-primary">
          
          <td rowspan="2">Aeropuerto</td>
          <td rowspan="2">Posición</td>
          <td colspan="2" align="center">Hora</td>
          <td colspan="8" align="center">Día</td>
          <td colspan="3" align="center">Rango</td>
          <td rowspan="2">Idioma</td>
        </tr>
        <tr class="bg-primary">
          <td>Inicio</td>
          <td>Fin</td>
          
          <td>Lun&nbsp;</td>
          
          <td>Mar&nbsp;</td>
          
          <td>Mie&nbsp;</td>
          
          <td>Jue&nbsp;</td>
          
          <td>Vie&nbsp;</td>
          
          <td>Sab&nbsp;</td>
          
          <td>Dom&nbsp;</td>
          
          <td>Día</td>
          <td width="105" align="center">ATC</td>
          <td width="105" align="center">Piloto</td>
          <td width="105" align="center">Voz</td>
        </tr>
        
       
				 
								
<?php
include('./db_login.php');
$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
$numeros=0;
	$sql2 = "SELECT * FROM fra order by icao asc";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		   $identi = $row2['id'];
	
		$numeros++;
						
   ?> 
					  
 <tr>
          
          <td align="center">
          <?php echo $row2['icao']; ?>&nbsp;</td>
          <td align="center">
          <?php echo $row2['posicion']; ?>&nbsp;</td>
          <td align="right">0:00</td>
          <td align="right">0:00</td>
          
          <td align="center">
		  <?php 
		  
		   if($row2['lun']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		  
		  ?>
		  </td>
          
          <td align="center">
		  <?php
		  
		  if($row2['mar']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		   
		  ?>
		  </td>
          
          <td align="center">
		   <?php
		  
		  if($row2['mie']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		   
		  ?></td>
          
          <td align="center"><?php
		  
		  if($row2['jue']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		   
		  ?></td>
          
          <td align="center"><?php
		  
		  if($row2['vie']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		   
		  ?></td>
          
          <td align="center"><?php
		  
		  if($row2['sab']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		   
		  ?></td>
          
          <td align="center"><?php
		  
		  if($row2['dom']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		   
		  ?></td>
          
          <td>&nbsp;</td>
		  
          <td><img src="https://www.ivao.aero/data/images/ratings/atc/<?php echo $row2['rango']; ?>.gif" title="">&nbsp;</td>
          <td>
          &nbsp;</td>
		  <td>
		  <?php if($row2['voice']<>0) { ?>
		  
		   <img src="https://www.ivao.aero/data/images/ratings/voice/<?php echo $row2['voice']; ?>.gif" title="">&nbsp;
		  <?php } else {
			  
			  ?>
			  &nbsp;
			  <?
		  }
?></td>
          <td><?php 
		   if($row2['language']==1){
			   echo '&checkmark;&nbsp;';
		   } else {
			   echo '&nbsp;';
		   }
		  ?></td>
         
        </tr>

                                  
	<?php } ?>
                                 
        </table>
		</td>
		</tr>
		</table>
		
		<?php if($numeros==0){
			
			echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">No hay FRA´s agregados.</div></div>	';
		}
		
		?>
		</div>
                                
                            </div>
                        </div>
                 
					
					
			
                <!-- /. ROW  -->
               
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>        