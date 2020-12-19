<?php

$servidor='localhost';
$cuenta='root';
$password='';
$bd='analisis';

$conexion = new mysqli($servidor,$cuenta,$password,$bd);
$usuario = $_GET['userName'];
$sql = "SELECT nombre FROM usuarios WHERE userName = '$usuario'";
$resultado = $conexion->query($sql);
$datos = $resultado -> fetch_assoc();
$nombre = $datos['nombre'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
  <title>muyFresa</title>
</head>
<body>
    <div class="container">
        <br><br><br>
        <div class="row">
            <div class="col"></div>

            <div class="col-11">
                <div class="card tam">
                    <div class="card-body container">
                      
                        <div class="row">
                            <div class="col-2 centrar borde">
                            <br><img src="../media/logo.png" alt=""><br>
                            <h5><?php echo $nombre; ?></h5>
                            <br>
                                <div class="btn-group-vertical" role="group">
                                <button type="button" class="btn btn-danger" onclick="mostrar('pedidos.php')" >PEDIDOS</button>
                                <br><button type="button" class="btn btn-danger" onclick="mostrar('ventas.php')">VENTAS</button>
                                <br><button type="button" class="btn btn-danger" onclick="mostrar('inventario.php')">INVENTARIO</button>
                                </div>   
                                <a href="../index.html" class="margen btn btn-dark"><i class="fas fa-undo-alt"></i></a>
                                <a href="ajustes.php?userName=<?php echo $usuario;?>" class="margen btn btn-dark"><i class="fas fa-cog"></i></a>
                            </div>
                            
                            <div class="col" id="pantalla">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col centrar margen"><br><br><img src="../media/user.png" alt="">
                                    <h1>BIENVENIDO</h1>
                                <h3><?php echo $nombre; ?></h3></div>
                                    <div class="col"></div>
                                </div>
                            </div>
                            
                    </div>
                  </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
    <script>
        
    </script>
    
    <script src="../js/funciones.js"></script>
</body>
</html>