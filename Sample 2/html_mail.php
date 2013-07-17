<?php
 include_once ('html_functions.php');
 
 $to =""; // to address 
 $from= ""; // from address
 $from_name= "Last Name"; // name of the sender
 $subject= "HTML TEST"; // Subject
 $body= "contents.html"; // the html page nae
 $attachement_1 = "phpmailer_mini.gif";
 $attachement_2 = "phpmailer.gif";
 
 if (smtpmailer($to, $from, $from_name, $subject, $body, $attachement_1, $attachement_2)) {
	echo "Email sent.....<br/>";
  }
	
?>