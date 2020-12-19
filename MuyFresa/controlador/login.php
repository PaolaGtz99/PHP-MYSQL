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
    $usuario = $_POST['nom'];
    $contra = $_POST['pass'];

    $sql = "SELECT * FROM usuarios WHERE userName = '$usuario'";
    $resultado = $conexion->query($sql);
   
    if($resultado -> num_rows){

        $datos = $resultado -> fetch_assoc();
        
        if($datos['passw'] == $contra)  echo json_encode("TRUE");
        else  echo json_encode("FALSE");
       
    }
    else{
        echo json_encode("FALSE");
    }
}

?>
