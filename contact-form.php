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


    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    


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
    $email_message .= "Availability: ". $availability . "\n";
    foreach($availability as $b) { 
        print $b . "\n";
    }
    
    $headers = 'From: ' . $email . "\r\n" .
-        'Reply-To: ' . $email . "\r\n" .
-        'X-Mailer: PHP/' . phpversion();
-

    mail($email_to, $email_subject, $email_message, $headers);
?>
    
<?php
 header("Refresh:0; url=thankyou.html");
}
?>