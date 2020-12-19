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
    $nombre = $_POST['nombre'];
    $tel = $_POST['telefono'];
    $dir = $_POST['dircl'];

    $sql = "INSERT INTO clientes (nombre,telefono,direccion) VALUES ('$nombre','$tel','$dir')";
    $conexion->query($sql);
    $conexion->close();
}

?>