<?php
include_once ('simple_functions.php');
 
 $to ="sijanzafeer@gmail.com"; // to address 
 $from= "s20341_17@in.smtpok.com"; // from address
 $from_name= "First Name"; // name of the sender
 $subject= "PLAIN TEST"; // Subject
 $body= "Hello world"; // the message
 
 
 if (smtpmailer($to, $from, $from_name, $subject, $body)) {
               echo "Email sent.....<br/>";
 }



?>