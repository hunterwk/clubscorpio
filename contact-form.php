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
    $email_to = "admin@avcdoman.com";
    $email_subject = "New tattoo inquiry";
    $mail->isHTML(true);
    $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
    if (!$mail->send()){
        $msg = 'no work';
    } else {
        $msg = 'do work';
    }
}
print $msg;
?>