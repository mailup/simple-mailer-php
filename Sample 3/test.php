<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
<script>
function plc(id){

	$.ajax({
	url: 'home_ajax.php',
	type: 'POST',
	data: {
	content: id
	},				
	success:function (data) {
		
		$('#inter').html(data);
			
		}
		
	});  						
}

function int(id){

	$.ajax({
	url: 'interest_ajax.php',
	type: 'POST',
	data: {
	content: id
	},				
	success:function (data) {
		
		$('#age').html(data);
			
		}
		
	});  						
}

function preview(){
	
	window.open("frame.php", "parent");
	
	/*$.ajax({
	url: 'preview.php',
	type: 'POST',
	data: {
	place: $('#homeplace').val(), interest: $('#int').val(), age: $('#age_group').val(), mail: $('#mail_body').val()
	},				
	success:function (data) {
		alert(data);
		//$('#age').html(data);
			
		}
		
	});  */
		
}


</script>


<?php 
include 'inc.db.php'
?>
<form action="" method="post">
<table width="27%" border="1">
  <tr>
    <td width="41%">Home Place</td>
    <td width="59%"><select id="homeplace" onchange="plc(this.value)">
     <option value="">-------</option>
    <?php 
	$home = mysql_query("select * from location") or die(mysql_error());
	while($home_row = mysql_fetch_assoc($home)){
	?>
    
    <option value="<?php print $home_row['idCity']?>">
    <?php print $home_row['city']?>
    </option>
    
    <?php }?>
    </select></td>
  </tr>
  <tr>
    <td>Interest</td>
    <td id="inter"><select></select></td>
  </tr>
  <tr>
    <td>Age Group</td>
    <td id="age"><select></select></td>
  </tr>
  <tr>
    <td>Mail Body</td>
    <td><select id="mail_body">
    <option value="">------</option>
    <option value="contents.html">contents</option>
    </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="button" value="Preview" onclick="preview()" /></td>
  </tr>
</table>


