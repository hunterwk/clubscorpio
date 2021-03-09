<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$msg='';

if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');
    require '../vendor/autoload.php';
    $mail = new PHPMailer();
    $mail->setFrom('avcdszxa@avcdoman.com', 'Admin');
    $mail->addAddress('admin@avcdoman.com');

    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'New tattoo inquiry';
        $mail->isHTML(false);
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
        
        if (!$mail->send()) {
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
print "<h2>$msg</h2>";
?>