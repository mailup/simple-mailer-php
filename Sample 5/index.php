<?php 
error_reporting(E_ALL);
set_time_limit(0);
ini_set("memory_limit","-1");
error_reporting(0);
?>


<form method="post" enctype="multipart/form-data" id="myForm" action="import_result.php" >
  
  <table width="31%" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <img src="resources/images/ico_import.jpg" width="207" />
        </td>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <input type="file" name="file" id="fi">
        </td>        
    </tr>
    <tr>
        <td style="border:0px solid black; background-color:#B8CBD9">
              <img src="resources/images/ico_fileformat.jpg" width="207" />
        </td>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <select name="type">
                <option value="xl">xlsx</option>
                <option value="csv">csv</option>        
            </select>
        </td>
    </tr>
    <tr>
        <td style="border:0px solid black; background-color:#B8CBD9">
        </td>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <input type="submit" name="sub" value="Upload" />
        </td>
    </tr>
  </table>
</form>
