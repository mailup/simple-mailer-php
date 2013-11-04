

<form action="sendmail.php" method="post" >
  
  <table width="300px" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <img src="resources/images/ico_area.jpg" width="207" />
        </td>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <select name="area">
            <option value="New York City">Nyc</option>
            <option value="Philadelphia">Philadelphia</option>
            <option value="Miami">Miami</option>
    </select>
        </td>
        
    </tr>
    <tr>
        <td style="border:0px solid black; background-color:#B8CBD9">
              <img src="resources/images/ico_mailbody.jpg" width="207" />
        </td>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <select name="template">
                <option value="sports.html">Sports</option>
                <option value="reading.html">Reading</option>
                <option value="dinning.html">Dinning</option>
            </select>
        </td>
    </tr>
    <tr>
        <td style="border:0px solid black; background-color:#B8CBD9">
        </td>
        <td style="border:0px solid black; background-color:#B8CBD9">
            <input type="submit" name="sub" id="button" value="Send!" />
        </td>
    </tr>
  </table>
</form>
