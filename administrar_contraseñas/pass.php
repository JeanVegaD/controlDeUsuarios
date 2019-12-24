<!DOCTYPE html>
<?php include ('../phpFiles/class_ControllerUsuarios.php'); ?>
<html>
    <head>
        <title>Adminsitrar Contraseñas</title>
        <meta charset="ISO-8859-1">
        <script src="https://smtpjs.com/v3/smtp.js"></script>
        <link rel="stylesheet" type="text/css" href="files/pass.css?v=<?php echo time(); ?>" media="all"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
        <script type="text/javascript" src="files/pass.js?v=<?php echo time(); ?>"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    </head>
     <?php

        //Almacena el mensaje para mostrar
        $mensajeSalidaCorreo="";
        $CorreoEnviar;
        if(isset($_POST['submit_correo'])){
            $controlador =  new ControllerUsuarios();
            $resultado=$controlador->btn_enviarCorreo_action($_POST['n_correo']);
            if($resultado=="exitoso"){
              $CorreoEnviar="";
              $mensajeError="Se ha enviado un correo con su nueva contraseña";
              $mensajeSalidaCorreo= '<div class="alert alert-success">'.$mensajeError.'</div>';
                
            }
            else{
              $CorreoEnviar=$_POST['n_correo'];
              $mensajeSalidaCorreo=$resultado;
            }
        } 
    ?>

    <body>
        <div class="container-fluid">
            <h1 class="header">Administrar credenciales</h1>
            <div class="row">
                <div class="col-lg-6 columna" >
                    <h2 class="titulo">¿Olvidó su contraseña?</h2>
                    <form class="form_style" method="post">
                        <h1 class="subtitulo">Ingrese su correo electornico asosciado a su cuenta para enviarle una contrasñea temporal</h1>
                        <div class="form-group">
                          <label for="exampleInputEmail1" class="subtitulo">Correo</label>
                          <input type="text" class="form-control" id="id_email" name="n_correo" value="<?php echo (isset($CorreoEnviar))?$CorreoEnviar:'';?>">
                        </div>
                        <?php
                          echo $mensajeSalidaCorreo;
                        ?>      
                        <button type="submit" class="buttton_login" name="submit_correo">Enviar correo</button>
                        </div>
                    </form>
                <div class="col-lg-6 columna">
                    <h1 class="titulo">Cambiar contraseña</h1>
                    <form class="form_style">
                        <h1 class="subtitulo">Cambia la contraseña de tu cunta, escribe tu nombre de usuario y tu contraseña actual</h1>
                        <div class="form-group">
                        <label for="lbl_email" class="subtitulo">Usuario</label>
                          <input type="text" class="form-control" id="id_usuario" aria-describedby="emailHelp" required> 

                          <label for="lbl_contraseñaActual" class="subtitulo">Constraseña actual</label>
                          <input type="password" class="form-control" id="id_contraActual" required> 

                          <label for="lbl_contraseñaNueva" class="subtitulo">Constraseña nueva</label>
                          <input type="password" class="form-control" id="id_contraNueva"  required> 

                          <label for="lbl_contraseñaNueva2" class="subtitulo">Repita su constraseña nueva</label>
                          <input type="password" class="form-control" id="id_contraNueva2"  required> 
                        </div>  
                        <button type="submit" class="buttton_login">Ingresar</button>
                        </div>
                    </form>
                </div>
              </div>
        </div>
    </body>
</html>