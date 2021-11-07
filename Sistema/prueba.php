<input type="hidden" name="time" id="time">
<?php
include "../conexion.php";
$query = mysqli_query($conection,"SELECT TIME(start) as fecha, id FROM eventos ORDER BY id DESC ");
$data = mysqli_fetch_assoc($query);

$dis = $data['fecha'];


?>
<script>
var tiempo = '<?=$dis ?>';
console.log(tiempo);
var hora = new Date();

hora1 = hora.getHours();
min = hora.getMinutes();
seg = "00";
horaa = hora1 +":" + min +":"+ seg;
console.log(horaa);
if (horaa == tiempo ) {
  console.log("Exito");
}
</script>
