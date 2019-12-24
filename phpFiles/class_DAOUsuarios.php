<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;


    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';


class DAOUsuarios{
	private $conexionBD;
	//constructor 
    function __construct($conexion_recibida) {
       //inicializar variables
    	$this->conexionBD=$conexion_recibida;
        
    }

    function agregarNuevoUsuario($nombre,$apellido1,$apellido2,$username,$correo,$pass,$telefono,$fechaNac){
		$sql = "insert into Usuarios values('$nombre','$apellido1','$apellido2','$username','$pass','$correo','$telefono','$fechaNac')";
		if (mysqli_query($this->conexionBD, $sql)) {
			//Insercion realizada con exito
            return true;
		} else {
            //hubo un error en la insercion del usuario
            //Para ver el mensaje completo descomente la siguiente linea
			//echo "<h2>". "Error: " . $sql . "" . mysqli_error($this->conexionBD) . "</h2>";
            return false;
		}
    }


    //obtiene toda la informacion de un usuario
    function obtenerDatosUsuario($username){
        //se crea la consulta
        $consulta = "SELECT * FROM Usuarios WHERE username='$username'";
        // Ejecutar la consulta
        $resultado = $this->conexionBD->query($consulta);
        //se recorre la consulta
        if ($resultado->num_rows > 0) {
            //se retorna el arreglo
            //para obener un elemento se recorre con un while y $row["nombre"]
            $rows = $resultado->fetch_assoc();
            return $rows;
        } else {
            //se retorna un elemento vacio
            return null;
        }
    }


    //Autentica la combincacion del usuario y la contraseña
    function autenticarUsuario($username,$pass){
        //se crea la consulta
        $consulta = "SELECT * FROM Usuarios WHERE username='$username' and pass= '$pass'";
        // Ejecutar la consulta
        $resultado = $this->conexionBD->query($consulta);
        if ($resultado->num_rows > 0) {
            //Se autentico un usuario con esa combinacion
           return true;
        } else {
            //Usuario invalido 
            return false;
        }
    }


    //verificar que el usuario se encutra registrado en la base de datos
    function verificarUsarioRegistrado($username){
        //se crea la consulta
        $consulta = "SELECT * FROM Usuarios WHERE username='$username'";
        // Ejecutar la consulta
        $resultado = $this->conexionBD->query($consulta);
        if ($resultado->num_rows > 0) {
            //Se autentico un usuario con esa combinacion
           return true;
        } else {
            //Usuario invalido 
            return false;
        }
    }


    //modifica la contraseña de un usuario especifico
    function modificarContraseña($username,$newPass){
        //se crea la consulta
        $consulta = "update Usuarios set pass='$newPass' where username='$username'";
        // Ejecutar la consulta
        $resultado = $this->conexionBD->query($consulta);
        //se recorre la consulta
        if ($resultado) {
            //Se autentico un usuario con esa combinacion
            return true;
        } else {
            //Usuario invalido 
            return false;
        }
    }


    function existeCorreo($correo){
        //se crea la consulta
        $consulta = "SELECT * FROM Usuarios WHERE correo='$correo'";
        // Ejecutar la consulta
        $resultado = $this->conexionBD->query($consulta);
        if ($resultado->num_rows > 0) {
            //Se valido la exitencia del correo
            return true;
        } else {
            //Usuario invalido 
            return false;
        }
    }



    //obtiene el nombre de usuario segun el correo enviado
    function obtenerUserbyCorreo($correo){
        //se crea la consulta
        $consulta = "SELECT * FROM Usuarios WHERE correo='$correo'";
        // Ejecutar la consulta
        $resultado = $this->conexionBD->query($consulta);
        //se recorre la consulta
        $username="";
        while ($row = $resultado->fetch_assoc()) {
            $username=$row["username"];
        }
        return $username;
    }

    function generarContraseñaRandom() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length=10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }



    function cambairContraseñaByCorreo($username,$correo){
        $contraseñaNueva=$this->generarContraseñaRandom();
        $this->modificarContraseña($username,$contraseñaNueva);
        $this->enviarCorreo($contraseñaNueva,$correo,$username);
        return true; 

    }


    function enviarCorreo($newPass,$correo,$username){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'sistemamatriculatec@gmail.com';                     // SMTP username
            $mail->Password   = 'jeanvegadiaz';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('sistemamatriculatec@gmail.com', 'Control de usuarios');
            $mail->addAddress($correo,$username );   
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'New password';
            $mail->Body    = '<p>Se ha solicitado un cambio de contrseña</p><p>Su nueva contraseña es: </p> <b>'.$newPass.'</b>';
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
            }


}

?>