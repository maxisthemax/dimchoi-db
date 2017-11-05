<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s


    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
        
echo "<form action='index.php' id=searchuser method='post'><table>";
echo "<tr><td>Email</td><td><input id=email name=email></td></tr>";
echo "<tr><td>Pass</td><td><input id=pass name=pass></td></tr>";
echo "<tr><td>Facebook</td><td><input id=facebook name=facebook></td></tr>";
echo "<tr><td>Google</td><td><input id=google name=google></td></tr>";
echo "<tr><td>Token</td><td><input id=token name=token></td></tr>";
echo "<tr><td><select name='type' id = 'type'>
<option value = 'email'>Email</option>
<option value = 'fb'>Facebook</option>
<option value = 'google'>Google</option>
</select></td></tr>";

echo "<input type=hidden id='func' name='func' value='getuser'>";
echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
echo "</table></form>";
echo "<button id='btnlogin' name='btnlogin'>LOGIN</button>";
echo "<br>";

    $sqlqr = "SELECT * FROM user";
    $resqr = $dbhandler0->query($sqlqr);
    echo "<form action='index.php' id=updateuser method='post'><table>";
    echo "<tr><TD colspan = 3 align=center>USER</td></tr>";    
    echo "<tr>
    <td width=10%>User ID</td>
    <td width=10%>First Name</td>
    <td>Last Name</td>
    <td>Gender</td>
    <td>Country Code</td>
    <td>Phone Code</td>
    <td>Phone</td>
    <td>D.O.B</td>
    <td>Email</td>
    <td>Pass</td>
    <td>Facebook</td>
    <td>Google</td>
    <td>Token</td>
    </tr>";

    foreach($resqr as $resvalue) 
    {   $userid=$resvalue["i_user_id"];
        echo "<tr><td>".$resvalue['i_user_id']
        ."</td><td><input name='firstname[$userid]' value='".$resvalue['va_first_name']."''>"
        ."</td><td><input name='lastname[$userid]' value='".$resvalue['va_last_name']."''>"
        ."</td><td><input name='gender[$userid]' value=".$resvalue['va_gender'].">"
        ."</td><td><input name='countrycode[$userid]' value=".$resvalue['va_country_code'].">"
        ."</td><td><input name='phonecode[$userid]' value=".$resvalue['va_phone_code'].">"
        ."</td><td><input name='phone[$userid]' value=".$resvalue['va_phone'].">"
        ."</td><td><input name='dob[$userid]' value=".$resvalue['dt_dob'].">"
        ."</td><td><input name='email[$userid]' value=".$resvalue['va_email'].">"
        ."</td><td><input name='pass[$userid]' value=".$resvalue['va_pass'].">"
        ."</td><td><input name='facebook[$userid]' value=".$resvalue['va_facebook'].">"
        ."</td><td><input name='google[$userid]' value=".$resvalue['va_google'].">"
        ."</td><td><input name='token[$userid]' value=".$resvalue['va_token'].">"
        ."<td width=20%><button onclick='setformupdate($userid);'>Update Current Row</button></td>" 
        ."</td></tr>";
    }   
    echo "<input type=hidden id='func' name='func' value='updateuser_dev'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">";    
    echo "<input type=hidden name='userid' id='userid'>";   
    echo "</table></form>"; 

    echo'<form action="index.php" id=insertnewuser method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>USER</td></tr>";    
    echo "<tr>
    <td width=10%>User ID</td>
    <td width=10%>First Name</td>
    <td>Last Name</td>
    <td>Gender</td>
    <td>Country Code</td>
    <td>Phone Code</td> 
    <td>Phone</td>
    <td>D.O.B</td>
    <td>Email</td>
    <td>Pass</td>
    <td>Facebook</td>
    <td>Google</td>
    <td></td>
    </tr>";

    echo "<tr>
    <td></td>
    <td><input name=firstnamenew id=firstnamenew value=''></td>
    <td><input name=lastnamenew id=lastnamenew value=''></td>
    <td><select name=gendernew id=gendernew><option value=''></option><option value='Male'>Male</option><option value='Female'>Female</option></select></td>
    <td><input name=countrycodenew id=countrycodenew value=''></td> 
    <td><input name=phonecodenew id=phonecodenew value=''></td>   
    <td><input name=phonenew id=phonenew value=''></td>   
    <td><input type=date name=dobnew id=dobnew></td> 
    <td><input name=emailnew id=emailnew value=''></td> 
    <td><input name=passnew id=passnew value=''></td>   
    <td><input name=facebooknew id=facebooknew value=''></td>   
    <td><input name=googlenew id=googlenew value=''></td>          
    </tr>";  
    echo "<input type=hidden id='func' name='func' value='insertnewuser'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">"; 
    echo "</table>";
    echo "</form>";   

    echo "<button id='btninsert' name='btninsert'>Insert New User</button>";

?>

<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script>
function setformupdate(userid)
{
    $("#userid").val(userid);
}
$(document).ready(function() 
{    
  $('#btninsert').click(function() {
    $('#insertnewuser').submit()
}); 
 
  $('#btnlogin').click(function() {
    $('#searchuser').submit()
});    
});   
</script>