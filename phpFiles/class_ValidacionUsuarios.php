<?php


class ValidacionUsuarios{
	//constructor 
    function __construct() {
    }


    //Se valida lo necesario para el login
    function validarLogin($username,$pass,$conexionBD){
        //crea objeto espcializado en el manejo de usuarios
        $ObjUsuarios =  new DAOUsuarios($conexionBD);
        //verifica que las variable no son nulas
        if(!empty($username) && !empty($pass)){
            //verifica que el usuario se encutra registrado
            if($ObjUsuarios->verificarUsarioRegistrado($username)){
                //verifica la autenticacion del usuario
                if($ObjUsuarios->autenticarUsuario($username,$pass)){
                    $retornar= 'exitoso';
                    return $retornar;
                }
                else{
                    $mensajeError="Nombre de usuario o contraseña incorrectos";
                    $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                    return $retornar;
                }

            }
            else{
                $mensajeError="El usuario no se encuntra registrado";
                $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                return $retornar;
            }
        }
        else{   
            $mensajeError="Complete todos los datos";
            $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $retornar;
        }
        
    }


    //Funcion especifica para la validacion de la contraseña
    function validarContraseña($pass){
        //largo de la contraseña
        if(strlen($pass) > 7){
            //debe tener una letra minuscula
            if (preg_match('`[a-z]`',$pass)){
                //debe tener una masyuscula
                if (preg_match('`[A-Z]`',$pass)){
                    //debe tener un numero
                    if (preg_match('`[0-9]`',$pass)){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }else{
                return false;
            }
        }
        else{
            return false;
        }
    }


    function validarRegistro($nombre,$ape1,$ape2,$user,$correo,$pass,$telefono,$fechaNac,$conexionBD){
        //crea objeto espcializado en el manejo de usuarios
        $ObjUsuarios =  new DAOUsuarios($conexionBD);
        //verifica que las variable no son nulas
        if(!empty($nombre) && !empty($ape1) && !empty($ape2) && !empty($user) && !empty($pass) && !empty($correo) && !empty($telefono) && !empty($fechaNac)){
            //verifica que el usuario se encutra registrado
            if(!$ObjUsuarios->verificarUsarioRegistrado($user)){
                if($this->validarContraseña($pass)){
                    if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                        $ObjUsuarios->agregarNuevoUsuario($nombre,$ape1,$ape2,$user,$correo,$pass,$telefono,$fechaNac);
                        $retornar= 'exitoso';
                        return $retornar;

                    }else{
                        $mensajeError="Correo electronico invalido";
                        $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                        return $retornar;
                    }

                }else{
                    $mensajeError="La contraseña debe contener mínimo 8 de longitud y una combinación de
                    letras mayúsculas, minúsculas y números";
                    $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                    return $retornar;
                }
            }
            else{
                $mensajeError="El nombre de usuario ya se encuentra en uso";
                $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                return $retornar;
            }
        }else{
            $mensajeError="Complete todos los datos";
            $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $retornar;
        }


    }



    function validarEnviodeCorreo($correo,$conexionBD){
        //valida que no este vacio
        if(!empty($correo)){
            //valida el formato del correo
            if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
                //se conecta al objeto de ususrios y verifica su exitencia 
                $ObjUsuarios =  new DAOUsuarios($conexionBD);
                if($ObjUsuarios->existeCorreo($correo)){
                    //cambia la contraseña y la envia por correo
                    $username=$ObjUsuarios->obtenerUserbyCorreo($correo);
                    if($ObjUsuarios->cambairContraseñaByCorreo($username,$correo)){
                        $retornar= 'exitoso';
                        return $retornar;
                    }
                    else{
                        $mensajeError="Error al generar una contraseña";
                        $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                        return $retornar;
                    }
                    
                }
                else{
                    $mensajeError="El correo electronico no corresponde a nigun usuario";
                    $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                    return $retornar;
                }
            }else{
                $mensajeError="Correo electronico invalido";
                $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                return $retornar;
            }
        }
        else{
            $mensajeError="Complete todos los datos";
            $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $retornar;
        }
        
    }


    function validarCambioDeContraseña($username,$passActual,$newPass,$newPass2,$conexionBD){
        if(!empty($username) && !empty($passActual) && !empty($newPass) && !empty($newPass2)){
            //valida la existencia del usuario
            $ObjUsuarios =  new DAOUsuarios($conexionBD);
            if($ObjUsuarios->autenticarUsuario($username,$passActual)){
                //valida que la estructuras de las contraseñas
                if($this->validarContraseña($newPass) && $this->validarContraseña($newPass2)){
                    if($newPass == $newPass2 ){
                        if($ObjUsuarios->modificarContraseña($username,$newPass)){
                            $retornar= 'exitoso';
                            return $retornar;
                        }
                        else{
                            $mensajeError="Error al cambiar la contraseña";
                            $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                            return $retornar;
                        }
                    }else{
                        $mensajeError="Las contraseñas no coinciden";
                        $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                        return $retornar;
                    }
                }
                else{
                    $mensajeError="La contraseña debe contener mínimo 8 de longitud y una combinación de
                    letras mayúsculas, minúsculas y números";
                    $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                    return $retornar;
                }
            }
            else{
                $mensajeError="Nombre de usuario o contraseña incorrectos";
                $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
                return $retornar;
            }
        }
        else{
            $mensajeError="Complete todos los datos";
            $retornar= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $retornar;
        }
    }

}



?>