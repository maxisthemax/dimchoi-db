<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="style/table_style.css">
</head>
<?php 
include "lib/db.php";
include "config.php";
include "getpath.php";
include "setvariable.php";
?>
<?php
session_start();
$_SESSION['file']='http://103.233.1.196/dimchoi/file/res/';
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
    <input type="submit" name="page" value="Qr Code" />
    <input type="submit" name="page" value="User" />    
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
  else if ($_POST['page'] == 'Qr Code')
    {
      $_SESSION['page'] = 'Qr Code';
    }    
  else if ($_POST['page'] == 'User')
    {
      $_SESSION['page'] = 'User';
    }     
}
if (!empty($_SESSION['page']) && $_SESSION['password']=="123qweasdzxc")
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
        case "Qr Code":
            include "development/qrcode.php";
            break;   
        case "User":
            include "development/user.php";
            break;                       
        }
}
?>