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

    $sql = "SELECT * FROM ventas ORDER BY fecha";
    $resultado = $conexion->query($sql);
    $tabla = '<h2 class="pad centrar">VENTAS</h2> <table class="table table-hover centrar margen">
                <thead class="thead-dark">
                     <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Ganancia</th>
                    </tr>
                </thead>
                <tbody>';
    while($fila = $resultado -> fetch_assoc()){
    $tabla = $tabla.'
            <tr>
            <th scope="row">'.$fila['id'].'</th>
            <td>'.$fila['cliente'].'</td>
            <td>'.$fila['fecha'].'</td>
            <td class="bg-success" >$'.$fila['ganancia'].'.00</td>
            </tr>';
    }
    $tabla = $tabla.'</tbody>
    </table>';
    echo json_encode($tabla);
    $conexion->close();
}

?>