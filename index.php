<!DOCTYPE html>
<?php include ('phpFiles/class_ControllerUsuarios.php'); ?>
<html>
    <head>
        <title>Log In</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="ISO-8859-1">
        
        <link rel="stylesheet" type="text/css" href="indexFiles/login.css" media="all"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
        

        <script type="text/javascript" src="indexFiles/login.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    </head>
     <?php

        //Almacena el mensaje para mostrar
        $mensajeSalida="";
        $username;
        $pass;
        if(isset($_POST['submit_login']))
            {
                
                $controlador =  new ControllerUsuarios();
                $resultado=$controlador->btn_ingresar_action($_POST['user_input'],$_POST['pass_input']);
                if($resultado=="exitoso"){
                     $username="";
                     $password="";
                    
                }
                else{
                    $username=$_POST['user_input'];
                    $mensajeSalida=$resultado;
                }
            } 
    ?>
    <body>
        <div class="container-fluid">
            <div class="row">
                <form class="form_style" id="id_form_login" method="post">
                    <h1 class="titulo">Inicia sesión en tu cuenta</h1>
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="subtitulo">Usuario</label>
                        <input type="text" class="form-control" name="user_input" value="<?php echo (isset($username))?$username:'';?>">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="subtitulo">Contraseña</label>
                        <input type="password" class="form-control" name="pass_input" value="<?php echo (isset($password))?$password:'';?>">
                    </div>
                    <?php
                        echo $mensajeSalida;
                    ?> 
                    <button type="submit" value="click" name="submit_login" class="buttton_login">Ingresar</button>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="../signin/signin.php" target="_blank">
                                <button type="button" class="button_text" >crear una cuenta</button>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <a href="../administrar_contraseñas/pass.php" target="_blank">
                                <button type="button" class="button_text">¿Olvidó su contraseña?</button>
                            </a> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>