<?php
$SMTP_Host = "";            //SMTP HOST ADDRESS
$SMTP_Username = "";                    //SMTP USERNAME
$SMTP_Password = "";                    //SMTP PASSWORD
$SMTP_Auth=false;                       //SMTP AUTHENTICATION REQUIRED
$SMTP_Port=25;                          //SMTP PORT
$MESSAGE_From = "";                     //MESSAGE FROM
$MESSAGE_Subject = "";                  //MESSAGE SUBJECT

$db_name = "sample";               //MySql DATABASE
$db_host = "localhost";                 //MySQL HOST
$db_username = "root";                  //MySQL USERNAME
$db_pass = "";                          //MySQL PASSWORD

$dbc=mysql_connect("$db_host","$db_username","$db_pass") or die(mysql_error());
mysql_select_db("$db_name") or die("no database by that name");

session_start();
?>