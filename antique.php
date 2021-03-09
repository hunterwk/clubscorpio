<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';


if (array_key_exists('email', $_POST)) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'localhost';
    $mail->Port = 25;
    $mail->setFrom('avcdszxa@avcdoman.com', 'Admin');
    $mail->addAddress('admin@avcdoman.com');

    $mail->isHTML(false);
    $mail->Subject = 'New Tattoo Inquiry';
    $mail->Body = <<<EOT
Form details below.\n\n
Name:  {$_POST['Name']} \n
Email: {$_POST['Email']} \n
Instagram: {$_POST['Instagram']} \n
Message: {$_POST['Message']} \n
Availability: \n
EOT; 
    // $mail->addAttachment = $uploadFile;
    if (!$mail->send()) {
        echo 'Sorry, something went wrong. Please try again later.';
    } else {
        header("Location: https://avcdoman.com/thankyou.html");
    }
}

?>