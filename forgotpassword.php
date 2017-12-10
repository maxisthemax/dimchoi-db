<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="style/table_style.css">
</head>
<?php 
include "lib/db.php";
include "config.php";
include "getpath.php";
include "setvariable.php";


    global $dbhandler0; 
    $forgottoken = $_GET['token'];
    $sql = "SELECT a.dt_create,a.i_token_expired,a.va_forgot_token,b.i_user_id FROM usertoken a LEFT JOIN user b on a.i_user_id = b.i_user_id where a.va_forgot_token = '$forgottoken'";
    $ressql  = $dbhandler0->query($sql);   
    $sqltoken = $ressql[0]['va_forgot_token'];
    $time = strtotime(date("Y-m-d H:i:s"));
    $expire_duration = $ressql[0]['i_token_expired'];
    $token_create = strtotime($ressql[0]['dt_create']);
    $user_id = $ressql[0]['i_user_id'];
    $diff = $time - $token_create;
    if ($diff > $expire_duration)
    {
        $expired = 1;
    } 
    else
    {
        $expired = 0;
    }         

    if (empty($_GET['token']) OR ($_GET['token'] != $sqltoken))
    {
        die("INVALID TOKEN");
    }
    else if ($expired == 1) {
        //die("TOKEN EXPIRED");
    }

?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style/password_style.css">
</head>
<body>
<div id="wrapper">
 <form method="post" action="index.php" id="login_form">
  <h1>RESET PASSWORD</h1>
        <input type="password" name="password" placeholder="Password" id="password" required>
        <input type="password" name="repassword" placeholder="Confirm Password" id="confirm_password" required>
        <input type="submit" name="submit_pass" value="DO SUBMIT">
        <input type="hidden" name="func" value="updateresetpassword">
        <?php echo "<input type=hidden name=userid value=".$user_id.">"; ?>
        <?php echo "<input type=hidden name=token value=".$_GET['token'].">"; ?>
 </form>

<br><br>

</div>
</body>
</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>