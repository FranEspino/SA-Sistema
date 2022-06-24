<?php 
include('../model/database_connect.php');

$nombre_prod_b = $_POST['nombre_prod_f'];
$modelo_prod_b = $_POST['modelo_prod_f'];
$precio_prod_b = $_POST['precio_prod_f'];
$stock_prod_b = $_POST['stock_prod_f'];
$descripcion_prod_b = $_POST['descripcion_prod_f'];


$query = "INSERT INTO producto (id_producto, nombre_producto, modelo_producto, 
precio_producto, stock_producto, descripcion_producto) 
VALUES (NULL, :nombre_prod, :modelo_prod,:precio_prod, :stock_prod, :desc_prod)";

$precio_prod = floatval($precio_prod_b);
$stock_prod = intval($stock_prod_b);

  $statement  = $conn->prepare($query);
  $statement->execute(array(
    ':nombre_prod' => $nombre_prod_b,
    ':modelo_prod' =>$modelo_prod_b,
    ':precio_prod' =>$precio_prod,
    ':stock_prod' =>$stock_prod,
    ':desc_prod' =>$descripcion_prod_b,
));
$result= $statement->fetch();
if($row = $statement->fetch(PDO::FETCH_ASSOC)){
  echo json_encode($row,JSON_UNESCAPED_UNICODE);
}


?>