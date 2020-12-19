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
    $id = $_POST['id'];

    $sql = "DELETE FROM pedidos WHERE id = $id";
    $conexion->query($sql);
    $conexion->close();
}

?>