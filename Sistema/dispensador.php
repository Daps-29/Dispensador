<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <?php
  include "includes/links.php";
   ?>
   <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
                <div class="row">
                  <div class="col-md-12">
                    <div class="">
                      <div class="x_content">
                        <div class="row">
                      <div class="animated flipInY col-lg-3 col-md-8 col-sm-8  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-soundcloud"></i>
                          </div>
                          <div class="count"><b id = "temp">--</b>°C</div>

                          <h3>Temperatura</h3>
                        </div>
                      </div>

                      <div class="animated flipInY col-lg-3 col-md-6 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-paw"></i>
                          </div>
                          <div class="count"><b id ="comida">--</b>%</div>

                          <h3>Capacidad de la comida</h3>

                        </div>
                      </div>
                      <div class="animated flipInY col-lg-3 col-md-6 col-sm-6  ">
                        <div class="tile-stats">
                          <div class="icon"><i class="fa fa-tint"></i>
                          </div>
                          <div class="count"><b id ="hum">--</b>%</div>

                          <h3>Humedad</h3>

                        </div>
                      </div>
                    </div>
                      </div>
                      </div>
                    </div>
                </div>

               </div>
            </div>
          </div>
          <br />
              <div class="row">
                <div class="col-md-3   widget widget_tally_box">
                <div class="x_panel fixed_height_390">
                  <div class="x_title">
                              <h2>Dispensar Comida</h2>

                      <div class="clearfix"></div>

                  </div>


                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9 ">

                          <div class="">
                            <label>
                              <input type="checkbox" class="js-switch" id="comida1" name="comida"onchange="process_comida()"  /> Comida

                            </label>
                          </div>
                          <img src="images/1.jpg" id="foto" style="width:200px;">;
                        </div>
                      </div>


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
<?php
include "../conexion.php";
$query = mysqli_query($conection,"SELECT TIME(start) as fecha, id FROM eventos ORDER BY id DESC ");
$data = mysqli_fetch_assoc($query);

$dis = $data['fecha'];


?>
<?php
include "../conexion.php";
$query1 = mysqli_query($conection,"SELECT CAST(start AS DATE) as dat,id FROM eventos ORDER BY id DESC ");
$data1 = mysqli_fetch_assoc($query1);

$dis1 = $data1['dat'];


?>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>

  var tiempo = '<?=$dis ?>';
  var dat = '<?=$dis1 ?>';
  var img = document.getElementById("foto");

var hora = new Date();

hora1 = hora.getHours();
min = hora.getMinutes();
dat = hora.getDay();
mon = hora.getMonth();
year = hora.getFullYear();
min0 = "0";
seg = "00";
horaa = hora1 +":" + min +":"+ seg ;
fe = year +"-"+'0'+mon+"-"+'0'+dat;
console.log(tiempo);
console.log(horaa);
console.log(fe);


function genera(min, max){
  return Math.floor(Math.random()*(max-min+1)+min);
}
console.log(genera(70,95));
function update_values(temp,comida,hum){
  $("#temp").html(temp);

  if (comida >= 13) {


  $("#comida").html(genera(1,20));
}else if (comida == 8 || comida ==9 || comida ==10|| comida ==11|| comida ==12) {

  $("#comida").html(genera(30,60));
}else if (comida <= 7) {

  $("#comida").html(genera(70,95));
}
$("#hum").html(hum);
}
//update_values("77","4")

function process_msg(topic, message){

  if (topic == "dispo") {
    var msg = message.toString();
    var sp  = msg.split(",");
    //variable temperatura
    var temp = sp[0];
    var comida = sp[1];
    var hum = sp[2];
    update_values(temp,comida,hum);
  }
}

function process_comida(){
  if ($('#comida1').is(":checked")) {
    console.log("Encendido");

    client.publish('comida', 'on', (error) => {

    console.log(error || 'Perfect')
    img.src = "images/2.jpg";
})
  } else {
    console.log("Apagado");
    client.publish('comida', 'off', (error) => {
    console.log(error || 'Perfect')
    img.src = "images/1.jpg";
  })
  }
}
//Conexion a MQTT
const options = {
      connectTimeout: 4000,
      // Authentication
      clientId: 'acces_control_server',
      username: 'david',
      password: 'david81',
      keepalive: 60,
      clean: true,
}
// CONEXION AL WEBSOCKET
const WebSocket_URL = 'wss://dispo.ga:8094/mqtt'
const client = mqtt.connect(WebSocket_URL, options)
client.on('connect', () => {
    console.log('Connect success')
		client.subscribe('dispo', { qos: 0 }, (error) => {
        if (!error) {

            console.log('Subscribe Success')

        }else{
          console.log('Subscribe Cancel')
        }
    })
		/*client.publish('dispo', 'dispo encendido', (error) => {
    console.log(error || 'Publish Success')
	})*/
})

if(horaa == tiempo){
console.log("Dispensando");
client.publish('comida', 'on', (error) => {
console.log(error || 'ok abriendo')

})
}
client.on('message', (topic, message) => {
    console.log('Mensaje recibido bajo el topico:', topic, '->', message.toString())
    process_msg(topic, message);
})
client.on('reconnect', (error) => {
    console.log('Error al reconectar', error)
})
client.on('error', (error) => {
    console.log('Error de conexion', error)
})

</script>
