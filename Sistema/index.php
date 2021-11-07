<?php
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
         <?php
         include "../conexion.php";
         $query = mysqli_query($conection,"SELECT COUNT(u.idusuario) as usu FROM usuario u WHERE u.estatus = '1'  ");
                 mysqli_close($conection);
                 $espacios = mysqli_fetch_assoc($query);
          ?>
          <?php
          include "../conexion.php";
          $mas1 = mysqli_query($conection,"SELECT COUNT(m.idmascota) as mas FROM mascota m  ");
                  mysqli_close($conection);
                  $mas = mysqli_fetch_assoc($mas1);
           ?>
           <?php
           include "../conexion.php";
           $di = mysqli_query($conection,"SELECT d.distancia as di, d.iddis FROM dispensador d ORDER BY d.iddis DESC ");
                   mysqli_close($conection);
                   $dis = mysqli_fetch_assoc($di);
            ?>
         <div class="right_col" role="main">
         <div class="">
           <div class="row" style="display: inline-block;">
           <div class="top_tiles">
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-users"></i></div>
                 <div class="count"><?php echo $espacios['usu']; ?></div>
                 <h3>Usuarios Totales</h3>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-paw"></i></div>
                 <div class="count"><?php echo $mas['mas']; ?></div>
                 <h3>Mascotas Totales</h3>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-umbrella"></i></div>
                 <div class="count">15</div>
                 <h3>Temperatura Dispensador</h3>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-percent"></i></div>
                 <div class="count"><?php echo $dis['di']; ?></div>
                 <h3>Cantidad de comida</h3>
               </div>
             </div>
           </div>
         </div>




           <div class="row">
             <div class="col-md-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Proximas Comidas</h2>
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
                <div id='calendario'></div>
                 </div>
               </div>
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
<script>
$(document).ready(function(){
  $('#calendario').fullCalendar(
    {
      locale:'es',

      dayClick:function(date,jsEvent,view){
        limpiar();
        $('#txtFecha').val(date.format());
        $('#ModalEventos').modal();
      },

        events:'http://dispo.ga/Sistema/eventos.php',

    eventClick:function(calEvent,jsEvent,view){
      $('#tituloEvento').html(calEvent.title);

      $('#txtDescripcion').val(calEvent.descripcion);
      $('#txtId').val(calEvent.id);
      $('#txtTitulo').val(calEvent.title);
      $('#txtColor').val(calEvent.color);
      FechaHora = calEvent.start._i.split(" ");
      $('#txtFecha').val(FechaHora[0]);
      $('#ModalEventos').modal();

    },

    });
});
</script>
