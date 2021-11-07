<?php
	include "../conexion.php";
	session_start();
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
				  			<div class="dashboard_graph">
				  				<h3>Lista de Reporte</h3>


				  				<div class="col-md-12 col-sm-12 ">
				  				<div class="x_panel">
				  					<div class="x_title">
				  						<h2>Reporte de mascota</h2>
				  						<ul class="nav navbar-right panel_toolbox">
				  							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				  							</li>
				  							<li class="dropdown">
				  								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				  								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  										<a class="dropdown-item" href="#">Settings 1</a>
				  										<a class="dropdown-item" href="#">Settings 2</a>
				  									</div>
				  							</li>
				  							<li><a class="close-link"><i class="fa fa-close"></i></a>
				  							</li>
				  						</ul>
				  						<div class="clearfix"></div>
				  					</div>
				  					<div class="x_content">
				  							<div class="row">
				  									<div class="col-sm-12">
				  										<div class="card-box table-responsive">
				  						<p class="text-muted font-13 m-b-30">

				  						</p>
				  						<table id="datatable-buttons" class="table table-striped table-bordered" style="width:100%">
				  							<thead>
				  								<tr>
				  								<th>Mascota</th>
                          <th>Dueño</th>
				  								<th>Cantidad de comida</th>
				  								<th>Peso de la comida</th>
				  								</tr>
				  							</thead>
				  							<?php
				  //Paginador



				  $query = mysqli_query($conection,"SELECT d.iddis,m.nombre as masco,u.nombre as due, d.distancia,d.peso,d.cantidad FROM dispensador d INNER JOIN mascota m, usuario u WHERE d.idmascota = m.idmascota AND m.idusuario = u.idusuario
				  ");

				  mysqli_close($conection);

				  $result = mysqli_num_rows($query);
				  if($result > 0){

				  while ($data = mysqli_fetch_array($query)) {

				  ?>

				  							<tbody>
				  							<tr>
            <td><?php echo $data["masco"]; ?></td>
            <td><?php echo $data["due"]; ?></td>
						<?php
						$holi = 15;
						if($data["distancia"]>=17){
						 ?>
						<td><?php echo $holi; ?> %</td>
					<?php }elseif ($data["distancia"]<17) {
					  $bien = 70;
						?>

					<td><?php echo $bien; ?>%</td>
				<?php } ?>
				  	<td><?php echo $data["peso"]; ?> kg</td>

				  </tr>
				  								<?php
				  }

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
