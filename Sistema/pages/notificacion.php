<?php
include "../conexion.php";

 ?>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>
      <nav class="nav navbar-nav">
      <ul class=" navbar-right">
        <li class="nav-item dropdown open" style="padding-left: 15px;">
          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
            <img src="https://scontent.flpb3-1.fna.fbcdn.net/v/t1.6435-9/33127449_1522333847876621_7942514296997543936_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=AGGkItwwc9AAX8Teh14&_nc_ht=scontent.flpb3-1.fna&oh=3f1ff689b3ba94ce977b1845c88631f1&oe=60C8A013" alt=""><?php echo $_SESSION['nombre']; ?>
          </a>
          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item"  href="javascript:;"> Profile</a>
              <a class="dropdown-item"  href="javascript:;">
                <span class="badge bg-red pull-right">50%</span>
                <span>Settings</span>
              </a>
          <a class="dropdown-item"  href="javascript:;">Help</a>
            <a class="dropdown-item"  href="salir.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
          </div>
        </li>
<?php

$query = mysqli_query($conection,"SELECT * FROM dispensador ORDER BY iddis DESC");
$data = mysqli_fetch_array($query);

if ($data["distancia"] <= 15) {
$bien = "Comida Normal";
 ?>
        <li role="presentation" class="nav-item dropdown open">
                          <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell-o"></i>
                          </a>
                          <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                            <li class="nav-item">
                              <a class="dropdown-item">
                                <span class="image"><img src="images/patitas-logo-png.png" alt="Profile Image" /></span>
                                <span>
                                  <span><?php echo $bien ?></span>
                                </span>
                                <span class="message">
                                Todo Posi
                                </span>
                              </a>
                            </li>
                            <li class="nav-item">
                              <div class="text-center">
                                <a class="dropdown-item">
                                  <strong>Ver todas las notificacioness</strong>
                                  <i class="fa fa-angle-right"></i>
                                </a>
                              </div>
                            </li>
                          </ul>
        </li>
<?php
}else if($data["distancia"] >= 15)
{
  $mal = "Camida Baja";
 ?>
 <li role="presentation" class="nav-item dropdown open">
                   <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                     <i class="fa fa-bell-o"></i>
                     <span class="badge bg-green">1</span>
                   </a>
                   <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                     <li class="nav-item">
                       <a class="dropdown-item">
                         <span class="image"><img src="images/patitas-logo-png.png" alt="Profile Image" /></span>
                         <span>
                           <span><?php echo $mal ?></span>
                         </span>
                         <span class="message">
                          Todo mal :c
                         </span>
                       </a>
                     </li>
                     <li class="nav-item">
                       <div class="text-center">
                         <a class="dropdown-item">
                           <strong>Ver todas las notificacioness</strong>
                           <i class="fa fa-angle-right"></i>
                         </a>
                       </div>
                     </li>
                   </ul>
 </li>
 <?php
}
  ?>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->
