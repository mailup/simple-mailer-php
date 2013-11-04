<?php 
//########################################################
//Include the PHPmailer class.                 
//
//PHPmailer allows you to create and  transport an email an email message.                   
//The PHPmailer class is available at this address:
//https://github.com/PHPMailer/PHPMailer/ 
//########################################################
require_once "phpmailer/class.phpmailer.php";
include 'configuration.php';

//LOAD THE TEMPLATE FROM FILE
$body = file_get_contents("html/".$_POST['template']);

//Find images

$images[]="";

$dom=new DOMDocument();
$dom->loadXML($body);
$imgs = $dom->getElementsByTagName("img");
foreach($imgs as $img){    
    $src=$img->getAttribute('src');    
    $img->setAttribute( 'src' , 'cid:ico_template02.jpg' );
    $images[]=$src;
}
echo $dom->saveXML();




//PREPARE THE LIST OF RECIPIENTS
$ids = implode(",",$_POST["users"]);
$data = mysql_query("select * from userdata where `IdRecipient` in ($ids)") or die (mysql_error()); 
$result="";
while ($row = mysql_fetch_assoc($data))
{             
    $EmailMessage = new PHPmailer();     
    $EmailMessage->SetLanguage('en','language/'); //Define the language 
    //**********************************************
    //SMTP configuration
    //**********************************************
    $EmailMessage->IsSMTP();                        //Specify usage of SMTP Server
    $EmailMessage->Host = $SMTP_Host;               //SMTP+ Server address 
    $EmailMessage->Port=$SMTP_Port;                 //SET the SMTP Server port               
    $EmailMessage->Username = $SMTP_Username;       //SMTP+ authentication: username 
    $EmailMessage->Password = $SMTP_Password;       //SMTP+ authentication: password       
    $EmailMessage->SMTPAuth = $SMTP_Auth;           //Authentication
 
    //**********************************************
    //Email data
    //**********************************************
    $EmailMessage->IsHTML(true);                                //Set the email format    
    $EmailMessage->From=$MESSAGE_From;                             //From: email address
    $EmailMessage->AddAddress($row['emailaddress']);            //Add one or more recipients   
    $EmailMessage->Subject="SAMPLE 3.";                         //Set the email subject
    $EmailMessage->Body=$body;                                  //Set the email body      
    $EmailMessage->isHTML();     
    
    
    foreach ($images as $im)
    {
        $EmailMessage->AddEmbeddedImage($im, $result)
    }
    
    //**********************************************
    //Send the email
    //**********************************************       
    if($EmailMessage->Send())
    { 
        $result.="<tr><td><div class=\"image\"><img src=\"resources/images/res_ok.jpg\"/></div><div class=\"label\"></td><td>".$row['emailaddress']."</td></tr>";
    }
    else
    {
        $result.="<tr><td><div class=\"image\"><img src=\"resources/images/res_ng.jpg\"/></div><div class=\"label\"></td><td>".$row['emailaddress']."</td></tr>";
    }              
}
?>
<html>
    <body>
        <table>    
            <?php  echo $result; ?>
        </table>
    </body>
</html>

