<?php
include 'configuration.php';
require_once('phpmailer/class.phpmailer.php');
if(isset($_POST['sub'])){
    
    $subject= "HTML TEST 7";
    $temp = file_get_contents("html/".$_POST['template']);      
    $area = $_POST['area']; // area name...    
    $data = mysql_query("select * from location where city = '$area'") or die (mysql_error());
    $row = mysql_fetch_assoc($data);
    $cityID =  $row['idCity'];         
    $url=$row['url'];        
    $inner = mysql_query("select * from userdata where idCity = '$cityID'") or die (mysql_error());    
    
    $result="";
    $failCounter=0;
    while($row = mysql_fetch_assoc($inner))
    {
        $to = $row['emailaddress'];               
        $name = $row['display'];
        $body = str_replace(array('{name}','{city}','{url}'),array($name,$area,$url),$temp);            
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
        }
        else
        {
            $result.="<tr><td><div class=\"image\"><img src=\"resources/images/res_ng.jpg\"/></div><div class=\"label\"></td><td>".$row['emailaddress']."</td></tr>";            
            $failCounter++;
        }              
    }     	
}
?>
<html>
    <body>
         <form action="tryagain.php" method="post" >
            <table>    
                <?php  echo $result;?>
            </table>
        </form>        
    </body>
</html>



