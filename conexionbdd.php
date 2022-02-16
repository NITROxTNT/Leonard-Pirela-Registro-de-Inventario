<?php 

$coneccion = new mysqli ("localhost","root","","bddinventario");
if ($coneccion -> connect_errno) {
    echo json_encode("Failed to connect to MySQL: " . $mysqli -> connect_error);
    exit(); die();
  }

?>