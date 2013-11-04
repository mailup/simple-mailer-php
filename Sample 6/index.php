<?php 
    require_once "phpmailer/class.phpmailer.php";
    include 'configuration.php';        
    set_time_limit(0);
            
    $count=1;
    
    $zip_file = array();
    $input_folder = "zip/";
    $unzip_folder = "unzip/";

    //EXPLORE ZIP FOLDER
    $files = dir($input_folder);
    while ($file = $files->read()) 
    {
        if($file != "." and $file != "..")
        {       
            $zip_file[] = $file;
        }
    }
    closedir($files->handle);
          
    //EXTRACT CONTENT IN UNZIP FOLDER
    foreach($zip_file as $file_name)
    {
        $zip = new ZipArchive;
        $res = $zip->open($input_folder.$file_name);
        if ($res === TRUE) 
        {
            $ex =  $zip->extractTo($unzip_folder);
            $zip->close();
        }        
        //unlink($input_folder.$file_name);             
    }
    
    
    //EXPLORE UNZIP FOLDER
    $unzip_file = array();
    $unzip_images = array();
    $unzip = dir($unzip_folder);
    
    
    $filesInFolder=array();
    while ($file = $unzip->read()) 
    {
        if($file != "." and $file != "..")
        {   
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if ($ext=="html")
            {
                $unzip_file[] = $file;
            }
            if ($ext=="jpg")
            {
                $unzip_images[] = $file;
            }
            
            $filesInFolder[]=$file;
        }
    }
    closedir($unzip->handle);
     
    //SEND MESSAGES   
    if(sizeof($unzip_file) > 0)
    {
        foreach($unzip_file as $file)
        {                                                       
            $bodyImages=array();
            $body=file_get_contents($unzip_folder.$file);        
            preg_match_all("/cid:([^@]*)/", $body, $matches);                         
            foreach ($matches[1] as $img)
            {
                $bodyImages[]=$img;        
            }
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
            $EmailMessage->AddAddress($MESSAGE_To);            //Add one or more recipients   
            $EmailMessage->Subject="HTML TEST ".$count;                         //Set the email subject
            $EmailMessage->Body=file_get_contents($unzip_folder.$file);                                  //Set the email body      
            $EmailMessage->isHTML();     
            foreach($bodyImages as $img)
            {
                $EmailMessage->AddEmbeddedImage($unzip_folder.$img, $img."@00", $img);
            }
            //**********************************************
            //Send the email
            //**********************************************       
            if($EmailMessage->Send())
            {
                //MESSAGE SENT
            }               
            else
            {
                //MESSAGE NOT SENT
            }
            $count++;
            
        }
    }            
       
    //EMPTY UNZIP FOLDER
    foreach($filesInFolder as $file)
    {
        unlink($unzip_folder.$file);
    }
     
?>