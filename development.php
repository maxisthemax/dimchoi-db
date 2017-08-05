<!DOCTYPE html>
<?php
include "lib/db.php";
include "config.php";
include "getpath.php";
include "setvariable.php";
?>
<?php
session_start();

if(isset($_POST['submit_pass']) && $_POST['pass'])
{
 $pass=$_POST['pass'];
 if($pass=="123qweasdzxc")
 {
  $_SESSION['password']=$pass;
 }
 else
 {
  $error="Incorrect Pssword";
 }
}

if(isset($_POST['page_logout']))
{
 unset($_SESSION['password']);
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/password_style.css">
</head>
<body>
<div id="wrapper">

<?php
if (!isset($_SESSION['password']) || (trim($_SESSION['password']) == '')) {
  unset($_SESSION['password']);
  $_SESSION['password'] = '';
}
if($_SESSION['password']=="123qweasdzxc")
{
 ?>
 <form method="post" action="" id="logout_form">
  <input type="submit" name="page_logout" value="LOGOUT">
 </form>
 <form action="development.php" method="post" id='test_form'>
    <h1>DIMCHOI TEST PAGE</h1>
    <input type="submit" name="page" value="Main Test" />
    <input type="submit" name="page" value="Restaurant" />
    <input type="submit" name="page" value="Food" />
</form>
 <?php
}
else
{
 ?>
 <form method="post" action="" id="login_form">
  <h1>LOGIN TO DIMCHOI TEST</h1>
  <input type="password" name="pass" placeholder="*******">
  <input type="submit" name="submit_pass" value="DO SUBMIT">
 </form>
 <?php  
}
?>

</div>
</body>
</html>


<?php
if (!empty($_POST['page']))
{
  if ($_POST['page'] == 'Food')
    {
      $_SESSION['page'] = 'Food';
    }
  else if ($_POST['page'] == 'Main Test')
    {
      $_SESSION['page'] = 'Main Test';
    }
  else if ($_POST['page'] == 'Restaurant')
    {
      $_SESSION['page'] = 'Restaurant';
    }
}
if (!empty($_SESSION['page']))
{
    switch($_SESSION['page']){
        case "Main Test":
            include "development/test.php";
            break;
        case "Restaurant":
            include "development/restaurant.php";
            break;
        case "Food":
            include "development/food.php";
            break;
        }
}
?>