
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';



function core_message($macro_message){
    $message = "<html style=\"font-family:'Raleway',sans-serif;\">";
    $message .= "<head><link href=\"https://fonts.googleapis.com/css?family=Raleway\" rel=\"stylesheet\">";
    $message .= "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"></head>";
    $message .= "<body style = 'font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;text-align: left; letter-spacing: 0.0625em'>";
    $message .= "<div style='position: relative;width: 100%;'><img style='width: 100%; height: auto;' src='cid:img'/></div>";
    $message .= "<div style='box-sizing: border-box;display: flex !important; text-align: center !important;'>";
    $message .= "<div style='padding: 3rem;font-size: 90%;text-align: center !important; width: 100% !important;box-sizing: border-box;background-color: #161616 !important;'>";
    $message .= $macro_message;
    $message .= "</div></div></body></html>";

    return $message;
}

function welcome_message(){
    $message = "<h1 style='color: #fff !important;'>Welcome to Herschel</h1>";
    $message .= "<div style='color: #fff !important;margin-top: 0;margin-bottom: 0 !important;'>
        Vivi una esperienza magnifica con i nostri pacchetti safari!!!</div></div></div>";
    return core_message($message);
}

function reset_password_message(){
    $message = "<h1 style='color: #fff !important;'>Change your Password by clicking the button below</h1>";
    $message .= "<h2><a style='background-color: #3d348b;box-shadow: 0 0.1875rem 0.1875rem 0 rgba(0, 0, 0, 0.1);padding: 1.25rem 2rem;
font-size: 80%;text-transform: uppercase;letter-spacing: .15rem;border: 0;color: #fff;display: inline-block;border-radius: .25rem;
transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;outline: 0;
text-decoration: none;' href='localhost/startsaw-herschel/php/changePasswordTest.php'>Change Password</a></h2>"; //TODO set the correct change password URL
    return core_message($message);
}
//https://github.com/non-sono-bello-ma-patcho/

function send_mail($macro_message_number,$receiver){
    $infoMail = include('mailconfig.php');
    $mail = new PHPMailer(true);


    //Send mail using gmail
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
    $mail->Host = $infoMail['host']; // sets GMAIL as the SMTP server
    $mail->Port = $infoMail['port']; // set the SMTP port for the GMAIL server 465
    $mail->Username = $infoMail['username']; // GMAIL username
    $mail->Password = $infoMail['password']; // GMAIL password
    $mail->AddEmbeddedImage('../img/demo2.jpg', 'img');
    $mail->isHTML(true); // Set email format to HTML

    switch($macro_message_number){
        case 1:
            //$message = "Welcome! May the Braveness guide thee!";
            $mail->Subject = "Welcome to Herschel";
            $mail->Body  = welcome_message();
            break;
        case 2:
            $mail->Subject = "Reset your password";
            $mail->Body = reset_password_message();
            break;
    }
    //Typical mail data
    $mail->SetFrom($mail->Username);
    $mail->addAddress($receiver);

    try{
        $mail->Send();
    } catch(Exception $e){
        //Something went bad
        /* debug zone */
        http_response_code(503);
        $_SESSION['last_error'] = 'fail sending email: '.$mail->ErrorInfo; //TODO cancellare sta parte dopo il debug
        header("Location: error.php?code=".http_response_code());
        exit;
    }
}
