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
    $availability = array();
    if(
        isset($_POST['monday1'])
    ) {
        array_push($availability, "monday 12-4");
    }
    if(
        isset($_POST['monday2'])
    ) {
        array_push($availability, "monday 4-8");
    }
    if(
        isset($_POST['tuesday1'])
    ) {
        array_push($availability, "tuesday 12-4");
    }
    if(
        isset($_POST['tuesday2'])
    ) {
        array_push($availability, "tuesday 4-8");
    }
    if(
        isset($_POST['wednesday1'])
    ) {
        array_push($availability, "wednesday 12-4");
    }
    if(
        isset($_POST['wednesday2'])
    ) {
        array_push($availability, "wednesday 4-8");
    }
    if(
        isset($_POST['friday1'])
    ) {
        array_push($availability, "friday 12-4");
    }
    if(
        isset($_POST['friday2'])
    ) {
        array_push($availability, "friday 4-8");
    }
    if(
        isset($_POST['saturday1'])
    ) {
        array_push($availability, "saturday 12-4");
    }
    if(
        isset($_POST['saturday2'])
    ) {
        array_push($availability, "saturday 4-8");
    }
    $avail = implode("<br>", $availability);
    $mail->Body = <<<EOT
Form details below: <br><br>
Name:  {$_POST['Name']} <br>
Email: {$_POST['Email']} <br>
Instagram: {$_POST['Instagram']} <br>
Message: {$_POST['Message']} <br>
Availability: $avail
EOT;
    if (!$mail->send()){
        $msg = 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        header("Location: https://avcdoman.com/thankyou.html");
    }
}
print $msg;

?>