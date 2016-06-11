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
                            Eventos IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form role="form" action="./?page=addevento" method="post" enctype="multipart/form-data" id="MyUploadForm">
                                        <div class="form-group">
                                            <label>Nombre Evento</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio</label>
											<input type="time" name="horauno">
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización</label>
											<input type="time" name="horados">
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Evento</label>
											<input type="date" name="fecha">
                                        </div>
										 <div class="form-group">
                                            <label>Información Evento</label>
											<textarea name="info"></textarea>
                                        </div>
										<div class="form-group">
                                            <label>Imagen Evento</label>
                                           <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

<script type="text/javascript" src="js/jquery.form.min.js"></script>



<script type="text/javascript">

$(document).ready(function() { 

	var options = { 

			target: '#output',   // target element(s) to be updated with server response 

			beforeSubmit: beforeSubmit,  // pre-submit callback 

			success: afterSuccess,  // post-submit callback 

			resetForm: true        // reset the form after successful submit 

		}; 

		

	 $('#MyUploadForm').submit(function() { 

			$(this).ajaxSubmit(options);  			

			// always return false to prevent standard browser submit and page navigation 

			return false; 

		}); 

}); 



function afterSuccess()

{

	$('#submit-btn').show(); //hide submit button

	$('#loading-img').hide(); //hide submit button



}



//function to check file size before uploading.

function beforeSubmit(){

    //check whether browser fully supports all File API

   if (window.File && window.FileReader && window.FileList && window.Blob)

	{

		

		if( !$('#imageInput').val()) //check empty input filed

		{

			$("#output").html("No image selected");

			return false

		}

		

		var fsize = $('#imageInput')[0].files[0].size; //get file size

		var ftype = $('#imageInput')[0].files[0].type; // get file type

		



		//allow only valid image file types 

		switch(ftype)

        {

            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':

                break;

            default:

                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");

				return false

        }

		

		//Allowed file size is less than 1 MB (1048576)

		if(fsize>5048576) 

		{

			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");

			return false

		}

				

		$('#submit-btn').hide(); //hide submit button

		$('#loading-img').show(); //hide submit button

		$("#output").html("");  

	}

	else

	{

		//Output error to older browsers that do not support HTML5 File API

		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");

		return false;

	}

}



//function to format bites bit.ly/19yoIPO

function bytesToSize(bytes) {

   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

   if (bytes == 0) return '0 Bytes';

   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));

   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];

}



</script>

<input name="image_file" id="imageInput" type="file">

<br>
<hr>

<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
										
                                        </div>
										
										 <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
								
                                        <button type="submit" class="btn btn-default">Añadir Evento</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Eventos
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombre Evento</th><th>Fecha</th><th>Horario</th><th>Información</th><th>Imagen</th><th>Actualizar</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM eventos ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];

			
			
			echo' <tr>
	<td>' . $row2['nombre'] . '</td>
	<td>' . $row2['fecha'] . '</td>
	<td>' . $row2['hora_inicio'] . ' a ' . $row2['hora_fin'] . '</td>
	<td>' . $row2['imagen'] . '</td>
	<td><form  action="?page=updateevento&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Actualizar</button></form></td>
	<td><form  action="?page=deleteevento&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
  </tr>';


	}
	
   
						
   ?> 
					  

</tbody>
</table>
                                  

                                 
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