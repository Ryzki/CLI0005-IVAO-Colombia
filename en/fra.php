<div class="container">
<style type="text/css">
.trafficlistnettotal {
	background-color: #D9EDF7;
	color: #3A87AD;
	padding-top: 10px;
	padding-right: 10px;
	padding-bottom: 10px;
	padding-left: 10px;
	border: 1px solid #96CDE9;
	border-radius: 1px;
	margin-top: 5px;
	margin-bottom: 5px;
}

tr.trafico {
	width: 1024px;
	border-bottom: 5px solid #EFEFEF;
}
tr.trafico > td {
	width: 256px;
	border-bottom: 1px solid #D8D8D8;
	text-align: center;
}
tr.princ{
	background-color: #2a4982;
	color: #FFFFFF;
	text-align: center;
	height: 35px;
	}
	
	div.boton {
	background-color: #2F5E9F;
	width: 200px;
	height: 50px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	border: 1px solid #15356F;
	border-radius: 13px;
	margin-top: 20px;
}
div.boton:hover {
	background-color: #437BC7;
}

input.boton {
	color: #FFFFFF;
	background-color: #2a4982;
	padding-top: 7px;
	padding-right: 15px;
	padding-bottom: 7px;
	padding-left: 15px;
	border: 1px solid #2a4982;
	font-family:'Open Sans', sans-serif;
	font-size: 16px;
}
input.boton:disabled {
	color: #FFFFFF;
	background-color: #7E7F7F;
	padding-top: 7px;
	padding-right: 15px;
	padding-bottom: 7px;
	padding-left: 15px;
	border: 1px solid #838486;
	font-family: 'Open Sans', sans-serif;
	font-size: 16px;
}

input.boton:hover {
	background-color: #416EC1;
}
</style>
            <div id="page-inner">
             
           
                 
					
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                 
 <table class="table table-condensed" width="100%">
    <tr>
      <td>
      <table class="table table-condensed" width="100%">
        <tr class="princ">
          
          <td rowspan="2">Airport</td>
          <td rowspan="2">Position</td>
          <td colspan="2" align="center">Time</td>
          <td colspan="8" align="center">Day</td>
          <td colspan="3" align="center">Rating</td>
          <td rowspan="2">Language</td>
        </tr>
        <tr class="princ">
          <td>Start</td>
          <td>End</td>
          
          <td>Mon&nbsp;</td>
          
          <td>Tue&nbsp;</td>
          
          <td>Wed&nbsp;</td>
          
          <td>Thu&nbsp;</td>
          
          <td>Fri&nbsp;</td>
          
          <td>Sat&nbsp;</td>
          
          <td>Sun&nbsp;</td>
          
          <td>Day</td>
          <td width="105" align="center">ATC</td>
          <td width="105" align="center">Pilot</td>
          <td width="105" align="center">Voice</td>
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
			
			echo '<div class="col-md-12"><div class="alert alert-danger" role="alert">There are not any added FRAs.</div></div>	';
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