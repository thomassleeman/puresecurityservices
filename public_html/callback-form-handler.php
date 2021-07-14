<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $companyname = $_POST['company-name'];
    $tel = $_POST['tel'];
    date_default_timezone_set('Europe/London');
    
    $txt = "Callback details: \n\n Name: ".$name."\n\n Company: ".$companyname;

    header("Location: message-sent.html#thank-you-message");
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.hostinger.co.uk';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'callbacks@evocleaning.co.uk';                     //SMTP username
        $mail->Password   = 'TzDCc3a|';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        
        //Recipients
        $mail->setFrom('callbacks@evocleaning.co.uk', 'Callback Request');
        $mail->addAddress('info@evocleaning.co.uk', 'Evo Team');     //Add a recipient
        $mail->addReplyTo('callbacks@evocleaning.co.uk');
        
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "SECURITY: New callback request recieved at ". date("H:i"). " on ". date("l d/m/Y");
        $mail->Body    = '<b>Callback details:</b> <br><br> <b>Name:</b> '.$name.'<br><br> <b>Company:</b> '.$companyname. '<br><br> <b>Tel:</b> '.$tel. '<br><br><b>Form was submitted from the page:</b> ' .$_SERVER['HTTP_REFERER'];
        $mail->AltBody = 'Callback details: \n\n Name: '.$name.'\n\n Company: '.$companyname. '\n\n Tel: '.$tel. '\n\nForm was submitted from the page: ' .$_SERVER['HTTP_REFERER'];
        
        $mail->send();
        header("Location: message-sent.html#thank-you-message");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
}

?>