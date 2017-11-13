<br><br>
<!DOCTYPE html>
<?php
    $sqlres = "SELECT * FROM user";
    $resresuser = $dbhandler0->query($sqlres);
echo "<html><form action=firebase.php method=post id=test_form><table>";

echo "<tr><td>Name</td><td><select onchange=filltoken(this.value)><option></option>";
foreach($resresuser as $resvalue) 
{
echo "<option value=".$resvalue['va_token'].'>';
echo $resvalue['va_first_name'] .' ' . $resvalue['va_last_name'] ; 
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
function filltoken(tokenvalue)
{
	$("#token").val(tokenvalue);     
}  
</script>
