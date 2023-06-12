<?php

$user_message = $_POST['message'];

global $wpdb;
require_once ABSPATH . "wp-includes/pluggable.php";
$to = 'jhabdulrahmantest@gmail.com';
$subject = "Learner sent a quries about course";
$headers = "From: " . "jhabdulrahmantest@gmail.com" . "\r\n" .
    'Reply-To: ' . $to . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$message = "<!DOCTYPE html>
			<html>
			<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			</head>
			<body>
				<p>Hello Kim," . "<br><br>" . $user_message."</p> \r\n
                <p> Regards, <br> Abdul.
			</body>
			</html>";

if (isset($user_message) && $user_message != '') {

    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent == true) {
        echo "Success";
    }
    else{
        echo "Failed";
    }
}

