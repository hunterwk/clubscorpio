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
//    if(array_key_exists('referenceFile', $_FILES)) {
//     $ext = PHPMailer::mb_pathinfo($_FILES['referenceFile']['name'], PATHINFO_EXTENSION);
//     $uploadFile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['referenceFile']['name'])) . '.' . $ext;
//    }

    // $name = $_POST['Name'];
    // $email = $_POST['Email'];
    // $instagram = $_POST['Instagram'];
    // $message = $_POST['Message'];

    $mail->isHTML(true);
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
        //The reason for failing to send will be in $mail->ErrorInfo
        //but it's unsafe to display errors directly to users - process the error, log it on your server.
        $msg = 'Sorry, something went wrong. Please try again later.';
    } else {
        $msg = 'Message sent! Thanks for contacting us.';
    }
    
}
header("Location: https://avcdoman.com/thankyou.html");
exit();

?>