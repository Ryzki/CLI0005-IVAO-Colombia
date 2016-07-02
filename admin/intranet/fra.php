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
                            Lista FRA IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addfra" method="post" >
                                        <div class="form-group">
                                            <label>ICAO Aeropuerto</label>
											<select name="icaos">
											 <option value="SKED">SKED</option>
											 <option value="SKEC">SKEC</option>
											 <option value="SKMI">SKMI</option>
											<?php


	$sql25 = "SELECT * FROM airports where iso_country='CO' order by ident asc";

	if (!$result25 = $db->query($sql25)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row25 = $result25->fetch_assoc()) {
		$primeras = substr($row25['ident'],0,3);
		if(($primeras<>"SK-") && ($primeras<>"AGI") && ($primeras<>"CO-") && ($primeras<>"LMC")){
		?>
		
		 <option value="<?php echo $row25['ident']; ?>"><?php echo $row25['ident']; ?></option>
		
		<?
		}
	}?>
	</select>
                                           
                                        </div>
										<div class="form-group">
                                            <label>Dependencia Aeropuerto</label>
                                           
											<select name="posicion">
  <option value="APP">APP</option>
  <option value="DEP">DEP</option>
  <option value="TWR">TWR</option>
  <option value="GND">GND</option>
  <option value="CTR">CTR</option>
  <option value="DEL">DEL</option>
 
</select>
                                        </div>
										<div class="form-group">
                                            <label>Rango Mínimo</label>
											<select name="rank">
  <option value="2">ATC Applicant (AS1)</option>
  <option value="3">ATC Trainee (AS2)</option>
  <option value="4">Advanced ATC Trainee (AS3)</option>
  <option value="5">Aerodrome Controller (ADC)</option>
  <option value="6">Approach Controller (APC)</option>
  <option value="7">Centre Controller (ACC)</option>
  <option value="8">Senior Controller (SEC)</option>
  <option value="9">Senior ATC Instructor (SAI)</option>
  <option value="10">Chief ATC Instructor (CAI)</option>
</select>
											

                                        </div>
										
										<div class="form-group">
                                            <label>Días</label>
										
 <input name="lun" type="checkbox" value="1"/> Lunes
<input name="mar" type="checkbox" value="1"/> Martes
<input name="mie" type="checkbox" value="1"/> Miércoles
 <input name="jue" type="checkbox" value="1"/> Jueves
<input name="vie" type="checkbox" value="1"/> Viernes
<input name="sab" type="checkbox" value="1"/> Sábado
<input name="dom" type="checkbox" value="1"/> Domingo

											

                                        </div>
										
										<div class="form-group">
                                            <label>Idioma</label>
										
 <input name="idioma" type="checkbox" value="1"/> Si

											

                                        </div>
										
										<div class="form-group">
                                            <label>Voz Rango</label>
										
<select name="voice">
<option value="0">No</option>
  <option value="5">Voice Level 1</option>
   <option value="6">Voice Level 2</option>
    <option value="7">Voice Level 3</option>
 
</select>

											

                                        </div>
										
										 
								
                                        <button type="submit" class="btn btn-default">Añadir FRA</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de FRA's Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                 
 <table class="table table-condensed">
    <tr>
      <td>
      <table class="table table-condensed">
        <tr class="bg-primary">
          
          <td rowspan="2">Aeropuerto</td>
          <td rowspan="2">Posición</td>
          <td colspan="2" align="center">Hora</td>
          <td colspan="8" align="center">Día</td>
          <td colspan="3" align="center">Rango</td>
          <td rowspan="2">Idioma</td>
		  <td rowspan="2">Opciones</td>
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
          <td align="center"><form  action="?page=deletefra&id=<?php echo $row2['id']; ?>"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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
                    </div>
					
					
					
					
                </div>
            </div>
                <!-- /. ROW  -->
               
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>        