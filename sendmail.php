<?php
$to_email = "mu311565@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: usmanmaliksahib2611@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
  echo "Email successfully sent to " . $to_email;
} else {
  echo "Email sending failed...";
}


// usman malik
