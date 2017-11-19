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
    <input type="submit" name="page" value="Food/Bev Type" />     
    <input type="submit" name="page" value="Qr Code" />
    <input type="submit" name="page" value="User Order" />
    <input type="submit" name="page" value="Res Order" />
    <input type="submit" name="page" value="User" />    
    <input type="submit" name="page" value="Restaurant User" />    
    <input type="submit" name="page" value="Firebase" />  
    <input type="button" onclick="window.location='https://drive.google.com/open?id=1OnPQu9JX-wyyBAeSzz8YLejGFIPcAheQMnHSQwQ2yp0'" value="API GUIDE"/>
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
<br><br>

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
  else if ($_POST['page'] == 'User Order')
    {
      $_SESSION['page'] = 'User Order';
    } 
  else if ($_POST['page'] == 'User')
    {
      $_SESSION['page'] = 'User';
    }  
  else if ($_POST['page'] == 'Res Order')
    {
      $_SESSION['page'] = 'Res Order';
    } 
  else if ($_POST['page'] == 'Food/Bev Type')
    {
      $_SESSION['page'] = 'Food/Bev Type';
    }    
  else if ($_POST['page'] == 'Firebase')
    {
      $_SESSION['page'] = 'Firebase';
    }  
  else if ($_POST['page'] == 'Restaurant User')
    {
      $_SESSION['page'] = 'Restaurant User';
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
        case "User Order":
            include "development/userorder.php";
            break; 
        case "Res Order":
            include "development/resorder.php";
            break;                            
        case "User":
            include "development/user.php";
            break;      
        case "Food/Bev Type":
            include "development/foodbevtype.php";
            break;   
        case "Firebase":
            include "development/firebase.php";
            break;   
        case "Restaurant User":
            include "development/resuser.php";
            break;                                                  
        }
}
?>