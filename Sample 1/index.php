<?php
error_reporting(0);

//********************************************
//Setup the email properties
//********************************************
//SMTP SERVER
$host = "";                             //SMTP server address
$username = "";                         //SMTP username
$password = "";                         //SMTP password
$port=25;                               //SMTP port


//EMAIL DATA
$from = "";                                     //Message From
$to = "";                                       //Message Recipient Address
$subject = "Sample 1.";                         //Message Subject
$body = "Hi,\n\This is the Smaple 1 message.";  //Message Body 

//Send the mail message
send_mail($to,$from,$subject,$body);    



//***********************************
//FUNCTION mail_send
//***********************************/
function send_mail($to, $from, $subject, $body) {
    global $host,$port,$username,$password;
        
    $smtp = fsockopen($host, $port);        //Open the port
    $data = fgets($smtp, 1024);             
    
    //*************************************************
    //Open the connection, SMTP Service ready. 
    //*************************************************
    if(substr($data,0,3) != 220){
        echo 'Connect:'.$data.'<br/>';
        fclose($smtp);
        return;
    }

    //*************************************************
    //Initiate a conversation with the mail server
    //*************************************************
    fputs($smtp, "HELO $host\n");
    $data = fgets($smtp, 1024);        
    if (substr($data,0,3) != 250) {
        fclose($smtp);
        echo 'HELO:'.$data.'<br/>';
        return;
    }
    
    //*************************************************
    //Login to the  SMTP server using
    //username and password.
    //*************************************************
    if ($username != '') {
        fputs($smtp,"AUTH LOGIN\n");
        $response = fgets($smtp, 1024);
           
        fputs($smtp, base64_encode($username)."\n");
        $response = fgets($smtp, 1024);       
    }
    if ($password != '') {
        fputs($smtp, base64_encode($password)."\n");
        $response = fgets($smtp, 1024);
    }
  
    //*************************************************
    //Specifies the sender address tells the SMTP
    //server that a new transaction is required.
    //*************************************************
    fputs($smtp, "MAIL From:<$from>\n");        
    $data = fgets($smtp, 1024);
    if (substr($data,0,3) != 250) {
        fclose($smtp);
        echo $data.'<br/>';
        return;
    }

    //*************************************************
    //Specifies the recipient address. 
    //If you need to specify more recipients you
    //can repeat the commond.
    //*************************************************
    fputs($smtp, "RCPT To:<$to>\n");            
    $data = fgets($smtp, 1024);
    if (substr($data,0,3) != 250) {
        fclose($smtp);
        echo $data.'<br/>';
        return;
    }

    //*************************************************
    //The DATA command starts the transfer of any 
    //message pieces. 
    //A single dot ("'") in a separate line tells
    //the SMTP server that the transfer id completed.
    //SMTP server reply with a 250 code if the 
    //message is accepted.    
    //*************************************************
    fputs($smtp, "DATA\n");                     
    $data = fgets($smtp, 1024);
    if (substr($data,0,3) != 354) {
        fclose($smtp);
        echo $data.'<br/>';
        return;
    }

    fputs($smtp, "From: $from\n");              //From header
    fputs($smtp, "To: $to\n");                  //To header
    fputs($smtp, "Subject: $subject\n\n");      //Subject header
    fputs($smtp, "$body\r\n.\r\n");             //Message body
          
    
    //*************************************************
    //Asks the SMTP server to close the connection.
    //*************************************************    
    fputs($smtp, "QUIT\n");             
    $data = fgets($smtp, 1024);        
    if (substr($data,0,3) == 250) 
    {
        echo "OK. SENT.";
    }
    else        
    {
        echo "ERR. NOT SENT.";
    }
    fclose($smtp);      //Close the port
    echo "Mail sent"; 
}

?>