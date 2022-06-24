<?php 
include('Model/database_connect.php');
session_start();
$errores = '';
if(isset($_POST['f_send'])){
 
    if(!empty($_POST['f_user'])){
        $b_user = $_POST['f_user'];
        $b_user = filter_var($b_user,FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'Ingresa tu nombre de usuario <br>';
    }
    if(!empty($_POST['f_pass'])){
        $b_password = $_POST['f_pass'];
    }else{
        $errores  .=  'Ingresa tu contraseña <br>';
    }

    if(empty($errores)){
        
        $query = "SELECT *FROM usuario WHERE nombre_usuario = :user
        AND clave_usuario = :pass";
        $statement  = $conn->prepare($query);
        $statement->execute(array(
            ':user' => $b_user,
            ':pass' => $b_password
        ));
        $result = $statement->fetch();
        if($result){
         
            $query2 = "select id_usuario from usuario WHERE nombre_usuario = :user2";
            $statement2 = $conn->prepare($query2);
            $statement2->execute( array (
               ':user2' => $b_user,
           ));

           while($row = $statement2->fetch()){
            $id_usuario = $row['id_usuario'];
           };
       
          $_SESSION['id_usuario'] = $id_usuario;
          $_SESSION['correo_usuario'] = $b_user;
         header("location: View/cuentas.php");
        }else{
            $errores .= 'Nombre o contraseña incorrecta. <br>';
        }

    }


}




?>