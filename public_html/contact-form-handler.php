
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {

  $url = "https://www.google.com/recaptcha/api/siteverify";
  $data = [
    'secret' => "6LfLFdMaAAAAAAOISh8lVYVV94qLg_WplJqIJW7j",
    'response' => $_POST['recaptcha_response'],
    'remoteip' => $_SERVER['REMOTE_ADDR']
  ];

  $options = ARRAY(
    'http' => array(
      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
      'method' => 'POST',
      'content' => http_build_query($data)
    )
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);

    $res = json_decode($response, true);
    // if($res['success'] == true) {
      if($res['score'] > 0.3) {

      $name = $_POST['name'];
      $companyname = $_POST['company-name'];
      $email = $_POST['email'];
      $tel = $_POST['tel'];
      $postcode = $_POST['postcode'];
      // $hours = $_POST['hours'];
      $message = $_POST['message'];
  
  header("Location: message-sent.html#thank-you-message");
   
    try {
          //Server settings
          $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
          $mail->isSMTP();                                            
          $mail->Host       = 'smtp.hostinger.co.uk';                    
          $mail->SMTPAuth   = true;                                   
          $mail->Username   = 'quoterequests@evocleaning.co.uk';                     
          $mail->Password   = 'c2T@BW!su';                               
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
          $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
          
          //Recipients
          $mail->setFrom('quoterequests@evocleaning.co.uk', 'Quotation Request');
          $mail->addAddress('info@evocleaning.co.uk', 'Evo Team');     //Add a recipient
          $mail->addReplyTo('quoterequests@evocleaning.co.uk');
          
          //Content
          $mail->isHTML(true);                                 
          $mail->Subject = "SECURITY: New quotation request recieved at ". date("H:i"). " on ". date("l d/m/Y");
          $mail->Body    = '<b>Security quotation Request Details:</b> <br><br> <b>Name:</b> '.$name.'<br><br> <b>Company:</b> '.$companyname.'<br><br> <b>Tel:</b> '.$tel. '<br><br> <b>Email:</b> '.$email. '<br><br> <b>Postcode:</b> '.$postcode. '<br><br> <b>Message:</b> '.$message. '<br><br> <b>Recaptcha Score (0-1): </b>'.$res['score'];
          $mail->AltBody = 'Quotation Request Details: \n\nName: '.$name.'\n\n Company: '.$companyname.'\n\n Tel: '.$tel. '\n\n Email: '.$email. '\n\n Postcode: '.$postcode. '\n\n Message: '.$message;
          
          $mail->send();
        } catch (Exception $e) {
          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
      header("Location: message-not-sent.html#thank-you-message");
      }
      
  } 
  
  

    
  

?>