<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

$msg = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6LdbSH0aAAAAAD8ceEWlQiF39rEPAsUSbwyjhttA',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
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
        
            if(isset($_FILES['referenceFile'])){
                $ext = PHPMailer::mb_pathinfo($_FILES['referenceFile']['name'], PATHINFO_EXTENSION);
                $uploadFile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['referenceFile']['name'])) . '.' . $ext;
                if (move_uploaded_file($_FILES['referenceFile']['tmp_name'], $uploadFile)) {
                    if (!$mail->addAttachment($uploadFile, 'Reference file')) {
                        $msg = 'Failed to attach file ' . $_FILES['referenceFile']['name'];
                    } else {
                        $msg = 'Attached Successfully';
                    }
                } else {
                    $msg = 'Failed to move file to ' . $uploadFile;
                }     
            }
        
            $avail = implode("<br>", $availability);
            $mail->Body = <<<EOT
Form details below: <br><br>
Name:  {$_POST['Name']} <br>
Email: {$_POST['Email']} <br>
Instagram: {$_POST['Instagram']} <br>
Message: {$_POST['Message']} <br>
Availability: <br> 
$avail <br>
Attachment status: $msg <BR>
        
EOT;
        
        
            if (!$mail->send()){
                $msg = 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                header("Location: https://avcdoman.com/thankyou.html");
            }
        }
    }
} else {
    header("Location: https://avcdoman.com/error.html");
}



?>