<br><br>
<!DOCTYPE html>
<?php
    $sqluser= "SELECT * FROM user";
    $resuser = $dbhandler0->query($sqluser);

    $sqlresuser = "SELECT * FROM resuser";
    $resresuser = $dbhandler0->query($sqlresuser);
echo "<html><form action=system/function.php method=post id=test_form><table>";

echo "<tr><td>Name</td><td><select id=userid onchange=filltokenuser()><option></option>";
foreach($resuser as $resvalue1) 
{
echo "<option value=".$resvalue1['i_user_id']." token=".$resvalue1['va_token'].'>';
echo $resvalue1['va_first_name'] .' ' . $resvalue1['va_last_name'] ; 
echo "</option>";
}
echo "<select></td>";


echo "<tr><td>Res User Name</td><td><select id=resuserid onchange=filltokenresuser()><option></option>";
foreach($resresuser as $resvalue2) 
{
echo "<option value=".$resvalue2['i_res_user_id']." token=".$resvalue2['va_token'].'>';
echo $resvalue2['va_username']; 
echo "</option>";
}
echo "<select></td>";

echo "</tr>";
echo "<tr><td>Token</td><td><input id=token required name=token value=></td></tr>";
echo "<tr><td>Title</td><td><input id=title name=title value=></td></tr>";
echo "<tr><td>Body</td><td><input id=body name=body value=></td></tr>";
echo "<tr><td>Broadcast</td><td><input id=broadcast name=broadcast value=></td></tr>";
echo "<tr><td>Mode</td><td><select id=mode name=mode required><option></option><option value = 1>TRIGGER MESSAGE</option><option value = 2>TRIGGER BROADCAST TO DIMCHOI</option></select></td></tr>";
echo "<tr><td colspan = 2><input type=submit name=firebase value='Launch Cheok Dick'</td></tr>";
echo "<input type=hidden id=runfunction name=runfunction value='generatefirebase'>";
echo "<table></form></html>";
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function filltokenuser()
{	
	var usertoken = $('option:selected', $("#userid")).attr('token');
	$("#token").val(usertoken); 
	$("#resuserid").val(usertoken);    
}  
function filltokenresuser()
{
	var restoken = $('option:selected', $("#resuserid")).attr('token');
	$("#token").val(restoken);   
	$("#userid").val(restoken);      
}  
$(document).ready(function() 
{
   $("#mode").change(function()
    {
    	if (this.value==1)
    	{
			$("#title").val(""); 	
			$("#body").val(""); 
			$("#broadcast").val(""); 
			$("#title").prop("disabled", false);	
			$("#body").prop("disabled", false);	
			$("#broadcast").prop("disabled", true);						 
		}    	
    	else if (this.value==2)
    	{
			$("#title").val(""); 	
			$("#body").val(""); 
			$("#broadcast").val(""); 
			$("#title").prop("disabled", true);	
			$("#body").prop("disabled", true);	
			$("#broadcast").prop("disabled", false);						 
		}

   });	
}); 
</script>
