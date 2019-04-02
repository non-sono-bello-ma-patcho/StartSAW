
<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/src/Exception.php';
require '../mailer/src/PHPMailer.php';
require '../mailer/src/SMTP.php';




function send_mail($macro_message_number,$receiver){
    $infoMail = include('mailconfig.php');
    $mail = new PHPMailer(true);

    switch($macro_message_number){
        case 1:
            $message = "Welcome! May the Braveness guide thee!";
            $subject = "Welcome to Herschel";
            break;
            /* to be done */
    }
    //Send mail using gmail
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
    $mail->Host = $infoMail['host']; // sets GMAIL as the SMTP server
    $mail->Port = $infoMail['port']; // set the SMTP port for the GMAIL server 465
    $mail->Username = $infoMail['username']; // GMAIL username
    $mail->Password = $infoMail['password']; // GMAIL password

    //Typical mail data
    $mail->SetFrom($mail->Username);
    $mail->addAddress($receiver);
    $mail->Subject = $subject;
    $mail->Body = $message;

    try{
        $mail->Send();
    } catch(Exception $e){
        //Something went bad
        /* debug zone */
        $_SESSION['last_error'] = 'fail '.$mail->ErrorInfo;;
        header("Location: error.php");
        exit;
    }
}
