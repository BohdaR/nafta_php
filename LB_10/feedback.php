<?php
declare(strict_types=1);
require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
session_start();
if(isset($_SESSION['user'])){
    echo "logged in as ". $_SESSION['user']['login'];
} else{
    header("Location: ../LB_9/login.php");
}
if(isset($_POST['email'])){
    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = "smtp.gmail.com";                    //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = "nofication1171@gmail.com";                //SMTP username
        $mail->Password   = "nxtnrecryfwxjiyv";                //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('testmailerlab@ukr.net', 'Test Mailer');
        $mail->addAddress('bohdanshushval@gmail.com', 'Bohdan Shushval');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Feedback from website: '.$_POST['subject'];
        $mail->Body    = 'From: '.$_POST['email'].'</br> '.$_POST['message'];

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<html lang="en">
<head>
    <title>Mailing test</title>
</head>
<body>
<form method="POST">
    <input type="email" placeholder="email" name="email" required/></br>
    <input type="text" placeholder="subject" name="subject" required/></br>
    <textarea placeholder="message" name="message"></textarea></br>
    <input type="submit" value="Send"/>
</form>
</body>
</html>
