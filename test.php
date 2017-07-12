<!DOCTYPE html>
<html>
<body>
  <h1>DATASOURCE SWITCHING</h1>
  <form action="test.php" method='post'>
  <input type="radio" name="devoption" value='{"dev":"1"}'> PROD test  
  <input type="radio" name="devoption" value='{"dev":"3"}'> LOCAL test
  <br>
  <input type="radio" name="devoption" value='{"dev":"2"}'> PROD index (LIVE VERSION)
  <br><br>
  <input type='submit' value='SWITCH DB'>
  </form>
  <?php
  // Open the text file
  $f = fopen("settings.php", "w");
  // Write text
   if (!empty($_POST["devoption"]))
  {
    fwrite($f, $_POST["devoption"]);
  }
  // Close the text file
  fclose($f);
  ?>
 <br><br> 
<h1>DEBUGGING OPTION</h1>
getallstateandcity
<form action="index.php" method="post" target="_blank">
  <input type="submit" name="func" value="getallstateandcity"><br>
</form>
 <br><br> 
<form action="index.php" method="post" target="_blank">
  <table>
  <tr>
    <td>Function Name</td><td>getres</td>
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
  <td colspan=2><input type="submit" name="func" value="getres"></td>
  </table>
</form>
 <br><br> 
<form action="index.php" method="post" target="_blank">
  <table>
  <tr>
    <td>Function Name</td><td>getresbyfeature</td>
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




</body>
</html>



