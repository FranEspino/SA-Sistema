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
    <title>Cuentas</title>
</head>
<body>
<div class="Table__general"> 
        <?php include('dashboard.php'); ?>

        <div class="Table__container">
            
            <div class="Table__content">
                <h2>Cuentas</h2>
                <div class="Table__user">
                    <p><?php echo $name_user; ?></p>
                    <img src="../Resources/user.png" alt="Usuario" style="margin-left: 2em">
                </div>
            </div>

            <div class="Table__add">
                <p>Cuentas de usuario</p>
                <div id="add_venta"><img src="../Resources/plus.png" alt=""></div>
            </div>

            <table  class="bg-primary  table table-bordered table-sm text-center" >
              <thead id="Client_wanted">
              </thead>      
         </table>
         
         
         <table class="Table__ventas">
                    <thead>
                        <tr class="information_head">
                            <th >Usuario</th>
                            <th>Dirección</th>
                            <th >Tipo</th>
                            <th >Dni</th>
                            <th >Correo</th>
                            <th  >Acción</th>
                        </tr>
                    </thead>
                    <tbody id="information_colum">
                       
                             
                      
                        
                    </tbody>                   
                </table>      
                
                <div class="Modal__container" id="Modal__container">
                  
                     <div class="Modal__close" >
                       <img src="../Resources/cancel.png" alt="" id="cerrar_modal">
                     </div>

                     <div class="Modal__input--container">
                          <div class="Modal__inputone">
                              <label for="">Nombre del trabajador </label>
                              <input id="nombre_trabajador" class="Modal__input" type="text">
                              <label for="">Dni del trabajador</label>
                              <input id="dni_trabajador" class="Modal__input"  type="text">
                              <label for="">Correo del trabajador</label>
                              <input id="correo_trabajador" class="Modal__input" type="text">
                              <label for="">Dirección del trabajador</label>
                              <input id="direccion_trabajador" class="Modal__input" type="text">
                          </div>
                          
                          <div  class="Modal__inputtwo">
                      
                          <label >Sexo del trabajador </label>
                          <select  id="sexo_trabajador" class="Modal__select"  style='margin: 1em; width:100px' name="select">
                                    <option value="value1" selected disabled>Seleccionar</option>
                                    <option value="M">MASCULINO</option>
                                    <option value="F">FEMENINO</option>   
                           </select> 
                           <label >Cargo del trabajador </label>
                          <select  id="tipo_trabajador"  class=" Modal__select"  style='margin: 1em; width:100px' name="select">
                                    <option value="value1" selected disabled>Seleccionar</option>
                                    <option value="Empleado">EMPLEADO</option>
                                    <option value="Administrador">ADMINISTRADOR</option>   
                           </select> 

                          <input id="registrar_empleado" type="submit" class="Modal__registrar" value="Registrar">
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
      listarEmpleados();
   

    })

    function listarEmpleados(){
        $.ajax({
            method:"GET",
            url : 'http://localhost/projects/Mercatronics/Controller/listar_trabajadores.php',
            success:function(data){
                let datos = JSON.parse(data)
                console.log(datos)
                for (let item of datos) {
                add(item);
                }

            }            
        });
    }

    function add(item){
         $('#information_colum').append('<tr class="information_colum"><td >'+item.nombre_empleado+'</td><td  >'+item.direccion_empleado+'</td><td >'+item.tipo_emplado+'</td><td >'+item.dni_empleado+'</td><td>'+item.correo_empleado+'</td> <td>  <div class="Section_option"> <a id="'+item.idusuario+'" class="Button__modify">Modificar</a><a id="'+item.idusuario+'" class="Button__eliminar">Eliminar</a></div></td></tr>');
     }





    $('#add_venta').click(function(e){
      e.preventDefault()
      $('#Modal__container').show(200);
      $("#Modal__container").show();

    })

    $('#registrar_empleado').click(function(e){
      e.preventDefault()


      let nombre_tb = $('#nombre_trabajador').val()
      let dni_tb = $('#dni_trabajador').val()
      let correo_tb = $('#correo_trabajador').val()
      let direccion_tb = $('#direccion_trabajador').val()
      let sexo_tb =  $('#sexo_trabajador').val()
      let tipo_tb =  $('#tipo_trabajador').val()

      var json ={
        'nombre_trabajador_f' : nombre_tb,
        'dni_trabajador_f' : dni_tb,
        'correo_trabajador_f' : correo_tb,
        'direccion_trabajador_f' : direccion_tb,
        'sexo_trabajador_f' : sexo_tb,
        'tipo_trabajador_f' : tipo_tb,
        }
      console.log(json)

      $('#nombre_trabajador').val("")
      $('#dni_trabajador').val("")
      $('#correo_trabajador').val("")
      $('#direccion_trabajador').val("")
      $('#sexo_trabajador').val("")
      $('#tipo_trabajador').val("")

      $.ajax({
            method:"POST",
            data: json,
            url : 'http://localhost/projects/Mercatronics/Controller/agregar_trabajador.php',
            success:function(r){
              window.location.href='http://localhost/projects/Mercatronics/View/cuentas.php'    

          }
                
        });
    })




    $('#cerrar_modal').click(function(){
      $('#Modal__container').hide(200);
        $("#Modal__container").hide();
    })




</script>




</html>