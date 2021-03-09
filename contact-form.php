<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$msg = '';

if (isset($_POST['Email'])) {
    date_default_timezone_set('Etc/UTC');
    $mail = new PHPMailer();
    $mail->isHTML(true);
    $mail->addAddress("admin@avcdoman.com");
    $mail->addReplyTo($_POST['Email'], $_POST['Name']);
    $mail->Subject = "New tattoo inquiry";
    $mail->Body = <<<EOT
Form details below.\n\n
Name:  {$_POST['Name']} \n
Email: {$_POST['Email']} \n
Instagram: {$_POST['Instagram']} \n
Message: {$_POST['Message']} \n
EOT;
    $mail->send();
    if (!$mail->send()){
        $msg = 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        $msg = 'do work';
    }
}
print $msg;

?>