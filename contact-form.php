<?php
include_once('Mail.php');
include_once('Mail_Mime/mime.php');
if (isset($_POST['Email'])) {
    $email_to = "admin@avcdoman.com";
    $email_subject = "New tattoo inquiry";

    function problem($error) {
        echo "Please fully finish the contact form. ";
        die();
    }
    if(
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Please fill out the required parts of the contact form');
    }
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $instagram = $_POST['Instagram'];
    $message = $_POST['Message'];
    $monday1 = $_POST['monday1'];
    $monday2 = $_POST['monday2'];
    $tuesday1 = $_POST['tuesday1'];
    $tuesday2 = $_POST['tuesday2'];
    $wednesday1 = $_POST['wednesday1'];
    $wednesday2 = $_POST['wednesday2'];
    $friday1 = $_POST['friday1'];
    $friday2 = $_POST['friday2'];
    $saturday1 = $_POST['saturday1'];
    $saturday2 = $_POST['saturday2'];
    

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    $name_of_uploaded_file = basename($_FILES['referenceFile']['name']);
    $type_of_uploaded_file = substr($name_of_uploaded_file, strrpos($name_of_uploaded_file, '.')+1);
    $size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
    $path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
    $tmp_path = $_FILES["uploaded_file"]["tmp_name"];

    if(is_uploaded_file($tmp_path))
    {
         if(!copy($tmp_path,$path_of_uploaded_file))
        {
        $errors .= '\n error while copying the uploaded file';
        }
    }     


    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The Email address you entered does not appear to be valid.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Instagram: " . clean_string($instagram) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";
    $email_message .= "Availability: " . $monday2 . $tuesday1 . $tuesday2 . $wednesday1 . $wednesday2 . $friday1 . $friday2 . $saturday1 . $saturday2 . "\n";
    $email_message .= "Will this be working? \n";
    $email_message .= "hellllooooooooo \n";


    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if(!empty($reference) && file_exists($reference)){
            
            // Boundary 
            $semi_rand = md5(time()); 
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
            
            // Headers for attachment 
            $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
            
            // Multipart boundary 
            $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
            "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
            
            // Preparing attachment
            if(is_file($reference)){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($reference,"rb");
                $data =  @fread($fp,filesize($reference));
                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($reference)."\"\n" . 
                "Content-Description: ".basename($reference)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($reference)."\"; size=".filesize($reference).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
            
            $message .= "--{$mime_boundary}--";
            $returnpath = "-f" . $email;
        }


    mail($email_to, $email_subject, $email_message, $headers, $returnpath);
?>
    
<?php
 header("Refresh:0; url=thankyou.html");
}
?>