<!DOCTYPE html>
<html>
<body>

getallstateandcity
<form action="index.php" method="post" target="_blank">
  <input type="submit" name="func" value="getallstateandcity"><br>
</form>
<br><br>
<br><br>
getcomp
<form action="index.php" method="post" target="_blank">
  state <input type="text" name="state"><br><br>
  city <input type="text" name="city"><br><br>
  search <input type="text" name="companysearch"><br><br> 
  total <input type="text" name="total"><br><br>  

  start from <input type="text" name="startfrom"><br><br> 

  <input type="radio" name="feature" value=1>Feature 1<br>
  <input type="radio" name="feature" value=2>Feature 2<br>

  <input type="submit" name="func" value="getcomp">
</form>
<br><br>
<br><br>
insertnewcomp
<form action="index.php" method="post" target="_blank">
  new company name <input type="text" name="newcomp"><br><br>
  new company state <input type="text" name="state"><br><br>
  new company city <input type="text" name="city"><br>
  <input type="submit" name="func" value="insertnewcomp">
</form>

</body>
</html>
