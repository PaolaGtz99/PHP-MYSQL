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

    $sql = "SELECT * FROM pedidos ORDER BY entrega";
    $resultado = $conexion->query($sql);
    $tabla = '<div class="col">
            <div class="row bg-dark text-white pad centrar"> <h4>AÑADIR PEDIDO</h4> </div>
            <div class="row">
            <div class="col margen"><input class="form-control" id="nomCli" type="text" placeholder="Nombre Cliente"></div>
            <div class="col margen"><input class="form-control" id="tipoPed" type="text" placeholder="Tipo pedido"></div>
            </div>
            <div class="row">
            <div class="col">
            <input class="form-control margen" type="date" id="entrega" name="trip-start" min="2020-06-01" max="2021-12-31">
            </div>
            <div class="col">
            <button type="button" class="btn btn-success form-control margen" onclick="elegir(2,0)">Añadir</button>
            </div>
            </div>
            <small style="display: none; color: red;" id="error" class="form-text">Error en datos</small>
            </div>';
            
    $tabla = $tabla.'<table class="table table-hover centrar margen">
                <thead class="thead-dark">
                     <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Tipo Pedido</th>
                    <th>Fecha</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>';
    while($fila = $resultado -> fetch_assoc()){
    $tabla = $tabla.'
            <tr>
            <th scope="row">'.$fila['id'].'</th>
            <td>'.$fila['cliente'].'</td>
            <td>'.$fila['tipo'].'</td>
            <td>'.$fila['entrega'].'</td>
            <td>
            <button data-placement="top" title="Cancelar" type="button" onclick="elegir(1,'.$fila['id'].')" class="btn btn-danger"><i class="fas fa-times"></i></button>
            <button data-placement="top" title="Entregado" type="button" onclick="elegir(3,'.$fila['id'].')" class="btn btn-success"><i class="fas fa-check"></i></button>
            </td>
            </tr>';
    }
    $tabla = $tabla.'</tbody>
    </table>';
    echo json_encode($tabla);
    $conexion->close();
}

?>