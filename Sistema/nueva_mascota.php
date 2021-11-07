<?php
	include "../conexion.php";
	session_start();
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$edad  = $_POST['edad'];
			$raza   = $_POST['raza'];
			$peso  = $_POST['peso']; //md5()
			$usu    = $_POST['usu'];



				$query_insert = mysqli_query($conection,"INSERT INTO mascota(idusuario,nombre,edad,peso,raza)
																	VALUES('$usu','$nombre','$edad','$peso','$raza')");
				if($query_insert){
					$alert='<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el usuario.</p>';
				}




		}

	}



 ?>


 <!DOCTYPE html>
 <html lang="en">
   <?php
   include "includes/links.php";
    ?>
   <body class="nav-md">
     <div class="container body">
       <div class="main_container">
         <div class="col-md-3 left_col">
           <div class="left_col scroll-view">
            <?php
            include "pages/menu.php";
            ?>
           </div>
         </div>
         <?php
         include "pages/notificacion.php";
          ?>
					<!-- page content -->
				  <div class="right_col" role="main">
				 	 <!-- top tiles -->
				 	 <div class="row" style="display: inline-block;" >
				 	 <div class="tile_count">

				 	 </div>
				  </div>
				 	 <!-- /top tiles -->

				 	 <div class="row">
				 		 <div class="col-md-12 col-sm-12 ">
				 				<div class="col-md-12 col-sm-12 ">
				 			 <div class="x_panel">
				 				 <div class="x_title">
				 					 <h2>Nueva Mascota</h2>
				 					 <ul class="nav navbar-right panel_toolbox">
				 						 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				 						 </li>
				 						 <li class="dropdown">
				 							 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				 							 <ul class="dropdown-menu" role="menu">
				 								 <li><a class="dropdown-item" href="#">Settings 1</a>
				 								 </li>
				 								 <li><a class="dropdown-item" href="#">Settings 2</a>
				 								 </li>
				 							 </ul>
				 						 </li>
				 						 <li><a class="close-link"><i class="fa fa-close"></i></a>
				 						 </li>
				 					 </ul>
				 					 <div class="clearfix"></div>
				 				 </div>
				 				 <div class="x_content">
				 					 <br />
									 <form method="POST" action="">
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Nombres:</label>
						                             <input type="hidden" name="nombre" id="nombre">
						                             <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre">
						                           </div>

						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Edad:</label>
						                             <input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" >
						                           </div>
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Raza:</label>
						                             <input type="text" class="form-control" name="raza" id="raza" maxlength="256" placeholder="Raza">
						                           </div>
																			 <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Peso:</label>
						                             <input type="number" class="form-control" name="peso" id="peso" maxlength="256" placeholder="Peso maximo 5kg">
						                           </div>
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Dueño:</label>

																				 <?php
																					 include "../conexion.php";
																					 $query_rol = mysqli_query($conection,"SELECT * FROM usuario WHERE estatus = '1'");

																					 $result_rol = mysqli_num_rows($query_rol);

																					?>

																				 <select name="usu" id="usu" class="form-control" maxlength="256" name="rol" id="rol">
																					 <?php
																						 if($result_rol > 0)
																						 {
																							 while ($rol = mysqli_fetch_array($query_rol)) {
																					 ?>
																							 <option value="<?php echo $rol["idusuario"]; ?>"><?php echo $rol["nombre"] ?></option>
																					 <?php

																							 }

																						 }
																						?>
																				 </select>
						                           </div>

						                           <!--<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Imagen:</label>
						                             <input type="file" class="form-control" name="imagen" id="imagen">
						                             <input type="hidden" name="imagenactual" id="imagenactual">
						                             <img src="" width="150px" height="120px" id="imagenmuestra">
						                           </div>-->
						                           <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						                             <button class="btn btn-primary"  id="btnGuardar"> Guardar</button>

						                             <a href="usuario.php"><button class="btn btn-danger"type="button"> Cancelar</button></a>
						                           </div>
						                         </form>
				 				 </div>
				 			 </div>
				 		 </div>
				 				</div>
				 		 </div>

				 	 </div>
				 	 <br />
				 	<div class="row">
				 			 </div>
				 		 </div>
				 	 </div>
				  </div>
				  <!-- /page content -->
         <?php
         include "pages/footer.php";
          ?>
       </div>
     </div>
       <?php include "includes/scripts.php"; ?>
   </body>
 </html>
