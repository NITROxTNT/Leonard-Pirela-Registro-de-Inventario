<?php 


if (!empty($_POST['usuario_nombre']) && !empty($_POST['usuario_password'])){

require_once("conexionbdd.php");

$_POST['usuario_password'] = md5($_POST['usuario_password']);
$consultaRegistro = $coneccion->prepare("INSERT INTO usuarios (usuario_nombre,usuario_password) VALUES (?,?);");
$consultaRegistro->bind_param("ss",$_POST['usuario_nombre'],$_POST['usuario_password']);

if ($consultaRegistro->execute()){echo json_encode("Registro Completado");}
else {echo json_encode("Registro no completado, prueba ingresar datos diferentes");}

}


?>