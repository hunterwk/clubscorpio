<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';


if (isset($_POST['Email'])) {
    date_default_timezone_set('Etc/UTC');
    require '../vendor/autoload.php';
    $mail = new PHPMailer();
    $email_to = "admin@avcdoman.com";
    $email_subject = "New tattoo inquiry";
    $mail->isHTML(true);
    $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
    $mail->send();
}
header("Location: https://avcdoman.com/thankyou.html");
?>