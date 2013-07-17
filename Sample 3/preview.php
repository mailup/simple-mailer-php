<?php 
include 'inc.db.php' ;
include_once ('attachment/html_functions.php');

$place  = $_POST['place'];
$interest = $_POST['interest'];
$age = $_POST['age'];
$mail = $_POST['mail'];

$i = 0;
$data = mysql_query("select * from userdata where `idCity` = '$place' and `age` = '$age'") or die(mysql_error());
while($row = mysql_fetch_assoc($data)){
	
		$email = $row['emailaddress'];
				 
		$to = $email; // to address 
		$from= ""; // from address
		$from_name= "Last Name"; // name of the sender
		$subject= "HTML TEST"; // Subjectcon
		$body= "attachment/contents.html"; // the html page nae
		
		
		/*if (smtpmailer($to, $from, $from_name, $subject, $body)) {
			echo "Email sent.....<br/>";
		}
		*/
		
		$i++;
		
}
print $i;


		
?>