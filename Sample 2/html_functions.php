<html>
<head>
<title>SMTP advanced test </title>
</head>
<body>

<?php

require_once('phpmailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
function smtpmailer($to, $from, $from_name, $subject, $body, $attachement_1, $attachement_2) { 
    $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch


    $mail->IsSMTP(); // telling the class to use SMTP

    try {
      $mail->Host       = "i"; // SMTP server
      $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
      $mail->SMTPAuth   = true;                  // enable SMTP authentication
      $mail->Host       = ""; // sets the SMTP server
      $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
      $mail->Username   = ""; // SMTP account username
      $mail->Password   = "";        // SMTP account password
      $mail->AddAddress($to); // To address
      $mail->SetFrom($from, $from_name); // From address
      $mail->AddReplyTo($from, $from_name); // Adress to be replied
      $mail->Subject = $subject;// subject
      $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
      $mail->MsgHTML(file_get_contents($body)); // the html content (file name)
      $mail->AddAttachment($attachement_1);      // attachment
      $mail->AddAttachment($attachement_2); // attachment
      $mail->Send();
      echo "Message Sent OK</p>\n";
    } catch (phpmailerException $e) {
      echo $e->errorMessage(); //Pretty error messages from PHPMailer
    } catch (Exception $e) {
      echo $e->getMessage(); //Boring error messages from anything else!
    }
}

?>

</body>
</html>
