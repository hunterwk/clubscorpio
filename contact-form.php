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
    $mail->setFrom('avcdszxa@avcdoman.com', 'Admin');
    $mail->addAddress("admin@avcdoman.com");
    $mail->addReplyTo($_POST['Email'], $_POST['Name']);
    $mail->Subject = "New tattoo inquiry";
    $mail->Body = <<<EOT
Form details below: <br><br>
Name:  {$_POST['Name']} <br>
Email: {$_POST['Email']} <br>
Instagram: {$_POST['Instagram']} <br>
Message: {$_POST['Message']} <br>
EOT;
    $mail->send();
    if (!$mail->send()){
        $msg = 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        header("Location: https://avcdoman.com/thankyou.html");
    }
}
print $msg;

?>