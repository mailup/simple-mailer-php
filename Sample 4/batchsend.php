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
$body=$_SESSION['body'];
$data = mysql_query("select * from userdata where sent=1") or die (mysql_error());
$result="";
$failCounter=0;
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
    //**********************************************
    //Send the email
    //**********************************************       
    if($EmailMessage->Send())
    { 
        $result.="<tr><td><div class=\"image\"><img src=\"resources/images/res_ok.jpg\"/></div><div class=\"label\"></td><td>".$row['emailaddress']."</td></tr>";
        mysql_query("update userdata set sent=2 where `IdRecipient` = ".$row['IdRecipient'].";") or die (mysql_error()); 
    }
    else
    {
        $result.="<tr><td><div class=\"image\"><img src=\"resources/images/res_ng.jpg\"/></div><div class=\"label\"></td><td>".$row['emailaddress']."</td></tr>";
        mysql_query("update userdata set sent=3 where `IdRecipient` = ".$row['IdRecipient'].";") or die (mysql_error()); 
        $failCounter++;
    }              
}
?>
<html>
    <body>
         <form action="tryagain.php" method="post" >
            <table>    
                <?php  echo $result; 
                
                if ($failCounter!=0)
                {                
                ?>                                
                    <tr>                        
                        <td>
                            <input type="submit" value="Send to failed recipients"/>
                        </td>
                    </tr>   
                <?php } ?>
            </table>
        </form>        
    </body>
</html>