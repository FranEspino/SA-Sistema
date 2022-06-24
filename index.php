<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || Mercatronics</title>
    <link rel="stylesheet" href="Styles/login.css">

</head>
<body>
    <!-- Bloque: Header: independiente y reutilizable
         Header__search (elemento)  Header__button (elemento)-->
  
   <!-- Modificadores: solo cambiar apariencia  
        Header_button--primary y  Header_button--secondary-->

   <?php include('Controller/session_login.php')?>
    <nav class="Login--container">
     <div class="Login">
        <nav class="Login__title">
            <h3>Mercatronics</h3>
        </nav>
        <nav class="Login__avatar"> 
            <img src="Resources/profile.png" alt="">
        </nav>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="Login__form">
            <input name="f_user" type="text" class="Login__input" placeholder="Ingresar usuario"
            value="<?php 
             if(isset($_POST['f_send']) && !empty($_POST['f_user'])){
                echo $_POST['f_user'];
             }else{echo '';} ?>">

            <input name="f_pass" type="password" class="Login__input" placeholder="Ingresar usuario"
            value="<?php 
             if(isset($_POST['f_send']) && !empty($_POST['f_pass'])){
                echo $_POST['f_pass'];
             }else{echo '';} ?>">

            <input name="f_send" type="submit" class="Login__button--primary" value="Iniciar sesión"  >
        </form>
         <?php if(!empty($errores)): ?>
				<div class="Login__error">
                         <?php echo $errores; ?>
           		</div>
    	 <?php endif; ?>
    </div>
    
    </nav>
   

    
</body>



</html>