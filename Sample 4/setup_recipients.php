<?php
include 'configuration.php';
$idRecipients = $_SESSION['idRecipients'];
$ids=implode(",",$idRecipients);
mysql_query("update userdata set sent=0") or die (mysql_error()); 
mysql_query("update userdata set sent=1 where `IdRecipient` in ($ids)") or die (mysql_error()); 
header("location: batchsend.php");
?>