<?php 
include 'inc.db.php';

$interest_id = $_POST['content'];
$ages = "";
$ids = "";

print "<select id='age_group' onchange='age(this.value)'>";
print "<option value='0'>-----</option>";


$data = mysql_query("select * from `user-interest` where interest = '$interest_id'") or die (mysql_error());
$distinct=array();
while($data_row = mysql_fetch_assoc($data)){
	
		$idRecip =  $data_row['idRecipient'];
		
		$data_2 = mysql_query("select * from `userdata` where idRecipient = '$idRecip' ") or die (mysql_error());
		$row = mysql_fetch_assoc($data_2);
		$age =  $row['age'];
		if(in_array($age,$distinct))continue;
		array_push($distinct,$age);
		
			?>
            <option value="<?php print $age?>"><?php print $age?></option>
            <?php
}

print "</select>";
?>