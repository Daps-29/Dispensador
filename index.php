<?php

$alert = '';
session_start();
if(!empty($_SESSION['active']))
{
	header('location: sistema/');
}else{

	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = 'Ingrese su usuario y su calve';
		}else{

			require_once "conexion.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = mysqli_real_escape_string($conection,$_POST['clave']); //md5()

			$query = mysqli_query($conection,"SELECT u.idusuario,u.nombre,u.correo,u.usuario,u.rol,r.idrol,r.rol,u.fotografia_usuario FROM usuario u
				INNER JOIN rol r
				ON u.rol = r.idrol
				WHERE u.usuario= '$user' AND u.clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0)
			{
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email']  = $data['correo'];
				$_SESSION['user']   = $data['usuario'];
				$_SESSION['rol']    = $data['idrol'];
				$_SESSION['rola']    = $data['rol'];
				$_SESSION['fotouser']	= $data['fotografia_usuario'];

				header('location: Sistema/');
			}else{
				$alert = 'El usuario o la clave son incorrectos';
				session_destroy();
			}


		}

	}
}
 ?>
<link rel="stylesheet" href="css/login2.css">
<div id="login-button">
  <img src="https://imgur.com/JaTu8Qj.png">
  </img>
</div>
<div id="container">
  <h1>Bienvenido</h1>


  <form  action="" method="post">
    <input type="text" name="usuario" placeholder="Usuario">
    <input type="password" name="clave" id="clave" placeholder="Contraseña">
	<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
    <a href="#"><input type="submit" value="Ingresar"></a>


</form>
</div>

<!-- Forgotten Password Container -->
<div id="forgotten-container">
   <h1>Forgotten</h1>
  <span class="close-btn">
    <img src="https://cdn4.iconfinder.com/data/icons/miu/22/circle_close_delete_-128.png"></img>
  </span>

  <form>
    <input type="email" name="email" placeholder="E-mail">
    <a href="#" class="orange-btn">Get new password</a>
</form>
</div>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.1.js"></script>
<script src="js/login.js"></script>
