<?php 
include('../model/database_connect.php');

$nobre_cliente_b = $_POST['nobre_cliente_f'];
$dni_cliente_b = $_POST['dni_cliente_f'];
$correo_cliente_b = $_POST['correo_cliente_f'];
$id_producto_b = $_POST['id_producto_f'];
$cantidad_producto_b = $_POST['cantidad_producto_f'];
$id_trabajador_b = $_POST['id_trabajador_f'];


$query = "INSERT INTO `cliente` (`id_cliente`,
 `nombre_cliente`, `dni_cliente`,
  `correo_cliente`) VALUES (NULL, :nombre_cliente, 
  :dni_cliente, :correo_cliente);";

  $statement  = $conn->prepare($query);
  $statement->execute(array(
    ':nombre_cliente' => $nobre_cliente_b,
    ':dni_cliente' =>$dni_cliente_b,
    ':correo_cliente' =>$correo_cliente_b
));

$result= $statement->fetch();


$query1 = "SELECT MAX(id_cliente) AS id_cliente FROM cliente";
$statement1  = $conn->prepare($query1);
$statement1->execute();
while($row = $statement1 ->fetch()){
    $id_cliente= $row['id_cliente'];
}



$id_client= intval($id_cliente);
$id_trabajador = intval($id_trabajador_b);
$query2 = "INSERT INTO venta (id_venta, id_cliente, id_trabajador) VALUES (NULL, :id_cli, :id_trab)";
$statement2 = $conn->prepare($query2);
$statement2->execute(array(
  ':id_cli' => $id_client,
  ':id_trab' => $id_trabajador
));
$result2= $statement2->fetch();



$query3 = "SELECT MAX(id_venta) AS id_venta FROM venta";
$statement3  = $conn->prepare($query3);
$statement3->execute();
while($row = $statement3 ->fetch()){
    $id_venta= $row['id_venta'];
}


$id_venta_i = intval($id_venta);
$id_prod_i = intval($id_producto_b);

$query4 = "SELECT P.precio_producto AS precio_prod FROM producto P WHERE P.id_producto = $id_prod_i";
$statement4  = $conn->prepare($query4);
$statement4->execute();
while($row = $statement4 ->fetch()){
    $precio_producto= $row['precio_prod'];
}

$precio_produc_float = floatval($precio_producto);
$cantidad_produc_int = intval($cantidad_producto_b);
$descuento = 0;



$query5 = "INSERT INTO detalle_venta (id_venta, id_producto,
 precio_producto, cantidad_venta, descuento) 
 VALUES (:id_venta, :id_producto, :precio_producto, :cantidad, :descuento)";
$statement5 = $conn->prepare($query5);
$statement5->execute(array(
  ':id_venta' => $id_venta_i,
  ':id_producto' => $id_prod_i,
  ':precio_producto' => $precio_produc_float,
  ':cantidad' => $cantidad_produc_int,
  ':descuento' => $descuento
));

?>