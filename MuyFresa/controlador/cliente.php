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

    $sql = "SELECT * FROM clientes";
    $resultado = $conexion->query($sql);
    $tabla = '<h2 class="pad centrar">CLIENTES</h2> <div class="col">
            <div class="row bg-dark text-white pad"> <h4>EDITAR</h4> </div>
            <div class="row">
            <div class="col margen"><input class="form-control" id="nomcl" type="text" placeholder="NOMBRE"></div>
            <div class="col margen"><input class="form-control" id="telcl" type="number" placeholder="TELEFONO"></div>
            </div>
            <div class="row">
            <div class="col">
            <input class="form-control margen" id="dircl" type="text" placeholder="DIRECCION">
            </div>
            <div class="col">
            <button type="button" class="btn btn-success form-control margen" id="guardar" onclick="elegir(6,0)">GUARDAR</button>
            </div>
            </div>
            <small style="display: none; color: red;" id="error" class="form-text">Error en datos</small>
            </div>';

    $tabla = $tabla.'<table class="table table-hover centrar margen">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';
    while($fila = $resultado -> fetch_assoc()){
    $tabla = $tabla.'
            <tr>
            <th scope="row">'.$fila['idCliente'].'</th>
            <td>'.$fila['nombre'].'</td>
            <td>'.$fila['telefono'].'</td>
            <td>'.$fila['direccion'].'</td>            
            </tr>';
    }
    $tabla = $tabla.'</tbody>
    </table>';
    echo json_encode($tabla);
    $conexion->close();
}

?>