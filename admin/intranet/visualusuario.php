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
<?php


	$sql2a = "SELECT * FROM usuariosivao order by vid asc";

	if (!$result2a= $db->query($sql2a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
$mass = 0;
	while ($row2a= $result2a->fetch_assoc()) {
		$mass++;
	}
	
	

	?>
			 
    <p>There are currently <?php echo $mass; ?> registered members in the Colombia division. To see a member's details - click on the VID</p>
      
      <table class="table table-condensed" width="100%">
        <colgroup>
		  <col style="width:20%">
		  <col style="width:40%">
		  <col style="width:20%">
		  <col style="width:20%">
	    </colgroup>  

        <tbody>
        </tbody>
          <tr class="bg-primary"><td>VID</td> <td>Name</td> <td style="text-align:center">ATC Rating</td> <td style="text-align:center">Pilot Rating</td>
		  <td style="text-align:center">Última Conexión</td>
		   <td style="text-align:center">Email</td></tr>




<?php

	//Limito la busqueda
        $pagina = false;
		
//Limito la busqueda
$TAMANO_PAGINA = 30;

//examino la página a mostrar y el inicio del registro a mostrar
$pagina = $_GET["pagina"];
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}
else {
   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}


	


//calculo el total de páginas
$total_paginas = ceil($mass / $TAMANO_PAGINA);



//Si hay registros
if ($mass > 0) {



$sql2 = "SELECT * FROM usuariosivao order by vid asc LIMIT ".$inicio."," . $TAMANO_PAGINA;

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	

	while ($row2 = $result2->fetch_assoc()) {


			
			
		
	
		?>
		
		
		
		
		  <tr>
    <td ><a href="https://www.ivao.aero/Member.aspx?ID=<?php echo $row2['vid']; ?>">
    <img src="https://www.ivao.aero/data/images/ratings/officer/2.gif" border="0" hspace="5" align="absmiddle" title="Active User"><?php echo $row2['vid']; ?></a>
    </td>
    <td style="vertical-align:middle"><?php echo $row2['nombres'] . ' ' . $row2['apellidos']; ?></td>
    
    <td align="center">
    <img src="https://www.ivao.aero/data/images/ratings/atc/<?php echo $row2['rangoatc']; ?>.gif" title="" align="absmiddle"></td>
    
    <td align="center">
    <img src="https://www.ivao.aero/data/images/ratings/pilot/<?php echo $row2['rangopca']; ?>.gif" title=""></td>
	
	<td align="center"><?php echo $row2['lastconect'] . ' (' . $row2['lastip'] . ')'; ?></td>
	
	<td align="center"><?php echo $row2['email']; ?></td>
    
  </tr>
  
  <?php
			
	}
	
   
						
   ?> 
					  


</table>
    <center>                              
<?php

	
	if ($total_paginas > 1) {
   if ($pagina != 1)
      echo '<a href="?page=visualusuario&pagina='.($pagina-1).'"><img src="images/izq.gif" border="0"></a>';
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i) {
            //si muestro el índice de la página actual, no coloco enlace
         echo $pagina;
         }   else {
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '  <a href="?page=visualusuario&pagina='.$i.'">'.$i.'</a>  ';
			}
      }
      if ($pagina != $total_paginas)
         echo '<a href="?page=visualusuario&pagina='.($pagina+1).'"><img src="images/der.gif" border="0"></a>';
}

}
?>
</center>
                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
					
					
					
					
                </div>
           