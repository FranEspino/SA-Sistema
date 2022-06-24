<?php 


function generatePassword($longitud){
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    for($i=0;$i<$longitud;$i++) {
    $password .= substr($str,rand(0,62),1);
    }
    return $password;
}

include('../Model/database_connect.php');

$nombre_trabajador_b = $_POST['nombre_trabajador_f'];
$dni_trabajador_b = $_POST['dni_trabajador_f'];
$correo_trabajador_b =$_POST['correo_trabajador_f'];
$direccion_trabajador_b =$_POST['direccion_trabajador_f'];
$sexo_trabajador_b =$_POST['sexo_trabajador_f'];
$tipo_trabajador_b =$_POST['tipo_trabajador_f'];


$query1 = "INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `clave_usuario`) VALUES (NULL, :user, :pass)";

$password = $dni_trabajador_b . generatePassword(4);
$statement1  = $conn->prepare($query1);
$statement1->execute(array(
  ':user' => $correo_trabajador_b,
  ':pass' =>$password
));
$result1= $statement1->fetch();


$query2 = "SELECT MAX(id_usuario) AS id_usuario FROM usuario";
$statement2  = $conn->prepare($query2);
$statement2->execute();
while($row = $statement2 ->fetch()){
    $idusuario= $row['id_usuario'];
}

$iduser = intval($idusuario);

echo $iduser;
$query3 = "INSERT INTO trabajador
 (id_trabajador,id_usario,nombre_trabajador,dni_trabajador,
correo_trabajador,sexo_trabajador,tipo_trabajador,direccion_trabajador)
 VALUES (NULL, :id_user, :nombre_trb, :dni_trb, :correo_trb, :sexo_trb, :tipo_trb, :dir_trb)";
  $statement3  = $conn->prepare($query3);
  $statement3->execute(array(
    ':id_user' => $iduser,
    ':nombre_trb' =>$nombre_trabajador_b,
    ':dni_trb' =>$dni_trabajador_b,
    ':correo_trb' =>$correo_trabajador_b,
    ':sexo_trb' =>$sexo_trabajador_b,
    ':tipo_trb' =>$tipo_trabajador_b,
    ':dir_trb' =>$direccion_trabajador_b
));
$result= $statement3->fetch();
echo json_encode()

?>