<?php

	$host = 'dispo.ga';
	$user = 'admin_disp';
	$password = 'david123';
	$db = 'admin_dispo';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>
