<!DOCTYPE html>
<?php include ('../phpFiles/class_ControllerUsuarios.php'); ?>
<html>
    <head>
        <title>Sign In</title>
        <meta charset="ISO-8859-1">
        
        <link rel="stylesheet" type="text/css" href="files/signin.css?v=<?php echo time(); ?>" media="all"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script type="text/javascript" src="files/signin.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </head>
    <?php

        //Almacena el mensaje para mostrar
        $mensajeSalidaRegistro="";
        $nombre;
        $apellido1;
        $apellido2;
        $username;
        $correo;
        $pass;
        $telefono;
        $fechaNac;
        if(isset($_POST['submit_registro'])){
            $controlador =  new ControllerUsuarios();
            $resultado=$controlador->btn_registrar_action(
            	$_POST['n_nombre'],
            	$_POST['n_ape1'],
            	$_POST['n_ape2'],
            	$_POST['n_username'],
            	$_POST['n_correo'],
            	$_POST['n_pass'],
            	$_POST['n_telefono'],
            	$_POST['n_FechaNac']);
            if($resultado=="exitoso"){
                $nombre="";
		        $apellido1="";
		        $apellido2="";
		        $username="";
		        $correo="";
		        $pass="";
		        $telefono="";
		        $fechaNac="";
		        $mensajeError="Usuario registrado exitosamente";
            	$mensajeSalidaRegistro= '<div class="alert alert-success">'.$mensajeError.'</div>';
                
            }
            else{
               	$nombre=$_POST['n_nombre'];
		        $apellido1=$_POST['n_ape1'];
		        $apellido2=$_POST['n_ape2'];
		        $username=$_POST['n_username'];
		        $correo=$_POST['n_correo'];
		        $pass=$_POST['n_pass'];
		        $telefono=$_POST['n_telefono'];
		        $fechaNac=$_POST['n_FechaNac'];
                $mensajeSalidaRegistro=$resultado;
            }
        } 
    ?>

    <body>
        <div class="container-fluid">
            <div class="row">
                <form class="form_style" method="post">
                    <h1 class="titulo">Crea tu cuenta en minutos...</h1>
                      <label for="imputNombre" class="subtitulo">Nombre</label>
                      <input type="text" class="form-control" id="id_nombre" name="n_nombre" value="<?php echo (isset($nombre))?$nombre:'';?>" >
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="inputApellido1" class="subtitulo">Apellido 1</label>
                            <input type="text" class="form-control" id="id_apellido1" name="n_ape1"  value="<?php echo (isset($apellido1))?$apellido1:'';?>">  
                        </div>
                        <div class="col-lg-6 ">
                            <label for="inputApellido2" class="subtitulo">Apellido 2</label>
                            <input type="text" class="form-control" id="id_apellido2" name="n_ape2" value="<?php echo (isset($apellido2))?$apellido2:'';?>">
                        </div>
                    </div>
                    <label for="inputUsuario" class="subtitulo">Nombre de usuario</label>
                    <input type="text" class="form-control" id="id_usuario"  name="n_username" value="<?php echo (isset($username))?$username:'';?>">

                    <label for="inputPass" class="subtitulo" >Correo</label>
                    <input type="text" class="form-control" id="id_correo" name="n_correo" value="<?php echo (isset($correo))?$correo:'';?>"> 

                    <label for="inputCorreo" class="subtitulo">Contraseña</label>
                    <input type="password" class="form-control" id="id_password" name="n_pass" value="<?php echo (isset($pass))?$pass:'';?>">

                    <label for="inputTelefono" class="subtitulo">Teléfono</label>
                    <input type="number" class="form-control" id="id_telefono" name="n_telefono" value="<?php echo (isset($telefono))?$telefono:'';?>">

                    <label for="inputFechaNac" class="subtitulo">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="id_nacimiento" name="n_FechaNac" value="<?php echo (isset($fechaNac))?$fechaNac:'';?>">
                    <br>
                  	<?php
                  		echo $mensajeSalidaRegistro;
                    ?> 
                    <button type="submit" class="buttton_login" name="submit_registro">Registrarse</button>
                     <a href="../index.php">
                                <button type="button" class="button_text" >Iniciar Sesion</button>
                            </a>
                </form>
            </div>
        </div>
    </body>
</html>