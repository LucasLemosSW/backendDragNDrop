<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function enviaEmail($emailDestinatario){

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // $hash=$emailDestinatario;
    $link="<a href='localhost/backend_drag_n_drop/api/users/validaEmail/".$emailDestinatario."'> Clique aqui para confirmar seu cadastro </a>";
    $mensagem="Email de Confirmação".$link;

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'appsdevelopersa@gmail.com';                     //SMTP username
        $mail->Password   = 'uuljaxwhpbhrascq';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('appsdevelopersa@gmail.com', 'Confirmacao Email');
        $mail->addAddress('appsdevelopersa@gmail.com', 'Lucas Lemos');     //Add a recipient
        $mail->addAddress($emailDestinatario);               //Name is optional
        $mail->addReplyTo('appsdevelopersa@gmail.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Confirmacao de email';
        $mail->Body    = $mensagem;
        $mail->AltBody = 'Drag n drop: Confirmacao de Cadastro! ';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}

?>