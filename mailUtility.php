
<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mailer/src/Exception.php';
require '../mailer/src/PHPMailer.php';
require '../mailer/src/SMTP.php';


function welcome_message(){
    $message = "<html style=\"font-family:'Raleway',sans-serif;\">";
    $message .= "<head><link href=\"https://fonts.googleapis.com/css?family=Raleway\" rel=\"stylesheet\">
 <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\"></head>";
    $message .= "<body style = 'font-size: 1rem;font-weight: 400;line-height: 1.5;color: #212529;text-align: left; letter-spacing: 0.0625em'>";
    $message .= "<div style='position: relative;width: 100%;'><img style='width: 100%; height: auto;' src='cid:img'/></div>";
    $message .= "<div style='box-sizing: border-box;display: flex !important; text-align: center !important;'>";
    $message .= "<div style='padding: 3rem;font-size: 90%;text-align: center !important; width: 100% !important;box-sizing: border-box;background-color: #161616 !important;'>";
    $message .= "<h1 style='color: #fff !important;'>Welcome to Herschel</h1>";
    $message .= "<div style='color: #fff !important;margin-top: 0;margin-bottom: 0 !important;'>
        Vivi una esperienza magnifica con i nostri pacchetti safari!!!</div></div></div>";
    $message .="</body>";
    $message .="</html>";
    return $message;
}




function reset_password_message(){

}


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
            $mail->body = reset_password_message();
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
        $_SESSION['last_error'] = 'fail '.$mail->ErrorInfo; //TODO cancellare sta parte dopo il debug
        header("Location: error.php");
        exit;
    }
}
