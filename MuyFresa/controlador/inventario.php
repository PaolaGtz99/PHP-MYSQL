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

    $sql = "SELECT * FROM inventario";
    $resultado = $conexion->query($sql);
    $tabla = '<h2 class="pad centrar">INVENTARIO</h2> <div class="col">
            <div class="row bg-dark text-white pad"> <h4>EDITAR</h4> </div>
            <div class="row">
            <div class="col-2 margen"><input class="form-control" id="idInv" type="text" placeholder="ID" disabled></div>
            <div class="col margen"><input class="form-control" id="prod" type="text" placeholder="PRODUCTO" disabled></div>
            <div class="col margen"><input class="form-control" id="cant" type="number" placeholder="CANTIDAD" disabled></div>
            </div>
            <div class="row">
            <div class="col">
            <input class="form-control margen" id="prov" type="text" placeholder="PROVEEDOR" disabled>
            </div>
            <div class="col">
            <button type="button" class="btn btn-success form-control margen" id="guardar" onclick="elegir(5,0)" disabled>GUARDAR</button>
            </div>
            </div>
            <small style="display: none; color: red;" id="error" class="form-text">Error en datos</small>
            </div>';

    $tabla = $tabla.'<table class="table table-hover centrar margen">
                <thead class="thead-dark">
                     <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Proveedor</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>';
    while($fila = $resultado -> fetch_assoc()){
    $tabla = $tabla.'
            <tr>
            <th scope="row">'.$fila['id'].'</th>
            <td>'.$fila['producto'].'</td>
            <td>'.$fila['cantidad'].'</td>
            <td>'.$fila['proveedor'].'</td>
            <td><button data-placement="top" title="editar" type="button" onclick="elegir(4,'.$fila['id'].')" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></button></td>
            </tr>';
    }
    $tabla = $tabla.'</tbody>
    </table>';
    echo json_encode($tabla);
    $conexion->close();
}

?>