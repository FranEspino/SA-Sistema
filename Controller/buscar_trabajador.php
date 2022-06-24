<?php 
include('../model/database_connect.php');

$id_usuario_b = $_POST['id_usuario_f'];
$id_usuario = intval($id_usuario_b);
$query = "SELECT id_trabajador FROM trabajador WHERE id_usario = $id_usuario";
$statement  = $conn->prepare($query);
$statement->execute();
while($row = $statement ->fetch()){
    $id_trabajador= $row['id_trabajador'];
}

$trabajador []= array(
    "id_trabajador_b" =>  $id_trabajador
);

echo  json_encode($trabajador); 

?>