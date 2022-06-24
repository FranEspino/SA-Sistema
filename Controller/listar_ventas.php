<?php 
include('../Model/database_connect.php');
$query = "SELECT C.nombre_cliente, PR.nombre_producto, DT.cantidad_venta, DT.cantidad_venta * PR.precio_producto  AS importe from cliente C INNER JOIN venta V ON V.id_venta = C.id_cliente INNER JOIN detalle_venta DT ON DT.id_venta = V.id_venta INNER JOIN producto PR ON PR.id_producto = DT.id_producto";
$statement = $conn->prepare($query);
$resultado= $statement->execute();
$json = array();
while($row = $statement->fetch()){
    $json[] = array(
    'nombre_cliente_b' => $row['nombre_cliente'],
    'nombre_producto_b' => $row['nombre_producto'],
    'cantidad_venta_b' => $row['cantidad_venta'],
    'importe_b' => $row['importe']
    );
}

echo json_encode($json);


?>