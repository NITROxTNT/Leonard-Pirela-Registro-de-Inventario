<?php 



if (!empty($_POST['usuario_nombre']) && !empty($_POST['usuario_password'])){

require_once("conexionbdd.php");

$_POST['usuario_password'] = md5($_POST['usuario_password']);

$consultaRegistro = $coneccion->prepare("SELECT usuario_nombre FROM usuarios WHERE usuario_nombre = ? AND usuario_password=?;");
$consultaRegistro->bind_param("ss",$_POST['usuario_nombre'],$_POST['usuario_password']);
$consultaRegistro -> execute();
$consultaRegistro -> store_result();

    if($consultaRegistro-> num_rows > 0 ){
        $consultaRegistro->bind_result($nombreUsuario);
        $consultaRegistro -> fetch();
        if(session_start()){
        $_SESSION['usuario'] = $nombreUsuario;
        echo json_encode($nombreUsuario);
        } else {echo son_encode(0);}
    } else {echo json_encode(0);}
}


?>