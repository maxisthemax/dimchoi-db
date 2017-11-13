<br><br>
<!DOCTYPE html>
<?php
    $sqluser= "SELECT * FROM user";
    $resuser = $dbhandler0->query($sqluser);

    $sqlresuser = "SELECT * FROM resuser";
    $resresuser = $dbhandler0->query($sqlresuser);
echo "<html><form action=firebase.php method=post id=test_form><table>";

echo "<tr><td>Name</td><td><select id=user onchange=filltokenuser(this.value)><option></option>";
foreach($resuser as $resvalue1) 
{
echo "<option value=".$resvalue1['va_token'].'>';
echo $resvalue1['va_first_name'] .' ' . $resvalue1['va_last_name'] ; 
echo "</option>";
}
echo "<select></td>";


echo "<tr><td>Res User Name</td><td><select id=resuser onchange=filltokenresuser(this.value)><option></option>";
foreach($resresuser as $resvalue2) 
{
echo "<option value=".$resvalue2['va_token'].'>';
echo $resvalue2['va_username']; 
echo "</option>";
}
echo "<select></td>";




echo "</tr>";
echo "<tr><td>Token</td><td><input id=token name=token value=></td></tr>";
echo "<tr><td>Title</td><td><input id=title name=title value=></td></tr>";
echo "<tr><td>Body</td><td><input id=body name=body value=></td></tr>";
echo "<tr><td><input type=submit name=firebase value='Go'</td></tr>";
echo "<table></form></html>";
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function filltokenuser(tokenvalue)
{
	$("#token").val(tokenvalue); 
	$("#resuser").val(tokenvalue);    
}  
function filltokenresuser(tokenvalue)
{
	$("#token").val(tokenvalue);   
	$("#user").val(tokenvalue);      
}  
</script>
