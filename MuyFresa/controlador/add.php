<?php

$servidor='localhost';
$cuenta='root';
$password='';
$bd='analisis';

$conexion = new mysqli($servidor,$cuenta,$password,$bd);

if($conexion->connect_errno){
    die('Error en conexion');
    echo json_encode("no");
}
else{
    $cliente = $_POST['cliente'];
    $tipo = $_POST['tipo'];
    $fecha = date($_POST['fecha']);

    $sql = "INSERT INTO pedidos (cliente,tipo,entrega) VALUES ('$cliente','$tipo','$fecha')";
    $conexion->query($sql);
    $conexion->close();
}

?>