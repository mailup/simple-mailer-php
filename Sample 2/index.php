<?php
set_time_limit(0);

//********************************************
//Setup the email properties
//********************************************
//SMTP SERVER
$host = "";                             //SMTP server address
$username = "";                         //SMTP username
$password = "";                         //SMTP password
$port=25;                               //SMTP port

//EMAIL DATA
$from = "";                             //Message From
$to = "";                               //Message Recipient Address
$subject = "Sample 2";                  //Message Subject
$body = "
    <html xmlns=\"http://www.w3.org/1999/xhtml\" >
    <head>
        <title>Untitled Page</title>
    </head>
    <body>
        <center>
            <table style=\"background-color:rgb(239,239,240);width:600px\" cellspacing=\"0\" cellpadding=\"10\">
                <tr>	
                        <td colspan=\"2\" align=\"right\">
                            <img alt=\"php sample 2\" src=\"cid:sample02.jpg\" width=\"600\" />
                        </td>
                </tr>	
                <tr style=\"height:10px;\"><td colspan=\"2\">&nbsp;</td></tr>	
                <tr>		
                        <td align=\"right\" style=\"width:60px;\"><img alt=\"\" src=\"cid:bullet01.jpg\" width=\"40px\" height=\"40px\" /></td>
                        <td align=\"left\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </td>		
                </tr>	
                <tr>		
                        <td align=\"right\" style=\"width:60px;\"><img alt=\"\" src=\"cid:bullet02.jpg\" width=\"40px\" height=\"40px\" /></td>
                        <td align=\"left\">Vivamus ac sapien porta. suscipit est quis, euismod eros. </td>		
                </tr>	
                <tr>		
                        <td align=\"right\" style=\"width:60px;\"><img alt=\"\" src=\"cid:bullet03.jpg\" width=\"40px\" height=\"40px\" /></td>
                        <td align=\"left\">Fusce velit nibh, hendrerit in vulputate sed, auctor id libero.</td>		
                </tr>		
            </table>
        </center>
</body>
</html>
";
 
send_mail($to,$from,$subject,$body,
        array
        (                
                dirname(__FILE__)."./Attachments/sample02.jpg",     //Attachment 1 path
                dirname(__FILE__)."./Attachments/bullet01.jpg",     //Attachment 2 path
                dirname(__FILE__)."./Attachments/bullet02.jpg",     //Attachment 3 path
                dirname(__FILE__)."./Attachments/bullet03.jpg"      //Attachment 4 path
        )
);

function send_mail($to, $from, $subject, $body,$attachments=array()) {
    global $host,$port,$username,$password;
    
    $smtp = fsockopen($host, $port);
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
    //Initiates a conversation with the mail server
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

    $boundary = '71fb492531959be5be39d9e4f17b7b647c5e27ee901b2e92d550f2c3959914c9';
 
    fputs($smtp, "MIME-Version: 1.0\r\n");
    fputs($smtp, "From: $from\r\n");            //From header
    fputs($smtp, "To: $to\r\n");                //To header
    fputs($smtp, "Subject: $subject\r\n");      //Subject header    

    //*************************************************
    //Declare the message as a multipart/mixed
    //*************************************************
    fputs($smtp, "Content-type: multipart/mixed; boundary=$boundary\r\n");
    fputs($smtp, "\r\n");
    fputs($smtp, "This is a Multi Part Message.\r\n");

    fputs($smtp, "--$boundary\r\n");
    
    fputs($smtp, "Content-type: text/html; charset=iso-8859-1\r\n");
    fputs($smtp, "\r\n");
    fputs($smtp, "$body\r\n");          //Add the html body
    
    //*************************************************
    //Add all passed attachment
    //*************************************************
    foreach($attachments as $attachment) 
    {       
       //*************************************************
       //Extract the filename from path
       //*************************************************
       $filename=basename($attachment);              
       //*************************************************
       //Add the attachment and set it so that it is 
       //displayed within the message (Embedded Resource)       
       //*************************************************
       fputs($smtp, "--$boundary\r\n");
       fputs($smtp, "Content-Description: ".$filename."\"\r\n");
       fputs($smtp, "Content-Type: image/jpg; name=\"".$filename."\"\r\n");
       fputs($smtp, "Content-Transfer-Encoding: base64\r\n");
       fputs($smtp, "Content-ID: ".$filename."\r\n");
       fputs($smtp, "Content-Disposition: inline; filename=".$filename."\r\n");
       fputs($smtp, "\r\n");                                
       fputs($smtp, base64_encode(file_get_contents($attachment))."\r\n");       
    }
    
    //*************************************************
    //Close the boundaries
    //*************************************************    
    fputs($smtp, "--$boundary--\r\n");
    //*************************************************
    //Teminate the message
    //*************************************************    
    fputs($smtp, ".\r\n");
    $data = fgets($smtp, 4096);
        
    //*************************************************
    //Ask the SMTP server to close the connection.
    //*************************************************    
    fputs($smtp,"QUIT\r\n");
    $data = fgets($smtp, 4096);
        
    fclose($smtp);
    echo "Mail sent";
 
}

?>
