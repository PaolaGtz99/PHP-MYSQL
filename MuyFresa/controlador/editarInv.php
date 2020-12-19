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
    $nom = $_POST['prod'];
    $cant = $_POST['cant'];
    $prov = $_POST['prov'];
  
    $sql = "UPDATE inventario SET producto ='$nom', cantidad = '$cant', proveedor = '$prov' WHERE id = $id";
    $resultado = $conexion->query($sql);
}
$conexion->close();
?>  