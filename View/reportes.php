<?php
session_start();
if (empty($_SESSION)) {
  header("location: ../index.php");
} else {
  $id_user =  $_SESSION['id_usuario'];
  $name_user =  $_SESSION['correo_usuario'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e3cac9ba50.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Styles/dashboard.css">
    <script src="../Resource/jquery.min.js" ></script>
    <script src="../Resources/plotly-latest.min.js"></script>
    <link rel="stylesheet" href="../Styles/venta.css">
    <title>Productos</title>
</head>
<body>
<div class="Table__general"> 
        <?php include('dashboard.php'); ?>

        <div style="text-align:center;">
        <h1 style="  font-family: 'Mulish', sans-serif;
  font-weight: bold;">Reportes de ventas 2021</h1>
        <div id="reporte" style="width: 1085px; height: 750px;">
       
       <script>
        
           Plotly.newPlot('reporte', data);
       </script>

    </div>
        
        </div>
     


    
</div>


<script src="../Resources/jquery.min.js" ></script>
    <script src="../Resource/plotly-latest.min.js"></script>
</body>

<script> 




$(document).ready(function(){
    
    var data = [
          {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
            y: [20, 14, 23,12,38],
            type: 'bar'
          }
        ];
                Plotly.newPlot(reporte, data);
})


</script>




</html>