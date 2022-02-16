<?php 



if (!empty($_POST['producto_id'])){

require_once("conexionbdd.php");

$consultaRegistro = $coneccion->prepare("DELETE FROM productos WHERE producto_id = ? ;");
$consultaRegistro->bind_param("i",$_POST['producto_id']);

if ($consultaRegistro->execute()){echo json_encode("Producto Eliminado");}
else {echo json_encode("No se ha podido eliminar el producto");}

}


?>