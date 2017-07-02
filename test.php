<!DOCTYPE html>
<html>
<body>

getallstateandcity
<form action="index.php" method="post" target="_blank">
  <input type="submit" name="func" value="getallstateandcity"><br>
</form>

<br><br>
<br><br>

getres
<form action="index.php" method="post" target="_blank">
  state <input type="text" name="state"><br><br>
  city <input type="text" name="city"><br><br>
  search <input type="text" name="ressearch"><br><br> 
  total <input type="text" name="total"><br><br>  
  start from <input type="text" name="startfrom"><br><br> 
  <input type="radio" name="feature" value=1>Feature 1<br>
  <input type="radio" name="feature" value=2>Feature 2<br>
  <input type="submit" name="func" value="getres">
</form>

<br><br>
<br><br>

insertnewres
<form action="index.php" method="post" target="_blank">
  new res name <input type="text" name="newres"><br><br>
  new res state <input type="text" name="state"><br><br>
  new res city <input type="text" name="city"><br>
  <input type="submit" name="func" value="insertnewres">
</form>

</body>
</html>
