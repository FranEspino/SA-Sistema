<?php 
include('../Model/database_connect.php');
$query = "SELECT P.nombre_producto, P.modelo_producto, P.stock_producto, P.precio_producto FROM producto P";

$statement = $conn->prepare($query);

$resultado= $statement->execute();

$json = array();
while($row = $statement->fetch()){
    $json[] = array(
    'nombre_producto' => $row['nombre_producto'],
    'modelo_producto' => $row['modelo_producto'],
    'stock_producto' => $row['stock_producto'],
    'precio_producto' => $row['precio_producto']
    );

}

echo json_encode($json);


?>