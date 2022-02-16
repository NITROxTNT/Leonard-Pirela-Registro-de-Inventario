<?php 

session_start();
if (isset($_SESSION['usuario'])){
} else {header('Location: index.html'); die();}


if (!empty($_POST['producto_nombre']) && !empty($_POST['producto_cantidad']) && !empty($_POST['producto_precio'])){

require_once("conexionbdd.php");

$consultaRegistro = $coneccion->prepare("INSERT INTO productos (producto_nombre,producto_precio,producto_cantidad) VALUES (?,?,?);");
$consultaRegistro->bind_param("sdi",$_POST['producto_nombre'],$_POST['producto_precio'],$_POST['producto_cantidad']);

if ($consultaRegistro->execute()){echo json_encode("Registro Completado");}
else {echo json_encode("Registro no completado, prueba ingresar datos diferentes");}

}


?>