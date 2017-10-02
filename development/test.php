<!DOCTYPE html>
<?php
global $dbhandler0;
    $dev = isset($_POST['dev']) ? $_POST['dev'] : '';
    if (!empty($dev) or $dev != 0)
    {   
        $sqlcheck = "UPDATE settings SET va_value = '$dev' WHERE va_name = 'dev'";
        $res = $dbhandler0->update($sqlcheck);
    }
    //===============================================
    $sqlcheck = "SELECT va_value
    FROM settings 
    where va_name = 'dev'";
    //===============================================
    $res = $dbhandler0->query($sqlcheck);
    $fp = fopen('settings.php', 'w');
    fwrite($fp, $res[0]['va_value']);
?>
<html>
<body>
  <h1>DATASOURCE SWITCHING</h1>
  <form action="development.php" method='post'>
  <input type="radio" name="dev" id="dev_1" value='{"dev":"1"}'> PROD test  
  <input type="radio" name="dev" id="dev_2" value='{"dev":"2"}'> PROD index (LIVE VERSION)  
  <input type="radio" name="dev" id="dev_3" value='{"dev":"3"}'> LOCAL test
  <br><br>
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
      <td>Func</td><td><select name="func"><option>getresfoodtype</option><option>getresfoodmenu</option><option>getresbeveragemenu</option>
      <option>getorderqrcode</option></select></td>
    </tr>        
  
    <tr>    
      <td colspan=2><input type="submit"></td>
    </tr>
  </table>  
</form>
<br><br> 
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function()
{
  $.getJSON('settings.php',function(data)
    {
      var settings = data.dev;
      if (settings == 1)
      {
        $("#dev_1").attr('checked', 'checked');
      }
      else if (settings == 2)
      {
        $("#dev_2").attr('checked', 'checked');
      }
      else if (settings == 3)
      {
        $("#dev_3").attr('checked', 'checked');
      }              
    });  

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




