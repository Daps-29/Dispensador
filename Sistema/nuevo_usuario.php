<?php
	include "../conexion.php";
session_start();
	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre = $_POST['nombre'];
			$email  = $_POST['correo'];
			$user   = $_POST['usuario'];
			$clave  = $_POST['clave']; //md5()
			$rol    = $_POST['rol'];


			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert='<p class="msg_error">El correo o el usuario ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol)
																	VALUES('$nombre','$email','$user','$clave','$rol')");
				if($query_insert){
					$alert='<p class="msg_save">Usuario creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el usuario.</p>';
				}

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
				 					 <h2>Nuevo Usuario</h2>
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
									 <form method="POST">
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Nombres:</label>
						                             <input type="hidden" name="nombre" id="nombre">
						                             <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" onkeypress="return sololetras(event)" onpaste="return false">
						                           </div>

						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Correo:</label>
						                             <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" >
						                           </div>
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Usuario:</label>
						                             <input type="text" class="form-control" name="usuario" id="usuario" maxlength="256" placeholder="Usuario">
						                           </div>
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Contraseña:</label>
						                             <input type="text" class="form-control" name="clave" id="clave" maxlength="256" placeholder="Contraseña">
						                           </div>
						                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
						                             <label>Cargo:</label>
						                              <select class="form-control" maxlength="256" name="rol" id="rol">
						                               <option value="1">Administrador</option>
						                               <option value="2">Dueño</option>
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
