<?php
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;
     use PHPMailer\PHPMailer\SMTP;
 
     require 'PHPMailer/src/Exception.php';
     require 'PHPMailer/src/PHPMailer.php';
     require 'PHPMailer/src/SMTP.php';


    $correo="jean0798@gmail.com";
    $username="Jean";
    $codigo="aca va el codigo";
 
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
        $mail->setFrom('sistemamatriculatec@gmail.com', 'Soporte CarryOn');
        $mail->addAddress($correo,$username );   

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Recuperar constraseña';
        $mail->Body    = '<p>Se ha solicitado un cambio de contrseña</p><p>El codigo para recuperar su contraseña es: </p> <b>'.$codigo.'</b>';
        $mail->send();
        //return true;
    } catch (Exception $e) {
        //return false;
    }


?>