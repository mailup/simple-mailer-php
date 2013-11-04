<?php 
    include 'configuration.php';
    $template = $_POST['template'];
    $age = $_POST['age'];    
    $recipients=mysql_query("select * from userdata where `age` >= '$age'") or die (mysql_error());        
    $recordcount = mysql_num_rows($recipients);                   
    $array_ids=array();       
    $_SESSION['template']=$template;
    $_SESSION['age']=$age;
    
?>
<html>
    <body>
        <form action="setup_recipients.php" method="POST">            
            <iframe name="theFrame" src="html/<?php echo $template;?>" style="width:50% ; height:50%;"></iframe>
            <hr>
            Number of recipients : <?php echo $recordcount; ?>
            <hr>
            <table width="30%" border="0">
                <tr>
                    <th>Email Address</th>
                    <th>First Name</th>
                    <th>Age</th>
                </tr>  
                <?php 
                    while ($row = mysql_fetch_assoc($recipients))
                    {    
                        $array_ids[] = $row['IdRecipient'];
                ?>                    
                        <tr>
                            <td><?php print $row['emailaddress'];?></td>
                            <td><?php print $row['name'];?></td>
                            <td><?php print $row['age'];?></td>
                        </tr>
                <?php }?>
            </table>
            <hr>
            <?php 
                if ($recordcount>0) 
                {
                    echo '<input type="submit" value="Send"/>';
                }
                else
                {
                    echo "Empty recipient list.";
                }
                $_SESSION['idRecipients']=$array_ids;
            ?>                                                          
        </form>
    </body>
</html>