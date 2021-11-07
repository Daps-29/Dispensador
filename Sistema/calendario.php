<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
  <?php
  include "includes/links.php";
   ?>
   <link href="vendors/clockpicker-gh-pages/dist/bootstrap-clockpicker.css">
   <link href="vendors/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.css">
   <link href="vendors/clockpicker-gh-pages/dist/jquery-clockpicker.css">
   <link href="vendors/clockpicker-gh-pages/dist/jquery-clockpicker.min.css">
   <link rel="stylesheet" type="text/css" href="js/clockpicker.css">
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
                <div id='calendario'></div>

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

<script>
$(document).ready(function(){
  $('#calendario').fullCalendar(
    {
      locale: 'es',
      header:{
        left:'today,prev,next,Miboton',
        center:'title',
        right:'month,basicWeek,basicDay,agendaWeek,agendaDay'
      },
    
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
    editable:true,
    eventDrop:function(calEvent){
      $('#txtId').val(calEvent.id);
      $('#txtTitulo').val(calEvent.title);
      $('#txtColor').val(calEvent.color);
      $('#txtDescripcion').val(calEvent.descripcion);
      var fechaHora = calEvent.start.format().split("T");
      $('#txtFecha').val(fechaHora[0]);
      $('#txtHora').val(fechaHora[1]);
      RecolectarDatosGUI();
      Editar('editar', NuevoEvento,true);
    }
    });
});
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="descripcionEvento">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success">Agregar</button>
        <button type="button" class="btn btn-primary">Editar</button>
        <button type="button" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal CRUD -->
<div class="modal fade" id="ModalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="descripcionEvento">
          <input type="hidden" name="txtId" id="txtId">
          <input type="hidden" name="txtFecha" id="txtFecha"/><br/>
          <div class="form-row">
            <div class="form-group cold-md-8">
              <label>Titulo:</label>
              <input type="text" id="txtTitulo" class="form-control" placeholder="Titulo">
            </div>
          <div class="form-group col-md-4">
            <label>Hora</label>
            <div class="input-group clockpicker" data-autoclose="true">


              <input type="text" id="txtHora"  class="form-control"/>
              </div>
          </div>

          </div>
          <div class="form-group">
          <label>Descripcion</label>
          <textarea id="txtDescripcion" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label>Color</label>
          <input type="color" id="txtColor" value="#ffffff"class="form-control" style="height:36px;"/>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
        <button type="button" id="btnEditar" class="btn btn-primary">Editar</button>
        <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<script>
var NuevoEvento;

  $('#btnAgregar').click(function(){
    RecolectarDatosGUI();
    Enviar('agregar',NuevoEvento);

  });

  $('#btnEliminar').click(function(){
    RecolectarDatosGUI();
    Enviar('eliminar', NuevoEvento);
  });
  $('#btnEditar').click(function(){
    RecolectarDatosGUI();
    Editar('editar', NuevoEvento);
  });
function RecolectarDatosGUI(){
  NuevoEvento={
  id:$('#txtId').val(),
  title:$('#txtTitulo').val(),
  start:$('#txtFecha').val()+" "+$('#txtHora').val(),
  color:$('#txtColor').val(),
  descripcion:$('#txtDescripcion').val(),
  textColor:"#FFFFFF",
  end:$('#txtFecha').val()+" "+$('#txtHora').val()
};
}
function Enviar(accion,objEvento,modal){
  $.ajax({
    type:'POST',
    url:'eventos.php?accion='+accion,
    data:objEvento,
    success:function(msg){
      if(msg){
        $('#calendario').fullCalendar('refetchEvents');
        if (!modal) {
          $('#ModalEventos').modal('toggle');
        }

      }
    },
    error:function(){
      alert("mal");
    }
  });
}
function Editar(accion,objEvento){
  $.ajax({
    type:'POST',
    url:'eventos.php?accion='+accion,
    data:objEvento,
    success:function(msg){
      if(msg){
        $('#calendario').fullCalendar('refetchEvents');
        $('#ModalEventos').modal('toggle');
      }
    },
    error:function(){
      alert("mal");
    }
  });
}
$('.clockpicker').clockpicker();
function limpiar(){
  $('#txtId').val('');
  $('#txtTitulo').val('');
  $('#txtColor').val('');
  $('#txtDescripcion').val('');
}
</script>

<script src="vendors/clockpicker-gh-pages/dist/bootstrap-clockpicker.js"></script>
<script src="vendors/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.js"></script>
<script src="vendors/clockpicker-gh-pages/dist/jquery-clockpicker.js"></script>
<script src="vendors/clockpicker-gh-pages/dist/jquery-clockpicker.min.js"></script>
 <script src="js/clockpicker.js"></script>
