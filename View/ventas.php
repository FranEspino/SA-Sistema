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

    <title>Ventas</title>
</head>
<body>
<div class="Table__general"> 
        <?php include('dashboard.php'); ?>

        <div class="Table__container">
            
            <div class="Table__content">
                <h2>Pedidos</h2>
                <div class="Table__user">
                <p><?php echo $name_user; ?></p>
                    <img src="../Resources/user.png" alt="Usuario" style="margin-left: 2em">
                </div>
            </div>

            <div class="Table__add">
                <p>Ventas</p>
                <div id="add_venta"><img src="../Resources/plus.png" alt=""></div>
            </div>

            <table  class="bg-primary  table table-bordered table-sm text-center" >
              <thead id="Client_wanted">
              </thead>      
         </table>
         
         
         <table class="Table__ventas">
                    <thead>
                        <tr class="information_head">
                            <th >Cliente</th>
                            <th>Pedido</th>
                            <th >Cantidad</th>
                            <th >Importe</th>
                            <th >Acción</th>
                          </tr>
                    </thead>
                    <tbody id="information_colum_ventas">
                       
                       
              
                    </tbody>                   
                </table>      
                
                <div class="Modal__container_vent" id="Modal__container">
                  
                     <div class="Modal__close" >
                       <img src="../Resources/cancel.png" alt="" id="cerrar_modal">
                     </div>

                     <div class="Modal__input--container">
                          <div class="Modal__inputone">
                              <label for="">Nombre del cliente </label>
                              <input id ="nombre_cliente" class="Modal__input" type="text">
                              <label for="">Dni del cliente</label>
                              <input id="dni_cliente" class="Modal__input"  type="text">
                              <label for="">Correo del cliente</label>
                              <input id="correo_cliente" class="Modal__input" type="text">
                  
                          </div>
                          
                          <div  class="Modal__inputtwo">
                      
                          <label  >Codigo del producto </label>
                                <div class="buscar_productoid">
                                        <input id="id_producto"  style="margin-top:1em; width:80px !important;" class="Modal__input" type="number">
                                        <input id="buscar_producto" type="submit" name=""   value="Buscar" style="cursor: pointer;  
                                            display: flex;
                                            flex-direction: row;
                                            justify-content: center;
                                            align-items: center;
                                            padding: 12px 16px;
                                            position: static;
                                            width: 102px;
                                            height: 40px;
                                            background: #0066FF;
                                            border-radius: 8px;
                                            border: none;
                                            color: #FFFFFF;
                                            font-weight: bold;
                                            margin-top: 15px;
                                            margin-left: 15px;
                                            -webkit-box-shadow: 2px 2px 29px -22px rgba(0,0,0,0.75);
                                            -moz-box-shadow: 2px 2px 29px -22px rgba(0,0,0,0.75);
                                            box-shadow: 2px 2px 29px -22px rgba(0,0,0,0.75);">
                                </div>
                                <label style="margin-top: 1em" >Nombre del producto </label>
                                <input  id="nombre_prodbuscado" style="margin-top: 1em ;width:180px !important;" class="Modal__input" type="text">              
                               <label  style="margin-top:2em; margin-bottom:1em;" >Cantidad de producto </label>
                               <input id="cantidad_producto" style="width: 50px !important;" class="Modal__input"  type="number">
                               <input id="registrar_venta" type="submit" class="Modal__registrar" value="Registrar">

                            </div>    
                            <input id="id_usuarioActual" type="text" style="display:none" value="<?php echo $id_user;?>" >                
                       </div>

                </div>              



        </div>
</div>


<script src="../Resources/jquery.min.js" ></script>

</body>

<script> 
let id_trabajador

$(document).ready(function(){
  listarProductos();
  $("#Modal__container").hide();
 let idusuarioactual =   $('#id_usuarioActual').val()
 var json_user ={
        'id_usuario_f' : idusuarioactual
  }

 $.ajax({
            method:"POST",
            data: json_user,
            url : 'http://localhost/projects/Mercatronics/Controller/buscar_trabajador.php',
            success:function(r){
                var resp = JSON.parse(r)
                let nombre_producto_f =  resp[0].id_trabajador_b
                id_trabajador = nombre_producto_f

          }
                
  });


})


$('#buscar_producto').click(function(e){
    e.preventDefault()
    let id_producto_f = $('#id_producto').val()
        var json1 ={
        'id_producto_f' : id_producto_f
        }
   console.log(json1)
    $.ajax({
            method:"POST",
            data: json1,
            url : 'http://localhost/projects/Mercatronics/Controller/buscar_producto.php',
            success:function(r){
                console.log(r)
                var resp = JSON.parse(r)
                let nombre_producto_f =  resp[0].nombre_producto_b
                $('#nombre_prodbuscado').val(nombre_producto_f)

          }
                
        });

});


   function listarProductos(){
        $.ajax({
            method:"GET",
            url : 'http://localhost/projects/Mercatronics/Controller/listar_ventas.php',
            success:function(data){
           
                let datos = JSON.parse(data)
                console.log(datos)
                
                for (let item of datos) {
                  addventa(item);
                }

            }            
        });
    }

    function addventa(item){
         $('#information_colum_ventas').append('<tr class="information_colum"> <td style="margin-left:40px;">'+item.nombre_cliente_b+'</td><td style="margin-left:160px;" >'+item.nombre_producto_b+'</td>  <td style="margin-left:120px;">'+item.cantidad_venta_b+'</td><td style="margin-left:100px;">'+item.importe_b+'</td><td> <div class="Section_option"> <a id="'+item.cantidad_venta_b+'" class="Button__see">Ver</a> <a id="'+item.idusuario+'" class="Button__modify">Modificar</a><a id="'+item.idusuario+'" class="Button__eliminar">Eliminar</a></div></td></tr>');
    
        }


$('#registrar_venta').click(function(e){
  e.preventDefault()
      let nobre_cliente = $('#nombre_cliente').val()
      let dni_cliente = $('#dni_cliente').val()
      let correo_cliente = $('#correo_cliente').val()
      let id_producto = $('#id_producto').val()
      let cantidad_producto =  $('#cantidad_producto').val()
      let idusuarioactual =   $('#id_usuarioActual').val()

      var json ={
        'nobre_cliente_f' : nobre_cliente,
        'dni_cliente_f' : dni_cliente,
        'correo_cliente_f' : correo_cliente,
        'id_producto_f' : id_producto,
        'cantidad_producto_f' : cantidad_producto,
        'id_trabajador_f': id_trabajador,
        
        }

      $.ajax({
            method:"POST",
            data: json,
            url : 'http://localhost/projects/Mercatronics/Controller/agregar_venta.php',
            success:function(r){
             window.location.href='http://localhost/projects/Mercatronics/View/ventas.php'    
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