<?php
include "system/function.php";

function updateres() 
{
    global $dbhandler0;
//=============================================== 
//define variable for query

    $resid = !empty($_POST['resid']) ? $_POST['resid'] : '';
    $resname = !empty($_POST['resname']) ? $_POST['resname'] : '';
    $reslogo = !empty($_POST['reslogo']) ? $_POST['reslogo'] : '';
    $rescode = !empty($_POST['rescode']) ? $_POST['rescode'] : '';   
    $resfeature = !empty($_POST['resfeature']) ? $_POST['resfeature'] : ''; 
    $featuread = !empty($_POST['featuread']) ? $_POST['featuread'] : '';     
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $state = !empty($_POST['state']) ? $_POST['state'] : '';
    $menucode = !empty($_POST['menucode']) ? $_POST['menucode'] : '';
//===============================================  

    $sqlcheck = 
    "UPDATE restaurant 
    SET va_res_name = '$resname',
    va_res_logo = '$reslogo', 
    va_res_code = '$rescode',
    i_feature = '$resfeature',
    va_feature_ad = '$featuread',
    i_city_id = (SELECT i_city_id FROM city WHERE va_city_name='$city' LIMIT 1),
    i_state_id = (SELECT i_state_id FROM state_city WHERE i_city_id=(SELECT i_city_id FROM city WHERE va_city_name='$city' LIMIT 1) LIMIT 1)
    where i_res_id = $resid";
    $res = $dbhandler0->update($sqlcheck);

    "UPDATE menu 
    SET va_menu_code = '$menucode'
    where i_res_id = $resid";
    $res = $dbhandler0->update($sqlcheck);
    return;
//=======================================================
}
function updateuser() {
    global $dbhandler0;

    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : '';
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : '';
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : '';
    $email = !empty($_POST['email']) ? $_POST['email'] : '';
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : '';
    $facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : '';
    $google = !empty($_POST['google']) ? $_POST['google'] : '';    
    $userid = !empty($_POST['btnupdateuser']) ? $_POST['btnupdateuser'] : ''; 

    $sqlcheck = 
    "UPDATE user
    set va_first_name = '$firstname',
    va_last_name ='$lastname',    
    va_gender ='$gender',
    va_phone ='$phone',
    dt_dob ='$dob',
    va_email ='$email',
    va_pass ='$pass',
    va_facebook ='$facebook',
    va_google ='$google'
    where i_user_id = '$userid'";

    $res = $dbhandler0->update($sqlcheck);

    header('Location:'.$_POST['uri']);
}
function updatefood() 
{
    global $dbhandler0;
    $foodid=$_POST['food_id'];
    $priceid=$_POST['food_price_id'];

    $foodname=$_POST['food_name'][$foodid][$priceid];
    $fooddesc=$_POST['food_desc'][$foodid][$priceid];
    $foodsize=$_POST['food_size'][$priceid];   
    $foodprize=$_POST['food_price'][$priceid];        
    $foodtype=$_POST['food_type'][$priceid]; 
    $foodurl=$_POST['food_pic_url'][$priceid]; 
//=============================================== 
//define variable for query
 

//===============================================  

 $sqlcheck = 
    "UPDATE food 
    SET va_food_name = '$foodname', i_food_type_id = '$foodtype',va_food_pic_url = '$foodurl',va_food_desc = '$fooddesc'
    where i_food_id = $foodid";
    $res = $dbhandler0->update($sqlcheck);
 $sqlcheck1 = 
    "UPDATE food_price 
    SET va_food_size = '$foodsize',d_food_price = $foodprize
    where i_price_id = $priceid";
    $res1 = $dbhandler0->update($sqlcheck1);

    if ($res && $res1){
        header('Location:'.$_POST['uri']);
    }




//=======================================================
}

function updatebev() 
{
    global $dbhandler0;
    $bevid=$_POST['bev_id'];
    $priceid=$_POST['bev_price_id'];

    $bevname=$_POST['bev_name'][$bevid][$priceid];
    $bevdesc=$_POST['bev_desc'][$bevid][$priceid];
    $bevsize=$_POST['bev_size'][$priceid];   
    $bevprize=$_POST['bev_price'][$priceid];        
    $bevtype=$_POST['bev_type'][$priceid]; 
    $bevurl=$_POST['bev_pic_url'][$priceid];
//=============================================== 
//define variable for query
 

//===============================================  

 $sqlcheck = 
    "UPDATE bev 
    SET va_bev_name = '$bevname', i_bev_type_id = '$bevtype',va_bev_pic_url = '$bevurl' , va_bev_desc='$bevdesc'
    where i_bev_id = $bevid";
    $res = $dbhandler0->update($sqlcheck);
 $sqlcheck1 = 
    "UPDATE bev_price 
    SET va_bev_size = '$bevsize',d_bev_price = $bevprize
    where i_price_id = $priceid";
    $res1 = $dbhandler0->update($sqlcheck1);

    if ($res && $res1){
        header('Location:'.$_POST['uri']);
    }




//=======================================================
}
?>