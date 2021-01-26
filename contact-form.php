<?php
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
    $reference = $_POST['referenceFile'];
    $monday1 = $_POST['monday1'];

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    $uploadStatus = 1;
            // Upload attachment file
            if(!empty($_FILES["reference"]["name"])){
                
                // File path config
                $targetDir = "uploads/";
                $fileName = basename($_FILES["reference"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                
                // Allow certain file formats
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to the server
                    if(move_uploaded_file($_FILES["reference"]["tmp_name"], $targetFilePath)){
                        $uploadedFile = $targetFilePath;
                    }else{
                        $uploadStatus = 0;
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $uploadStatus = 0;
                    $statusMsg = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.';
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
    $email_message .= "Availability: " . $monday1 . "\n";

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