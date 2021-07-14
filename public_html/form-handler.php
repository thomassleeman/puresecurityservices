<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $email_subject = "New booking for ".$date;
    $email_from = "welcome@thelamplighters.co.uk";
    $mailTo = "welcome@thelamplighters.co.uk, tom_s363@hotmail.com";
    $headers = "Reply-To: welcome@thelamplighters.co.uk" . "\r\n" . 
    "Return-Path: welcome@thelamplighters.co.uk" . "\r\n" . 
    "From: welcome@thelamplighters.co.uk" . "\r\n" .
    "Content-Type: text/plain";
    
    $txt = "***NEW BOOKING*** \n\n NAME: ".$name."\n\n DATE OF BOOKING: ".$date."\n\n TEL: ".$tel."\n\n EMAIL: ".$email."\n\n MESSAGE: ".$message;

    mail($mailTo, $email_subject, $txt, $headers);
    header("Location: message-sent.html#book-table");
}
?>