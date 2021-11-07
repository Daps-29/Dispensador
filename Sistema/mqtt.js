

function update_values(temp, comida){
  $("#temp").html(temp);
  $("#comida").html(comida);
}
//update_values("77","4")

function process_msg(topic, message){

  if (topic == "dispo") {
    var msg = message.toString();
    var sp  = msg.split(",");
    //variable temperatura
    var temp = sp[0];
    var comida = sp[1];
    update_values(temp,comida);
  }
}
function process_comida(){
  if ($('#comida1').is(":checked")) {
    console.log("Encendido");
    client.publish('comida', 'on', (error) => {

    console.log(error || 'Perfect')
})
  } else {
    console.log("Apagado");
    client.publish('comida', 'off', (error) => {
    console.log(error || 'Perfect')
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
