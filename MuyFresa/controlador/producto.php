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
  
    $sql = "SELECT * FROM inventario WHERE id = $id";
    $resultado = $conexion->query($sql);
 
    if($resultado -> num_rows){
        $datos = $resultado -> fetch_assoc();
        $array = array($datos['id'],$datos['producto'],$datos['cantidad'],$datos['proveedor']);
        echo json_encode($array);
    }
    else {echo json_encode("FALf");}
}
$conexion->close();
?>    