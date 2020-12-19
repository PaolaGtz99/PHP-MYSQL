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

    $sql = "SELECT * FROM pedidos WHERE id = $id";
    $resultado = $conexion->query($sql);

    if($resultado -> num_rows){
        $datos = $resultado -> fetch_assoc();
        $cli = $datos['cliente'];
        $fecha = date($datos['entrega']);
        $precio = rand(50,300);
    }
    
    $conexion->close();

    
    $conexion2 = new mysqli($servidor,$cuenta,$password,$bd);
    $sql2 = "DELETE FROM pedidos WHERE id = $id";
    $conexion2->query($sql2);
    $conexion2->close();

    $conexion3 = new mysqli($servidor,$cuenta,$password,$bd);
    $sql3 = "INSERT INTO ventas (cliente,fecha,ganancia) VALUES ('$cli','$fecha','$precio')";
    $conexion3->query($sql3);
    $conexion3->close();
}

?>