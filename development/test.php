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

<style>
table, th, td {
    width:50%;
}
</style>

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
<table>
<tr><td colspan=3 style="background-color:red;"><h1>query</h1></td></tr> 

<tr>
  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getres</h2></td></tr> 
    <tr><td>resid</td><td><input type="text" name="resid"></td></tr>    
    <tr><td>state</td><td><input type="text" name="state"></td></tr>
    <tr><td>city</td><td><input type="text" name="city"></td>
    </tr><tr><td>ressearch</td><td><input type="text" name="ressearch"></td></tr>
    <tr><td>total</td><td><input type="text" name="total"></td></tr>
    <tr><td>startfrom</td><td><input type="text" name="startfrom"></td></tr> 
    <tr><td><input type="radio" name="feature" value=1></td><td>feature 1</td></tr> 
    <tr><td><input type="radio" name="feature" value=2></td><td>feature 2</td></tr> 
    <tr><tr><td>area</td><td><input type="text" name="area"></td></tr>      
    <td colspan=2><input type="submit" name="func" value="getres"></td>
    </table>
    </form>
  </td>
  <td>
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getresbyfeature</h2></td></tr>   
    <tr><td>state</td><td><input type="text" name="state"></td></tr>
    <tr><td>city</td><td><input type="text" name="city"></td></tr>
    <tr><td>ressearch</td><td><input type="text" name="ressearch"></td></tr>
    <tr><td>total</td><td><input type="text" name="total"></td></tr>
    <tr> <td>startfrom/td><td><input type="text" name="startfrom"></td></tr> 
    <tr><td><input type="radio" name="feature" value=1></td><td>feature 1</td></tr> 
    <tr><td><input type="radio" name="feature" value=2></td><td>feature 2</td></tr> 
    <tr><td colspan=2><input type="submit" name="func" value="getresbyfeature"></td>
    </table>
    </form>
  </td>
  <td>
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getresbylocation</h2></td></tr>   
    <tr><td>state</td><td><input type="text" name="state"></td></tr>
    <tr><td>city</td><td><input type="text" name="city"></td></tr>
    <tr><td>ressearch</td><td><input type="text" name="ressearch"></td></tr>
    <tr><td>total</td><td><input type="text" name="total"></td></tr>
    <tr><td>startfrom</td><td><input type="text" name="startfrom"></td></tr> 
    <tr><td><input type="radio" name="feature" value=1></td><td>feature 1</td></tr> 
    <tr><td><input type="radio" name="feature" value=2></td><td>feature 2</td></tr> 
    <tr><td colspan=2><input type="submit" name="func" value="getresbylocation"></td>
    </table>
    </form>
  </td>
</tr>

<tr>
  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getresfoodmenu</h2></td></tr> 
    <tr><td>res_id</td><td><select id="res_id1" name="res_id"></select></td></tr>     
    <td colspan=2><input type="submit" name="func" value="getresfoodmenu"></td>
    </table>
    </form>
  </td>
  <td>
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getorderqrcode</h2></td></tr> 
    <tr><td>res_id</td><td><select id="res_id2" name="res_id"></select></td></tr>  
    <tr><td>qr_id</td><td><input name="qr_id"></td></tr>
    <tr><td>user_id</td><td><input name="user_id"></td></tr>
    <td colspan=2><input type="submit" name="func" value="getorderqrcode"></td>
    </table>
    </form>
  </td>
  <td>
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getresuser</h2></td></tr> 
    <tr><td>res_user</td><td><input id="res_user" name="res_user"></td></tr>  
    <tr><td>res_password</td><td><input id="res_password" name="res_password"></td></tr>
    <td colspan=2><input type="submit" name="func" value="getresuser"></td>
    </table>
    </form>
  </td>
</tr>

<tr>
  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getuserorder</h2></td></tr> 
    <tr><td>user_id</td><td><input name="user_id"></td></tr>
    <tr><td>user_order_id</td><td><input name="user_order_id"></td></tr>  
    <td colspan=2><input type="submit" name="func" value="getuserorder"></td>
    </table>
    </form>
  </td>
  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>getresorder</h2></td></tr> 
    <tr><td>res_id</td><td><select id="res_id3" name="res_id"></select></td></tr> 
    <tr><td>res_order_id</td><td><input name="res_order_id"></td></tr> 
    <tr><td>res_order_status</td><td><input name="res_order_status"></td></tr>  
    <td colspan=2><input type="submit" name="func" value="getresorder"></td>
    </table>
    </form>
  </td>
  <td>
    &nbsp;
  </td>
</tr>

<tr><td colspan=3 style="background-color:red;"><h1>insert</h1></td></tr>
<tr> 
  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>insertorderfromqr</h2></td></tr> 
    <tr><td>qr_id</td><td><input name="qr_id"></td></tr>
    <tr><td>res_order_table</td><td><input name="res_order_table"></td></tr>
    <td colspan=2><input type="submit" name="func" value="insertorderfromqr"></td>
    </table>
    </form>
  </td>
</tr>

<tr><td colspan=3 style="background-color:red;"><h1>update</h1></td></tr> 
<tr>
  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>updateresorderstatus</h2></td></tr> 
    <tr><td>res_order_id</td><td><input name="res_order_id"></td></tr> 
    <tr><td>res_order_status</td><td><input name="res_order_status"></td></tr>  
    <td colspan=2><input type="submit" name="func" value="updateresorderstatus"></td>
    </table>
    </form>
  </td>

  <td> 
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>updateresordertable</h2></td></tr> 
    <tr><td>res_order_id</td><td><input name="res_order_id"></td></tr> 
    <tr><td>res_order_table</td><td><input name="res_order_table"></td></tr>  
    <td colspan=2><input type="submit" name="func" value="updateresordertable"></td>
    </table>
    </form>
  </td>

  <td>     
    <form action="index.php" method="post" target="_blank">
    <table>
    <tr><td><h2>updateqrdata</h2></td></tr> 
    <tr><td>qr_id</td><td><input name="qr_id"></td></tr> 
    <tr><td>qr_data_1</td><td><input name="qr_data_1"></td></tr>  
    <tr><td>qr_data_2</td><td><input name="qr_data_2"></td></tr>  
    <td colspan=2><input type="submit" name="func" value="updateqrdata"></td>
    </table>
    </form>
  </td>
</tr>
</table>


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

var res_id1 = $('#res_id1');
var res_id2 = $('#res_id2');
var res_id3 = $('#res_id3');
var res_code = $('#res_code');

res_id1.empty();
res_id1.append("<option></option>"); 
res_id2.empty();
res_id2.append("<option></option>"); 
res_id3.empty();
res_id3.append("<option></option>"); 
$.getJSON('data/res.php',function(data)
  {
  $.each(data.data, function(i, restaurant)
    {
      res_id1.append($("<option></option>")
      .attr("value",restaurant.i_res_id)
      .text(restaurant.va_res_name+' - '+restaurant.va_res_code));

      res_id2.append($("<option></option>")
      .attr("value",restaurant.i_res_id)
      .text(restaurant.va_res_name+' - '+restaurant.va_res_code));

      res_id3.append($("<option></option>")
      .attr("value",restaurant.i_res_id)
      .text(restaurant.va_res_name+' - '+restaurant.va_res_code));      
    });
  })
});
</script>




