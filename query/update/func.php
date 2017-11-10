<?php
include "system/function.php";

function updateres() 
{
    global $dbhandler0;
//=============================================== 
//define variable for query

    $resid = !empty($_POST['resid']) ? $_POST['resid'] : '';
    $resname = !empty($_POST['resname']) ? addslashes($_POST['resname']) : '';
    $resname=str_replace("'","\'", $resname);
    $reslogo = !empty($_POST['reslogo']) ? $_POST['reslogo'] : '';
    $rescode = !empty($_POST['rescode']) ? $_POST['rescode'] : '';   
    $add1 = !empty($_POST['add1']) ? $_POST['add1'] : '';
    $add2 = !empty($_POST['add2']) ? $_POST['add2'] : '';   
    $area = !empty($_POST['area']) ? $_POST['area'] : ''; 
    $lat = !empty($_POST['lat']) ? $_POST['lat'] : '0.0';
    $long = !empty($_POST['long']) ? $_POST['long'] : '0.0';   
    $desc = !empty($_POST['desc']) ? $_POST['desc'] : '';   
    $desc=str_replace("'","\'", $desc);
    $resfeature = !empty($_POST['resfeature']) ? $_POST['resfeature'] : ''; 
    $featuread = !empty($_POST['featuread']) ? $_POST['featuread'] : '';     
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $state = !empty($_POST['state']) ? $_POST['state'] : '';
    $menucode = !empty($_POST['menucode']) ? $_POST['menucode'] : '';
    $hqid = !empty($_POST['hqid']) ? $_POST['hqid'] : '';
    $ad = $_POST['ad'];
    if($lat == 0)
    {
        $lat = 0.0;
    }
    if($long == 0)
    {
        $long = 0.0;
    }

//===============================================  

    $sqlcheck = 
    "UPDATE restaurant 
    SET 
    i_hq_id = '$hqid',
    va_res_name = '$resname',
    va_res_logo = '$reslogo', 
    va_res_code = '$rescode',
    va_res_add1 = '$add1',
    va_res_add2 = '$add2',
    d_lat = '$lat',
    d_long ='$long',
    va_res_desc = '$desc',
    i_feature = '$resfeature',
    i_res_ad = '$ad',
    va_feature_ad = '$featuread',
    i_area_id = ifnull((SELECT i_area_id FROM area WHERE va_area_name='$area' LIMIT 1),NULL),
    i_city_id = (SELECT i_city_id FROM city WHERE va_city_name='$city' LIMIT 1),
    i_state_id = (SELECT i_state_id FROM city WHERE va_city_name='$city' LIMIT 1)
    where i_res_id = $resid";
    $res = $dbhandler0->update($sqlcheck);

    $sqlcheck = "UPDATE menu 
    SET va_menu_code = '$menucode'
    where i_res_id = $resid";
    $res = $dbhandler0->update($sqlcheck);
    return;
}
//=======================================================
function updateuser() {

    global $dbhandler0;
    $userid = !empty($_POST['userid']) ? $_POST['userid'] : ''; 

    $sqlcheckuser = "SELECT * FROM USER WHERE i_user_id = '$userid' LIMIT 1"; 
    $resuser = $dbhandler0->query($sqlcheckuser);

    if (!$resuser)
    {
        return $resuser;
    }
    else
    {    

    $firstname = !empty($_POST['firstname']) ? $_POST['firstname'] : $resuser[0]['va_first_name'];
    $lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $resuser[0]['va_last_name'];
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : $resuser[0]['va_gender'];
    $countrycode = !empty($_POST['countrycode']) ? $_POST['countrycode'] : $resuser[0]['va_country_code'];
    $phonecode = !empty($_POST['phonecode']) ? $_POST['phonecode'] : $resuser[0]['va_phone_code'];
    $phone = !empty($_POST['phone']) ? $_POST['phone'] : $resuser[0]['va_phone'];
    $dob = !empty($_POST['dob']) ? $_POST['dob'] : $resuser[0]['dt_dob'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $resuser[0]['va_email'];
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : $resuser[0]['va_pass'];
    $facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : $resuser[0]['va_facebook'];
    $google = !empty($_POST['google']) ? $_POST['google'] : $resuser[0]['va_google'];  
    $token = !empty($_POST['token']) ? $_POST['token'] : $resuser[0]['va_token'];  

    $sqlcheck = 
    "UPDATE user
    set va_first_name = '$firstname',
    va_last_name ='$lastname',    
    va_gender ='$gender',
    va_country_code = '$countrycode',
    va_phone_code = '$phonecode',
    va_phone ='$phone',
    dt_dob ='$dob',
    va_email ='$email',
    va_pass ='$pass',
    va_facebook ='$facebook',
    va_google ='$google',
    va_token = '$token'
    where i_user_id = '$userid'";

    $res = $dbhandler0->update($sqlcheck);

    return $res;
    }
}
//=======================================================
function updatefood() 
{
    global $dbhandler0;
    $foodid=$_POST['food_id'];
    $priceid=$_POST['food_price_id'];

    $foodname=$_POST['food_name'][$foodid][$priceid];
    $foodname=str_replace("'","\'", $foodname);
    $fooddesc=str_replace("'","\'", $_POST['food_desc'][$foodid][$priceid]);
    $foodsize=$_POST['food_size'][$priceid];   
    $foodprize=$_POST['food_price'][$priceid];        
    $foodtype=$_POST['food_type'][$priceid]; 
    $foodurl=$_POST['food_pic_url'][$priceid]; 
    $foodstatus=!empty($_POST['food_status'][$priceid]) ? 1 : 0; 
    $foodpricestatus=!empty($_POST['food_price_status'][$priceid]) ? 1 : 0; 
//=============================================== 
//define variable for query
//===============================================  
     $sqlcheck = 
        "UPDATE food 
        SET va_food_name = '$foodname', i_food_type_id = '$foodtype',va_food_pic_url = '$foodurl',va_food_desc = '$fooddesc',i_food_status='$foodstatus'
        where i_food_id = $foodid";
        $res = $dbhandler0->update($sqlcheck);
     $sqlcheck1 = 
        "UPDATE food_price 
        SET va_food_size = '$foodsize',d_food_price = $foodprize,i_food_price_status = '$foodpricestatus'
        where i_price_id = $priceid";
        $res1 = $dbhandler0->update($sqlcheck1);

        if ($res && $res1){
            header('Location:'.$_POST['uri']);
        }
}
//=======================================================
function updatebev() 
{
    global $dbhandler0;
    $bevid=$_POST['bev_id'];
    $priceid=$_POST['bev_price_id'];

    $bevname=$_POST['bev_name'][$bevid][$priceid];
    $bevname=str_replace("'","\'", $bevname);
    $bevdesc=str_replace("'","\'", $_POST['bev_desc'][$bevid][$priceid]);
    $bevsize=$_POST['bev_size'][$priceid];   
    $bevprize=$_POST['bev_price'][$priceid];        
    $bevtype=$_POST['bev_type'][$priceid]; 
    $bevurl=$_POST['bev_pic_url'][$priceid];
    $bevstatus=!empty($_POST['bev_status'][$priceid]) ? 1 : 0; 
    $bevpricestatus=!empty($_POST['bev_price_status'][$priceid]) ? 1 : 0; 
//=============================================== 
//define variable for query
//===============================================  
     $sqlcheck = 
        "UPDATE bev 
        SET va_bev_name = '$bevname', i_bev_type_id = '$bevtype',va_bev_pic_url = '$bevurl' , va_bev_desc='$bevdesc',i_bev_status='$bevstatus'
        where i_bev_id = $bevid";
        $res = $dbhandler0->update($sqlcheck);
     $sqlcheck1 = 
        "UPDATE bev_price 
        SET va_bev_size = '$bevsize',d_bev_price = $bevprize,i_bev_price_status = '$bevpricestatus'
        where i_price_id = $priceid";
        $res1 = $dbhandler0->update($sqlcheck1);

        if ($res && $res1){
            header('Location:'.$_POST['uri']);
        }
}
//=======================================================
function updateuser_dev() {

    global $dbhandler0;
    $userid = !empty($_POST['userid']) ? $_POST['userid'] : ''; 
    $firstname = !empty($_POST['firstname'][$userid]) ? $_POST['firstname'][$userid] : '';
    $lastname = !empty($_POST['lastname'][$userid]) ? $_POST['lastname'][$userid] : '';
    $gender = !empty($_POST['gender'][$userid]) ? $_POST['gender'][$userid] : '';
    $countrycode = !empty($_POST['countrycode'][$userid]) ? $_POST['countrycode'][$userid] : '';
    $phonecode = !empty($_POST['phonecode'][$userid]) ? $_POST['phonecode'][$userid] : '';
    $phone = !empty($_POST['phone'][$userid]) ? $_POST['phone'][$userid] : '';
    $dob = !empty($_POST['dob'][$userid]) ? $_POST['dob'][$userid] : '0000-00-00';
    $email = !empty($_POST['email'][$userid]) ? $_POST['email'][$userid] : '';
    $pass = !empty($_POST['pass'][$userid]) ? $_POST['pass'][$userid] : '';
    $facebook = !empty($_POST['facebook'][$userid]) ? $_POST['facebook'][$userid] : '';
    $google = !empty($_POST['google'][$userid]) ? $_POST['google'][$userid] : '';  
    $token = !empty($_POST['token'][$userid]) ? $_POST['token'][$userid] : '';  

    $sqlcheck = 
    "UPDATE user
    set va_first_name = '$firstname',
    va_last_name ='$lastname',    
    va_gender ='$gender',
    va_country_code = '$countrycode',
    va_phone_code = '$phonecode',
    va_phone ='$phone',
    dt_dob ='$dob',
    va_email ='$email',
    va_pass ='$pass',
    va_facebook ='$facebook',
    va_google ='$google',
    va_token = '$token'
    where i_user_id = '$userid'";

    $res = $dbhandler0->update($sqlcheck);

    header('Location:'.$_POST['uri']);
}
//=======================================================
function updatefood_dev() 
{
    global $dbhandler0;
    $priceid=$_POST['food_price_id'];
    $foodidlog1 = 0;
//=============================================== 
//define variable for query
//===============================================

        foreach(  $_POST['foodpriceidloop'] as $loopfoodpriceid ) 
        {
            $foodid=$_POST['foodidloop'][$loopfoodpriceid];  
            $foodname=$_POST['food_name'][$loopfoodpriceid];
            $foodname=str_replace("'","\'", $foodname);
            $fooddesc=str_replace("'","\'", $_POST['food_desc'][$loopfoodpriceid]);
            $foodsize=$_POST['food_size'][$loopfoodpriceid];   
            $foodprize=$_POST['food_price'][$loopfoodpriceid];        
            $foodtype=$_POST['food_type'][$loopfoodpriceid]; 
            $foodurl=$_POST['food_pic_url'][$loopfoodpriceid];
            $foodstatus=!empty($_POST['food_status'][$loopfoodpriceid]) ? 1 : 0; 
            $foodpricestatus=!empty($_POST['food_price_status'][$loopfoodpriceid]) ? 1 : 0; 
            if ($foodid<>$foodidlog1)
            {
            $sqlcheck = 
            "UPDATE food 
            SET va_food_name = '$foodname', i_food_type_id = '$foodtype',va_food_pic_url = '$foodurl',va_food_desc = '$fooddesc',i_food_status='$foodstatus'
            where i_food_id = (SELECT i_food_id FROM food_price where i_price_id=$loopfoodpriceid LIMIT 1)";
            $res = $dbhandler0->update($sqlcheck);
            $foodidlog1 = $foodid;
            }
            $sqlcheck1 = 
            "UPDATE food_price 
            SET va_food_size = '$foodsize',d_food_price = $foodprize,i_food_price_status = '$foodpricestatus'
            where i_price_id = $loopfoodpriceid";
            $res1 = $dbhandler0->update($sqlcheck1);
        }

        if ($res && $res1){
            header('Location:'.$_POST['uri']);
        }
}
//=======================================================
function updatebev_dev() 
{
    global $dbhandler0;
    $priceid=$_POST['bev_price_id'];
    $bevidlog1 = 0;
//=============================================== 
//define variable for query
//===============================================

        foreach(  $_POST['bevpriceidloop'] as $loopbevpriceid ) 
        {
            $bevid=$_POST['bevidloop'][$loopbevpriceid];  
            $bevname=$_POST['bev_name'][$loopbevpriceid];
            $bevname=str_replace("'","\'", $bevname);
            $bevdesc=str_replace("'","\'", $_POST['bev_desc'][$loopbevpriceid]);
            $bevsize=$_POST['bev_size'][$loopbevpriceid];   
            $bevprize=$_POST['bev_price'][$loopbevpriceid];        
            $bevtype=$_POST['bev_type'][$loopbevpriceid]; 
            $bevurl=$_POST['bev_pic_url'][$loopbevpriceid];
            $bevstatus=!empty($_POST['bev_status'][$loopbevpriceid]) ? 1 : 0; 
            $bevpricestatus=!empty($_POST['bev_price_status'][$loopbevpriceid]) ? 1 : 0; 
            if ($bevid<>$bevidlog1)
            {
            $sqlcheck = 
            "UPDATE bev 
            SET va_bev_name = '$bevname', i_bev_type_id = '$bevtype',va_bev_pic_url = '$bevurl',va_bev_desc = '$bevdesc',i_bev_status='$bevstatus'
            where i_bev_id = (SELECT i_bev_id FROM bev_price where i_price_id=$loopbevpriceid LIMIT 1)";
            $res = $dbhandler0->update($sqlcheck);
            $bevidlog1 = $bevid;
            }
            $sqlcheck1 = 
            "UPDATE bev_price 
            SET va_bev_size = '$bevsize',d_bev_price = $bevprize,i_bev_price_status='$bevpricestatus'
            where i_price_id = $loopbevpriceid";
            $res1 = $dbhandler0->update($sqlcheck1);
        }

        if ($res && $res1){
            header('Location:'.$_POST['uri']);
        }
}
//=======================================================
function updatefoodtype_dev() 
{
    global $dbhandler0;
    $foodtype_update = !empty($_POST['foodtype_update']) ? $_POST['foodtype_update'] : ''; 
    $foodtypename = !empty($_POST['foodtypename'][$foodtype_update]) ? $_POST['foodtypename'][$foodtype_update] : ''; 
    $foodpictypeurl = !empty($_POST['foodpictypeurl'][$foodtype_update]) ? $_POST['foodpictypeurl'][$foodtype_update] : ''; 
    $foodtypeorder = !empty($_POST['foodtypeorder'][$foodtype_update]) ? $_POST['foodtypeorder'][$foodtype_update] : 0; 
//=============================================== 
//define variable for query
//===============================================  
     $sqlcheck = 
        "UPDATE food_type 
        SET va_food_type_name = '$foodtypename', va_food_type_pic_url = '$foodpictypeurl',i_food_type_order = '$foodtypeorder'
        where i_food_type_id = $foodtype_update";

        $res = $dbhandler0->update($sqlcheck);

        if ($res){
            header('Location:'.$_POST['uri']);
        }
}
//=======================================================
function updatebevtype_dev() 
{
    global $dbhandler0;
    $bevtype_update = !empty($_POST['bevtype_update']) ? $_POST['bevtype_update'] : ''; 
    $bevtypename = !empty($_POST['bevtypename'][$bevtype_update]) ? $_POST['bevtypename'][$bevtype_update] : ''; 
    $bevpictypeurl = !empty($_POST['bevpictypeurl'][$bevtype_update]) ? $_POST['bevpictypeurl'][$bevtype_update] : ''; 
    $bevtypeorder = !empty($_POST['bevtypeorder'][$bevtype_update]) ? $_POST['bevtypeorder'][$bevtype_update] : 0;    
//=============================================== 
//define variable for query
//===============================================  
     $sqlcheck = 
        "UPDATE bev_type 
        SET va_bev_type_name = '$bevtypename', va_bev_type_pic_url = '$bevpictypeurl',i_bev_type_order = '$bevtypeorder'
        where i_bev_type_id = $bevtype_update";

        $res = $dbhandler0->update($sqlcheck);

        if ($res){
            header('Location:'.$_POST['uri']);
        }
}
//=======================================================
?>