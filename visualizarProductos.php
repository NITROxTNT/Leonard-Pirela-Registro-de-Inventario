<?php 

session_start();

require_once("conexionbdd.php");


    if (isset($_SESSION['usuario'])){
    } else {header('Location: index.html'); die();}

$consultaRegistro = $coneccion->prepare("SELECT producto_id,producto_nombre,producto_precio,producto_cantidad FROM productos;");
$consultaRegistro -> execute();
$resultadoConsulta = $consultaRegistro -> get_result();


    if($resultadoConsulta -> num_rows > 0 ){
        
        $jsonArray = array();
        $contador = 0;


        while ($fila = $resultadoConsulta -> fetch_assoc()){

          $jsonArray[$contador]['producto_id'] = $fila['producto_id'];
          $jsonArray[$contador]['producto_nombre'] = $fila['producto_nombre'];
          $jsonArray[$contador]['producto_precio'] = $fila['producto_precio'];
          $jsonArray[$contador]['producto_cantidad'] = $fila['producto_cantidad'];

          $contador++;

        }


        echo json_encode($jsonArray);

    } else {echo json_encode(0);}



?>