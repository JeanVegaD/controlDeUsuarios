<?php

include 'class_DAOUsuarios.php';
include 'class_ValidacionUsuarios.php';


//clase encargada de gestionar la comunicacion con los diferentes objetos de la aplicacion
class ControllerUsuarios{

    //variables para iniciarlizar la base de datos
    private  $servername = "localhost";
    private  $username = "php_adminsitrador";
    private  $password = "Cal2016";
    private  $bd = "electivaweb";
    private  $mysqli;


    //constructor encargado de gestionar e instanciar las demas clases
    function __construct() {
        //$this->conectarBaseDatos();
        
    }

    //Destructor encargado de cerrar la conexion con la base de datos 
    function __destruct(){
        mysqli_close($this->mysqli);
    }


    //crea el objeto conexion de la base de datos
    function conectarBaseDatos(){
        try{
            $this->mysqli = new mysqli($this->servername, $this->username,$this->password, $this->bd);
            $this->mysqli->set_charset("utf8");
            
            // Check connection
            if ($this->mysqli -> connect_errno) {
              //echo "Failed to connect to MySQL: " . $this->mysqli -> connect_error;
                return false;
            }
            else{
                //echo "<h1> Conexion Exitosa </h1>";
                return true;
            }
        }
        catch(mysqli_sql_exception $e){
            return false;
        }

    }

    //se conecta con el objeto DAOUsuarios para realizar una insercion de un nuevo usuario
    function insertarUsuario(){
        echo "<h2> inserto </h2>";
        $ObjUsuarios =  new DAOUsuarios($this->mysqli);
        //obtiene los datos mediante el metodo de post y los envia a la funcion de insertar
        $ObjUsuarios->agregarNuevoUsuario('Jean','Vega,', 'Díaz','jeanvegad','pass','jean0798@gmail.com','89526825','1998-5-07');
    }

    //se conecta con el objeto DAOUsuarios para realizar una obtener la informacion de un usario en particular
    function obtenerInformaciondeUsuario(){
         $ObjUsuarios =  new DAOUsuarios($this->mysqli);
         $ObjUsuarios->obtenerDatosUsuario('jeanvegad');
    }


    //se conecta con el objeto DAOUsuarios para validar la autenticacion de un usurio
    function autenticarUsuario(){
         $ObjUsuarios =  new DAOUsuarios($this->mysqli);
         $ObjUsuarios->verificarUsuario('jeanvegad','passasda');
    }

    //se conecta con el objeto DAOUsuarios para actualizar la contraseña del usuario
    function modificarConstraseña(){
        $ObjUsuarios =  new DAOUsuarios($this->mysqli);
        $ObjUsuarios->modificarContraseña('jeanvegadsa','newPass');
    }



    //controlarValidaciones al ingresar en el login
    function btn_ingresar_action($user,$pass){
        if($this->conectarBaseDatos()){
            $validar =  new ValidacionUsuarios();
            $resultado =  $validar->validarLogin($user,$pass,$this->mysqli);
            if($resultado=="exitoso"){
                return $resultado;
            }
            else{
                return $resultado;
            }
        }
        else{
            $mensajeError="Erro al conectar con la base de datos";
            $resultado= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $resultado;
        }       
    }


    //controla las validaciones al registrar un nuevo usuario
    function btn_registrar_action($nombre,$ape1,$ape2,$user,$correo,$pass,$telefono,$fechaNac){
        if($this->conectarBaseDatos()){
            $validar =  new ValidacionUsuarios();
            $resultado =  $validar->validarRegistro($nombre,$ape1,$ape2,$user,$correo,$pass,$telefono,$fechaNac,$this->mysqli);
            if($resultado=="exitoso"){
                return $resultado;
                
            }
            else{
                return $resultado;
            }
        }
        else{
            $mensajeError="Erro al conectar con la base de datos";
            $resultado= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $resultado;
        }     
    }


    //Controla las validaciones y se comunica a la opcion de enviar correo
    function btn_enviarCorreo_action($correo){
        if($this->conectarBaseDatos()){
            $validar =  new ValidacionUsuarios();
            $resultado=$validar->validarEnviodeCorreo($correo,$this->mysqli);
            if($resultado=="exitoso"){
                return $resultado;
            }
            else{
                return $resultado;
            }
        }
        else{
            $mensajeError="Erro al conectar con la base de datos";
            $resultado= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $resultado;
        }     
    }

    /*controla las validaciones para el cambio de contraseña e implementa un 
    metodo de usuarios para cambiar la contraseña si todo es correcto*/
    function btn_cambiarPassword($username,$passActual,$newPass,$newPass2){
        if($this->conectarBaseDatos()){
            $validar =  new ValidacionUsuarios();
            $resultado=$validar->validarCambioDeContraseña($username,$passActual,$newPass,$newPass2,$this->mysqli);
            if($resultado=="exitoso"){
                return $resultado;
            }
            else{
                return $resultado;
            }
        }
        else{
            $mensajeError="Erro al conectar con la base de datos";
            $resultado= '<div class="alert alert-danger">'.$mensajeError.'</div>';
            return $resultado;
        }   
    }


}





?>