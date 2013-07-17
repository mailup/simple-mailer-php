<?php
include_once ('simple_functions.php');
 
 $to =""; // to address 
 $from= ""; // from address
 $from_name= "First Name"; // name of the sender
 $subject= "PLAIN TEST"; // Subject
 $body= "Hello world"; // the message
 
 
 if (smtpmailer($to, $from, $from_name, $subject, $body)) {
               echo "Email sent.....<br/>";
 }



?>