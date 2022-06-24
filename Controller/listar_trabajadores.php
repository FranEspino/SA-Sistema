<?php 
include('../Model/database_connect.php');
$query = "SELECT T.nombre_trabajador,T.direccion_trabajador, T.tipo_trabajador, T.dni_trabajador, T.correo_trabajador from trabajador T";

$statement = $conn->prepare($query);

$resultado= $statement->execute();

$json = array();
while($row = $statement->fetch()){
    $json[] = array(
    'nombre_empleado' => $row['nombre_trabajador'],
    'direccion_empleado' => $row['direccion_trabajador'],
    'tipo_emplado' => $row['tipo_trabajador'],
    'dni_empleado' => $row['dni_trabajador'],
    'correo_empleado' => $row['correo_trabajador']
    );
}

echo json_encode($json);


?>