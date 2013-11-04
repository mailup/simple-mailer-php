<?php 
    include 'configuration.php';
    $template = $_POST['template'];
    $age = $_POST['age'];
    $data = mysql_query("select * from userdata where `age` >= '$age'") or die (mysql_error());
    $recordcount = mysql_num_rows($data);    
?>
<html>
    <body>
        <form action="batchsend.php" method="POST">
            <input type="hidden" name="template" value="<?php echo $template;?>"/>
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
                <?php while ($row = mysql_fetch_assoc($data)){    ?>
                    <input type="hidden" name="users[]" value="<?php echo $row['IdRecipient'];?>"/>
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
            ?>                                                          
        </form>
    </body>
</html>