<br><br>
<?php
$uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s


    $uri = $_SERVER['REQUEST_URI']; // holds url for last page visited.s
    global $dbhandler0;
        
echo "<form action='index.php' id=searchuser method='post'><table>";
echo "<tr><td>Email</td><td><input id=email name=email></td></tr>";
echo "<tr><td>Pass</td><td><input id=pass name=pass></td></tr>";
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
    <td>Phone</td>
    <td>D.O.B</td>
    <td>Email</td>
    <td>Pass</td>
    <td>Facebook</td>
    <td>Google</td>
    </tr>";

    foreach($resqr as $resvalue) 
    {
        echo "<tr><td>".$resvalue['i_user_id']
        ."</td><td><input name='firstname' value=".$resvalue['va_first_name'].">"
        ."</td><td><input name='lastname' value=".$resvalue['va_last_name'].">"
        ."</td><td><input name='gender' value=".$resvalue['va_gender'].">"
        ."</td><td><input name='phone' value=".$resvalue['va_phone'].">"
        ."</td><td><input name='dob' value=".$resvalue['dt_dob'].">"
        ."</td><td><input name='email' value=".$resvalue['va_email'].">"
        ."</td><td><input name='pass' value=".$resvalue['va_pass'].">"
        ."</td><td><input name='facebook' value=".$resvalue['va_facebook'].">"
        ."</td><td><input name='google' value=".$resvalue['va_google'].">"
        ."</td><td><button id='btnupdateuser' name='btnupdateuser' value=".$resvalue['i_user_id'].">Update This User</button>"
        ."</td></tr>";
    }   
    echo "<input type=hidden id='func' name='func' value='updateuser'>";
    echo "<input type=hidden name='uri' id='uri' value=".$uri.">";     
    echo "</table></form>"; 

    echo'<form action="index.php" id=insertnewuser method="post"><table id="tab" width=100%  border=1 style="font-size:100%;">';
    echo "<tr><TD colspan = 3 align=center>USER</td></tr>";    
    echo "<tr>
    <td width=10%>User ID</td>
    <td width=10%>First Name</td>
    <td>Last Name</td>
    <td>Gender</td>
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


$(document).ready(function() 
{    
  $('#btninsert').click(function() {
    $('#insertnewuser').submit()
}); 

  $('#btnupdateuser').click(function() {
    $('#updateuser').submit()
}); 
  $('#btnlogin').click(function() {
    $('#searchuser').submit()
});    
});   
</script>