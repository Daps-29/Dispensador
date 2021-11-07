<?php

header('Content-Type: application/json');
$pdo = new PDO("mysql:dbname=admin_dispo;host=dispo.ga","admin_disp","david123");
$accion = (isset($_GET['accion']))?$_GET['accion']:'leer';
switch ($accion) {
  case 'agregar':
    $sensql = $pdo->prepare("INSERT INTO eventos(title,descripcion,color,textColor,start,end)
    VALUES(:title,:descripcion,:color,:textColor,:start,:end)");
    $respuesta=$sensql->execute(array(
      "title" =>$_POST['title'],
      "descripcion" =>$_POST['descripcion'],
      "color" =>$_POST['color'],
      "textColor" =>$_POST['textColor'],
      "start" =>$_POST['start'],
      "end" =>$_POST['end']
    ));
    echo json_encode($respuesta);
    break;
  case 'eliminar':
    echo "el";
    $respuesta=false;
    if (isset($_POST['id'])) {
      $sensql = $pdo->prepare("DELETE FROM eventos WHERE ID=:ID");
      $respuesta=$sensql->execute(array("ID"=>$_POST['id']));
    }
    echo json_encode($respuesta);
    break;
    case 'editar':
      echo "ed";
      $sensql = $pdo->prepare("UPDATE eventos SET
        title=:title,
        descripcion=:descripcion,
        color=:color,
        textColor=:textColor,
        start=:start,
        end=:end
        WHERE ID=:ID
        ");
        $respuesta=$sensql->execute(array("ID"=>$_POST['id'],
        "title" =>$_POST['title'],
        "descripcion" =>$_POST['descripcion'],
        "color" =>$_POST['color'],
        "textColor" =>$_POST['textColor'],
        "start" =>$_POST['start'],
        "end" =>$_POST['end']));
        echo json_encode($respuesta);
      break;
  default:
  $Sql = $pdo->prepare("SELECT * FROM eventos");
  $Sql->execute();
  $Resultado =$Sql->fetchAll(PDO::FETCH_ASSOC);
  echo json_encode($Resultado);
    break;
}

 ?>
