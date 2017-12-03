<?php

//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateres_dev() 
{   
    global $dbhandler0;
//=============================================== 
//define variable for query

    $res_id = !empty($_POST['res_id']) ? $_POST['res_id'] : '';
    $res_name = !empty($_POST['res_name']) ? addslashes($_POST['res_name']) : '';
    $res_name=str_replace("'","\'", $res_name);
    $res_logo = !empty($_POST['res_logo']) ? $_POST['res_logo'] : '';
    $res_code = !empty($_POST['res_code']) ? $_POST['res_code'] : '';   
    $res_add1 = !empty($_POST['res_add1']) ? $_POST['res_add1'] : '';
    $res_add2 = !empty($_POST['res_add2']) ? $_POST['res_add2'] : '';   
    $res_area = !empty($_POST['res_area']) ? $_POST['res_area'] : ''; 
    $res_lat = !empty($_POST['res_lat']) ? $_POST['res_lat'] : '0.0';
    $res_long = !empty($_POST['res_long']) ? $_POST['res_long'] : '0.0';   
    $res_desc = !empty($_POST['res_desc']) ? $_POST['res_desc'] : '';   
    $res_desc=str_replace("'","\'", $res_desc);
    $res_feature = !empty($_POST['res_feature']) ? $_POST['res_feature'] : ''; 
    $res_featuread = !empty($_POST['res_featuread']) ? $_POST['res_featuread'] : '';     
    $res_city = !empty($_POST['res_city']) ? $_POST['res_city'] : '';
    $res_state = !empty($_POST['res_state']) ? $_POST['res_state'] : '';
    $res_menucode = !empty($_POST['res_menucode']) ? $_POST['res_menucode'] : '';
    $res_hqid = !empty($_POST['res_hqid']) ? $_POST['res_hqid'] : '';
    $res_ad = $_POST['res_ad'];
    if($res_lat == 0)
    {
        $res_lat = 0.0;
    }
    if($res_long == 0)
    {
        $res_long = 0.0;
    }

//===============================================  

    $sqlcheck = 
    "UPDATE restaurant 
    SET 
    i_hq_id = '$res_hqid',
    va_res_name = '$res_name',
    va_res_logo = '$res_logo', 
    va_res_code = '$res_code',
    va_res_add1 = '$res_add1',
    va_res_add2 = '$res_add2',
    d_lat = '$res_lat',
    d_long ='$res_long',
    va_res_desc = '$res_desc',
    i_feature = '$res_feature',
    i_res_ad = '$res_ad',
    va_feature_ad = '$res_featuread',

    i_area_id = ifnull((SELECT i_area_id FROM area WHERE va_area_name='$res_area' LIMIT 1),NULL),
    i_city_id = ifnull((SELECT i_city_id FROM area WHERE va_area_name='$res_area' LIMIT 1),NULL),
    i_state_id = (SELECT i_state_id FROM city WHERE i_city_id=(SELECT i_city_id FROM area WHERE va_area_name='$res_area' LIMIT 1) LIMIT 1)

    where i_res_id = $res_id";
    $res1 = $dbhandler0->update($sqlcheck);

    $sqlcheck = "UPDATE menu 
    SET va_menu_code = '$res_menucode'
    where i_res_id = $res_id";
    $res2 = $dbhandler0->update($sqlcheck);

    if ($res1 && $res2){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
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
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
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
            $foodcode=$_POST['food_code'][$loopfoodpriceid]; 

            $foodorder=$_POST['food_order'][$loopfoodpriceid]; 
            $foodpriceorder=$_POST['food_price_order'][$loopfoodpriceid];

            if ($foodid<>$foodidlog1)
            {
            $sqlcheck = 
            "UPDATE food 
            SET va_food_name = '$foodname', i_food_type_id = '$foodtype',va_food_pic_url = '$foodurl',va_food_desc = '$fooddesc',i_food_status='$foodstatus',
            i_food_order = '$foodorder',va_food_code = '$foodcode'
            where i_food_id = (SELECT i_food_id FROM food_price where i_price_id=$loopfoodpriceid LIMIT 1)";
            $res = $dbhandler0->update($sqlcheck);
            $foodidlog1 = $foodid;
            }
            $sqlcheck1 = 
            "UPDATE food_price 
            SET va_food_size = '$foodsize',d_food_price = $foodprize,i_food_price_status = '$foodpricestatus',i_food_price_order = '$foodpriceorder'
            where i_price_id = $loopfoodpriceid";
            $res1 = $dbhandler0->update($sqlcheck1);
        }

        if ($res && $res1){
            header('Location:'.$_POST['uri']);
        }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
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
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updaterestypetable_dev() 
{
    global $dbhandler0;
    $restypeid_update = !empty($_POST['res_type_submit']) ? $_POST['res_type_submit'] : '';

    $res_type_name = !empty($_POST['res_type_name'][$restypeid_update]) ? $_POST['res_type_name'][$restypeid_update] : ''; 
    $res_type_bit = !empty($_POST['res_type_bit'][$restypeid_update]) ? $_POST['res_type_bit'][$restypeid_update] : ''; 

    $sqlcheck = 
    "UPDATE res_type 
    SET i_res_type_bit = '$res_type_bit', va_res_type_name = '$res_type_name'
    where i_res_type_id = $restypeid_update";

    $res = $dbhandler0->update($sqlcheck);

    if ($res){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updaterestype_dev() 
{
    global $dbhandler0;
    $bit = 0;
    $res_id_update = !empty($_POST['resid']) ? $_POST['resid'] : '';

    foreach ($_POST['checked'] as $value)
    {
        $bit = $bit + $value;
    }

    if ($res_id_update > 0 AND $bit > 0)
    {
    $sqlcheck = 
    "UPDATE restaurant 
    SET i_res_type_bit = $bit 
    where i_res_id = $res_id_update";

    $res = $dbhandler0->update($sqlcheck);
    }

    if ($res){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateressettingtable_dev() 
{
    global $dbhandler0;
    $ressettingid_update = !empty($_POST['res_setting_submit']) ? $_POST['res_setting_submit'] : '';

    $res_setting_name = !empty($_POST['res_setting_name'][$ressettingid_update]) ? $_POST['res_setting_name'][$ressettingid_update] : ''; 
    $res_setting_bit = !empty($_POST['res_setting_bit'][$ressettingid_update]) ? $_POST['res_setting_bit'][$ressettingid_update] : ''; 

    $sqlcheck = 
    "UPDATE res_setting 
    SET i_res_setting_bit = '$res_setting_bit', va_res_setting_name = '$res_setting_name'
    where i_res_setting_id = $ressettingid_update";

    $res = $dbhandler0->update($sqlcheck);

    if ($res){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateressetting_dev() 
{
    global $dbhandler0;
    $bit = 0;
    $res_id_update = !empty($_POST['resid']) ? $_POST['resid'] : '';

    foreach ($_POST['checked'] as $value)
    {
        $bit = $bit + $value;
    }

    if ($res_id_update > 0 AND $bit > 0)
    {
    $sqlcheck = 
    "UPDATE restaurant 
    SET i_res_setting_bit = $bit 
    where i_res_id = $res_id_update";

    $res = $dbhandler0->update($sqlcheck);
    }

    if ($res){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresamenitiestable_dev() 
{
    global $dbhandler0;
    $resamenitiesid_update = !empty($_POST['res_amenities_submit']) ? $_POST['res_amenities_submit'] : '';

    $res_amenities_name = !empty($_POST['res_amenities_name'][$resamenitiesid_update]) ? $_POST['res_amenities_name'][$resamenitiesid_update] : ''; 
    $res_amenities_bit = !empty($_POST['res_amenities_bit'][$resamenitiesid_update]) ? $_POST['res_amenities_bit'][$resamenitiesid_update] : ''; 

    $sqlcheck = 
    "UPDATE res_amenities 
    SET i_res_amenities_bit = '$res_amenities_bit', va_res_amenities_name = '$res_amenities_name'
    where i_res_amenities_id = $resamenitiesid_update";

    $res = $dbhandler0->update($sqlcheck);

    if ($res){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function updateresamenities_dev() 
{
    global $dbhandler0;
    $bit = 0;
    $res_id_update = !empty($_POST['resid']) ? $_POST['resid'] : '';

    foreach ($_POST['checked'] as $value)
    {
        $bit = $bit + $value;
    }

    if ($res_id_update > 0 AND $bit > 0)
    {
    $sqlcheck = 
    "UPDATE restaurant 
    SET i_res_amenities_bit = $bit 
    where i_res_id = $res_id_update";

    $res = $dbhandler0->update($sqlcheck);
    }

    if ($res){
        header('Location:'.$_POST['uri']);
    }
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
?>