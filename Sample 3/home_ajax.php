<?php 
include 'inc.db.php';

$idcity = $_POST['content'];
$inter = "";

$data = mysql_query("select * from  userdata where idCity = '$idcity'") or die (mysql_error());
while($row = mysql_fetch_assoc($data)){
	
	$idReci = $row['IdRecipient'];

	$data_2 = mysql_query("select * from `user-interest` where idRecipient = '$idReci'") or die (mysql_error());
	while($row = mysql_fetch_assoc($data_2)){
		
		$inter .= $row['interest'].",";
		
	}
}

$inter =  rtrim($inter,",");
$inter = explode(",",$inter);

$data_3 = mysql_query("select * from `interest` where interest = '$inter[0]' or interest = '$inter[1]'") or die (mysql_error());
		
		print "<select id='int' onchange='int(this.value)'>";
		print "<option value='0'>-----</option>";
		while($row = mysql_fetch_assoc($data_3)){
			
			$description =  $row['description'];
			$interest_id = $row['interest'];
			?>
            <option value="<?php print $interest_id?>"><?php print $description?></option>
            <?php
		}
       print "</select>";

?>