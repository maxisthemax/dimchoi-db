<!DOCTYPE html>
<?php
global $dbhandler0;
    $dbname = isset($_POST['dbname']) ? $_POST['dbname'] : '';
    if ($dbname != '')
    {
    $res = $dbhandler0->query($sqlcheck);
    $fp = fopen('settings.php', 'w');
    fwrite($fp, $dbname);
    }
?>
<html>
<body>
  <h1>DATASOURCE SWITCHING</h1>
  <form action="development.php" method='post'>
  <input type="radio" name="dbname" id="dbname_1" value='{"dbname":"dimchoi"}'> dimchoi
  <input type="radio" name="dbname" id="dbname_2" value='{"dbname":"dimchoi_prod"}'> dimchoi_prod
  <input type='submit' value='SWITCH DB'>
  </form>
 
 <br><br> 
<h1>DEBUGGING OPTION</h1>
<h2>getallstateandcity</h2>
<form action="index.php" method="post" target="_blank">
  <input type="submit" name="func" value="getallstateandcity"><br>
</form>
 <br><br> 
<form action="index.php" method="post" target="_blank">
  <table>
  <tr>
    <td><h2>getres</h2></td>
  </tr> 
  <tr>
    <td>resid</td><td><input type="text" name="resid"></td>
  </tr>    
  <tr>
    <td>state</td><td><input type="text" name="state"></td>
  </tr>
  <tr>
    <td>city</td><td><input type="text" name="city"></td>
  </tr>
  <tr>
    <td>search</td><td><input type="text" name="ressearch"></td>
  </tr>
  <tr>     
    <td>total</td><td><input type="text" name="total"></td>
  </tr>
  <tr>    
    <td>start from</td><td><input type="text" name="startfrom"></td>
  </tr> 
  <tr>
    <td><input type="radio" name="feature" value=1></td>
    <td>Feature 1</td>
  </tr> 
  <tr>
    <td><input type="radio" name="feature" value=2></td>
    <td>Feature 2</td>
  </tr> 
  <tr>
  <tr>    
    <td>area</td><td><input type="text" name="area"></td>
  </tr>      
  <td colspan=2><input type="submit" name="func" value="getres"></td>
  </table>
</form>
 <br><br> 
<form action="index.php" method="post" target="_blank">
  <table>
  <tr>
    <td><h2>getresbyfeature</h2></td>
  </tr>   
  <tr>
    <td>state</td><td><input type="text" name="state"></td>
  </tr>
  <tr>
    <td>city</td><td><input type="text" name="city"></td>
  </tr>
  <tr>
    <td>search</td><td><input type="text" name="ressearch"></td>
  </tr>
  <tr>     
    <td>total</td><td><input type="text" name="total"></td>
  </tr>
  <tr>    
    <td>start from</td><td><input type="text" name="startfrom"></td>
  </tr> 
  <tr>
    <td><input type="radio" name="feature" value=1></td>
    <td>Feature 1</td>
  </tr> 
  <tr>
    <td><input type="radio" name="feature" value=2></td>
    <td>Feature 2</td>
  </tr> 
  <tr>    
  <td colspan=2><input type="submit" name="func" value="getresbyfeature"></td>
  </table>
</form>
<br><br> 
<form action="index.php" method="post" target="_blank">
  <table>
  <tr>
    <td><h2>getresbylocation</h2></td>
  </tr>   
  <tr>
    <td>state</td><td><input type="text" name="state"></td>
  </tr>
  <tr>
    <td>city</td><td><input type="text" name="city"></td>
  </tr>
  <tr>
    <td>search</td><td><input type="text" name="ressearch"></td>
  </tr>
  <tr>     
    <td>total</td><td><input type="text" name="total"></td>
  </tr>
  <tr>    
    <td>start from</td><td><input type="text" name="startfrom"></td>
  </tr> 
  <tr>
    <td><input type="radio" name="feature" value=1></td>
    <td>Feature 1</td>
  </tr> 
  <tr>
    <td><input type="radio" name="feature" value=2></td>
    <td>Feature 2</td>
  </tr> 
  <tr>    
  <td colspan=2><input type="submit" name="func" value="getresbylocation"></td>
  </table>
<br><br> 

<form action="index.php" method="post" target="_blank">
  <table>  
    <tr>
      <td>Restaurant</td><td><select id="res_id" name="res_id"></select></td>
    </tr>      
    <tr>
      <td>Qr Code</td><td><input id="qr_id" name="qr_id"></td>
    </tr>  
    <tr>
      <td>User Id</td><td><input id="user_id" name="user_id"></td>
    </tr>   
    <tr>
      <td colspan=2>getresuser</td>
    </tr>     
    <tr>
      <td>Res User Name</td><td><input id="res_user" name="res_user"></td>
    </tr> 
    <tr>
      <td>Res User Password</td><td><input id="res_password" name="res_password"></td>
    </tr>               
    <tr>   
      <td>Func</td><td><select name="func"><option>getresfoodtype</option><option>getresfoodmenu</option><option>getresbeveragemenu</option>
      <option>getorderqrcode</option><option>getresuser</option><option>insertorderfromqr</option><option>getuserorder</option><option>getresorder</option>
    </select><input type="submit"></td>
    </tr>        
  
  </table>  
</form>
<br><br> 
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $.getJSON('settings.php',function(data)
    {
      var dbname = data.dbname;
      if (dbname == 'dimchoi')
      {
        $("#dbname_1").attr('checked', 'checked');
      }
      else if (dbname == 'dimchoi_prod')
      {
        $("#dbname_2").attr('checked', 'checked');
      }             
    }); 

$(document).ready(function()
{ 

var res_id = $('#res_id');
var res_code = $('#res_code');
res_id.empty();
res_id.append("<option></option>"); 

$.getJSON('data/res.php',function(data)
  {
  $.each(data.data, function(i, restaurant)
    {
      res_id.append($("<option></option>")
      .attr("value",restaurant.i_res_id)
      .text(restaurant.va_res_name+' - '+restaurant.va_res_code));
    });
  })
});
</script>




