<?php 

//echo json_encode("merwebo"); die();

if (!empty($_POST['producto_id']) && !empty($_POST['producto_cantidad'])){

require_once("conexionbdd.php");

$consultaRegistro = $coneccion->prepare("UPDATE productos SET producto_cantidad = ? WHERE producto_id = ?");
$consultaRegistro->bind_param("ii",$_POST['producto_cantidad'],$_POST['producto_id']);

if ($consultaRegistro->execute()){echo json_encode("Cantidad Cambiada");}
else {echo json_encode("Ha habido un error al cambiar la cantidad");}

}


?>