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
    <link rel="stylesheet" href="../Styles/venta.css">
    <title>Productos</title>
</head>
<body>
<div class="Table__general"> 
        <?php include('dashboard.php'); ?>

        <div class="Table__container">
            
            <div class="Table__content">
                <h2>Productos</h2>
                <div class="Table__user">
                <p><?php echo $name_user; ?></p>
                    <img src="../Resources/user.png" alt="Usuario" style="margin-left: 2em">
                </div>
            </div>

            <div class="Table__add">
                <p>Productos disponibles</p>
                <div id="add_venta"><img src="../Resources/plus.png" alt=""></div>
            </div>

            <table  class="bg-primary  table table-bordered table-sm text-center" >
              <thead id="Client_wanted">
              </thead>      
         </table>
         
         
         <table class="Table__ventas">
                    <thead>
                        <tr class="information_head">
                            <th >Producto</th>
                            <th>Modelo</th>
                            <th >Stock</th>
                            <th >Precio Unidad</th>
                            <th >Acción</th>

                          </tr>
                    </thead>
                    <tbody id="information_colum_prod">
                       
                       
              
                    </tbody>                   
                </table>      
                
                <div class="Modal__container_pord" id="Modal__container">
                  
                     <div class="Modal__close" >
                       <img src="../Resources/cancel.png" alt="" id="cerrar_modal">
                     </div>

                     <div class="Modal__input--container">
                          <div class="Modal__inputone">
                              <label for="">Nombre de producto </label>
                              <input id ="nombre_producto" class="Modal__input" type="text">
                              <label for="">Modelo de producto</label>
                              <input id="modelo_producto" class="Modal__input"  type="text">
                              <label for="">Precio del producto</label>
                              <input id="precio_producto" class="Modal__input" type="number">
                  
                          </div>
                          
                          <div  class="Modal__inputtwo">
                      
                          <label  >Stock del producto </label>
                          <input style="margin-top:1em;" id="stock_producto" class="Modal__input" type="number">
                           <label  style="margin-top:2em;" >Descripción del producto </label>
                           <input  style="margin-top:1em;" id="descripcion_producto" class="Modal__inputarea" type="text">
                          <input style="nargin-top:1em;" id="registrar_producto" type="submit" class="Modal__registrar" value="Registrar">
                          </div>                    
                       </div>

                </div>              



        </div>
</div>


<script src="../Resources/jquery.min.js" ></script>

</body>

<script> 
$(document).ready(function(){
  $("#Modal__container").hide();
 listarProductos()
})


function listarProductos(){
        $.ajax({
            method:"GET",
            url : 'http://localhost/projects/Mercatronics/Controller/listar_productos.php',
            success:function(data){
                console.log(data)
                let datos = JSON.parse(data)
                console.log(datos)
                for (let item of datos) {
                add(item);
                }

            }            
        });
    }

    function add(item){
         $('#information_colum_prod').append(' <tr class="information_colum"> <td >'+item.nombre_producto+'</td> <td  >item.modelo_producto</td> <td >item.stock_producto</td><td >'+item.precio_producto+'</td> <td> <div class="Section_option"> <a id="'+item.idusuario+'" class="Button__see">Ver</a> <a id="'+item.idusuario+'" class="Button__modify">Modificar</a><a id="'+item.idusuario+'" class="Button__eliminar">Eliminar</a></div></td></tr>');
    
        }



$('#registrar_producto').click(function(e){
  e.preventDefault()
      let nombre_prod = $('#nombre_producto').val()
      let modelo_prod = $('#modelo_producto').val()
      let precio_prod = $('#precio_producto').val()
      let stock_prod = $('#stock_producto').val()
      let descripcion_prod =  $('#descripcion_producto').val()
  

      var json ={
        'nombre_prod_f' : nombre_prod,
        'modelo_prod_f' : modelo_prod,
        'precio_prod_f' : precio_prod,
        'stock_prod_f' : stock_prod,
        'descripcion_prod_f' : descripcion_prod
        }

      $.ajax({
            method:"POST",
            data: json,
            url : 'http://localhost/projects/Mercatronics/Controller/agregar_producto.php',
            success:function(r){
              window.location.href='http://localhost/projects/Mercatronics/View/productos.php'    
            }
    
      });
  
})




    $('#add_venta').click(function(){
      $('#Modal__container').show(200);
        $("#Modal__container").show();
    })

    $('#cerrar_modal').click(function(){
      $('#Modal__container').hide(200);
        $("#Modal__container").hide();
    })




</script>




</html>