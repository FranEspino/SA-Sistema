<?php 
include('../model/database_connect.php');

$id_producto_b = $_POST['id_producto_f'];
$id_producto_b = intval($id_producto_b);
$query = "SELECT P.nombre_producto AS nombre_producto from producto P WHERE id_producto = $id_producto_b ";
$statement  = $conn->prepare($query);
$statement->execute();
while($row = $statement ->fetch()){
    $nombre_producto_b= $row['nombre_producto'];
}

$producto []= array(
    "nombre_producto_b" =>  $nombre_producto_b
);

echo  json_encode($producto); 

?>