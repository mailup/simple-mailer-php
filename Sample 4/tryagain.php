<?php
    include 'configuration.php';
    mysql_query("update userdata set sent=1 where sent=3") or die (mysql_error()); 
    header("location: batchsend.php");
?>