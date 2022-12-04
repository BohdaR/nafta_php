<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';
class EmailSender {
    private object $mailer;
    public function __construct($mail_server, $mail_login, $mail_password){
        $this->mailer = new PHPMailer(true);
        $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mailer->isSMTP();                                            //Send using SMTP
        $this->mailer->Host       = $mail_server;                     //Set the SMTP server to send through
        $this->mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mailer->Username   = $mail_login;                     //SMTP username
        $this->mailer->Password   = $mail_password;                               //SMTP password
        $this->mailer->SMTPSecure = "ssl";
        $this->mailer->Port       = 465; 
    }
    public function send_mail($from, $to, $subject, $body): void
    {
        try {
            
            //Recipients
            $this->mailer->setFrom($from, '');
            $this->mailer->addAddress($to, '');     //Add a recipient
        
            //Content
            $this->mailer->isHTML(true);                                  //Set email format to HTML
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
        
            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}
