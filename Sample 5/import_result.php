<?php 
include 'configuration.php' ;
require_once "simplexlsx.class.php";
if(isset($_POST['sub'])){
    $i = 0;
    if($_POST['type'] == "xl"){
        if (isset($_FILES['file']) ) {
            $xlsx = new SimpleXLSX( $_FILES['file']['tmp_name'] );
            list($cols,) = $xlsx->dimension();
            
            foreach( $xlsx->rows() as $k => $r) {
                if ($k == 0) continue; // skip first row

                $data = mysql_query("select * from userdata where emailaddress = '$r[3]'") or die(mysql_error());
                $row = mysql_fetch_assoc($data);

                $exist = $row['emailaddress'];
                if($exist == ""){
                    mysql_query("insert into userdata(name,surname,display,emailaddress,age,idCity) values ('$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]')") or die (mysql_error());	                                           
                }else{                    
                    mysql_query("update userdata set name='$r[0]',surname='$r[1]',display='$r[2]',age='$r[4]',idCity='$r[5]' where emailaddress='$r[3]'") or die (mysql_error());	                                           
                    
                }
                $i++;

            }
        }	

    }else{
            $file = $_FILES['file']['tmp_name'];
            $handle = fopen($file,"r");
            $i = 0;
            //loop through the csv file and insert into database
            while ($r = fgetcsv($handle,1000,",","'")){
                $data = mysql_query("select * from userdata where emailaddress = '$r[3]'") or die(mysql_error());
                $row = mysql_fetch_assoc($data);

                $exist = $row['emailaddress'];
                if($exist == ""){
                    mysql_query("insert into userdata(name,surname,display,emailaddress,age,idCity) values ('$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]')") or die (mysql_error());	
                }else{                   
                    mysql_query("update userdata set name='$r[0]',surname='$r[1]',display='$r[2]',age='$r[4]',idCity='$r[5]' where emailaddress='$r[3]'") or die (mysql_error());	                                           
                    
                }
                $i++;
            } 			

    }
    print "Total Imported Receipents ".$i;	
    print "<hr>";
}

?>
<a href="/Sample 1/">Next Page</a>