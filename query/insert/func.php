<?php
/*
getallstateandcity
------------------
variable    = none
usage       = to get all state and city from db 

getRes
------------------
variable    = state,city,ressearch
usage       = to get restaurant with speicific query string

*/
include "system/function.php";
//===================================================
//insert new restaurant
function insertnewres() {
    global $dbhandler0;
    $resname_new = !empty($_POST['resname_new']) ? $_POST['resname_new'] : '';
    $rescode_new = !empty($_POST['rescode_new']) ? $_POST['rescode_new'] : '';
    $reslogo_new = !empty($_POST['reslogo_new']) ? $_POST['reslogo_new'] : '';
    $area_new = !empty($_POST['area_new']) ? $_POST['area_new'] : '1';
    $menucode_new = !empty($_POST['menucode_new']) ? $_POST['menucode_new'] : '';
    $todaydate = date("Y-m-d H:i:s");

    if (empty($resname_new))
    {
        return false;
    }
    $reslogo_new = 'http://103.233.1.196/dimchoi/file/res/'.$rescode_new.'/logo.jpg';
    //start query for same name  
    $sqlcheck = 
        "SELECT a.i_res_id,a.va_res_name
        FROM restaurant a
        WHERE a.va_res_name = '$resname_new'";
        $res = $dbhandler0->query($sqlcheck);
    //================================================== 

        if (empty($res))
        {
            //start insert  
                $sqlcheck = 
                "INSERT INTO restaurant (
                i_hq_id,    
                va_res_name,
                va_res_code,
                va_res_add1,
                va_res_add2,
                d_lat,
                d_long,
                i_area_id,
                i_city_id,
                i_state_id,
                i_res_stat, 
                va_res_logo,va_res_desc
                )
                VALUES (
                '0',
                '$resname_new',
                '$rescode_new','','',0,0,
                (SELECT i_area_id FROM area WHERE i_area_id='$area_new' LIMIT 1), 
                (SELECT i_city_id FROM city WHERE i_city_id=(SELECT i_city_id FROM area WHERE i_area_id='$area_new' LIMIT 1) LIMIT 1),                
                (SELECT i_state_id FROM state WHERE i_state_id =(SELECT i_state_id FROM city WHERE i_city_id=(SELECT i_city_id FROM area WHERE i_area_id='$area_new' LIMIT 1) LIMIT 1) LIMIT 1),1,
                '$reslogo_new','')";
                $res = $dbhandler0->insert($sqlcheck);
                $last_id = $res;
                if (!empty($last_id)) 
                {
                $sqlcheck = 
                "INSERT INTO menu (
                i_res_id,
                va_menu_code)
                VALUES (
                '$last_id',
                '$menucode_new')";
                $res = $dbhandler0->insert($sqlcheck);
                $createfolder = getcwd().'/file/res/'.$rescode_new;
                mkdir($createfolder, 0777, true);
                return ($res);
                }
            //=================================================== 
        }
}
//====================================================================================================== 
function insertnewfood() {
    global $dbhandler0;
    $inserttypefood = !empty($_POST['inserttypefood']) ? $_POST['inserttypefood'] : '';
    $food_name_new = !empty($_POST['food_name_new']) ? $_POST['food_name_new'] : '';
    $food_name_update = !empty($_POST['food_name_update']) ? $_POST['food_name_update'] : '';
    $resid_insert = !empty($_POST['resid_insert']) ? $_POST['resid_insert'] : '';
    $resname_insert = !empty($_POST['resname_insert']) ? $_POST['resname_insert'] : '';
    $menucode_insert = !empty($_POST['menucode_insert']) ? $_POST['menucode_insert'] : '';
    $food_type_new = !empty($_POST['food_type_new']) ? $_POST['food_type_new'] : ''; 
    $food_size_new = !empty($_POST['food_size_new']) ? $_POST['food_size_new'] : ''; 
    $food_price_new = !empty($_POST['food_price_new']) ? $_POST['food_price_new'] : ''; 
    $total_rows = count($_POST['food_size_new']); 

    $sqlcheck = 
        "SELECT a.*
        FROM menu a
        LEFT JOIN food c on a.i_menu_id = c.i_menu_id
        LEFT JOIN restaurant b on b.va_res_code = a.va_menu_code
        WHERE b.va_res_name = '$resname_insert' AND b.i_res_id='$resid_insert' AND a.va_menu_code = '$menucode_insert'"; 

        if ($inserttypefood == 1)
        {
        $sqlcheck .= "AND c.va_food_name = '$food_name_new'";
        }
        else if ($inserttypefood == 2)
        {
        $sqlcheck .= "AND c.i_food_id = '$food_name_update'";    
        }
        $res = $dbhandler0->query($sqlcheck);
    if (empty($res) AND $inserttypefood == 1)
        {
            //start insert  
                $sqlcheck = 
                "INSERT INTO food (
                i_menu_id,    
                va_food_name,
                va_food_desc,
                i_food_type_id, 
                va_food_pic_url)
                VALUES (
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insert' LIMIT 1),
                '$food_name_new',
                '',
                '$food_type_new','')";

                $res = $dbhandler0->insert($sqlcheck);
                $last_id = $res;

        for ($i=1; $i<=$total_rows; $i++)
                {
                $a=$food_size_new[$i];
                $b=$food_price_new[$i];   

                $sqlcheck2 = 
                "INSERT INTO food_price (
                i_food_id,    
                i_menu_id,
                va_food_size, 
                d_food_price)
                VALUES (
                '$last_id',
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insert' LIMIT 1),
                '$a',
                '$b')";

                 $res1 = $dbhandler0->insert($sqlcheck2);
            //===================================================
                }
        }
    else
    {
        for ($i=1; $i<=$total_rows; $i++)
                {
                $a=$food_size_new[$i];
                $b=$food_price_new[$i];   

                $sqlcheck2 = 
                "INSERT INTO food_price (
                i_food_id,    
                i_menu_id,
                va_food_size, 
                d_food_price)
                VALUES (
                '$food_name_update',
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insert' LIMIT 1),
                '$a',
                '$b')"; 
                 $res1 = $dbhandler0->insert($sqlcheck2);
            //===================================================
                }        
    }  


        header('Location:'.$_POST['uri']);
       
}
//====================================================================================================== 
function insertnewbev() {
    global $dbhandler0;
    $inserttypebev = !empty($_POST['inserttypebev']) ? $_POST['inserttypebev'] : '';
    $bev_name_new = !empty($_POST['bev_name_new']) ? $_POST['bev_name_new'] : '';
    $bev_name_update = !empty($_POST['bev_name_update']) ? $_POST['bev_name_update'] : '';
    $resid_insertbev = !empty($_POST['resid_insertbev']) ? $_POST['resid_insertbev'] : '';
    $resname_insertbev = !empty($_POST['resname_insertbev']) ? $_POST['resname_insertbev'] : '';
    $menucode_insertbev = !empty($_POST['menucode_insertbev']) ? $_POST['menucode_insertbev'] : '';
    $bev_type_new = !empty($_POST['bev_type_new']) ? $_POST['bev_type_new'] : ''; 
    $bev_size_new = !empty($_POST['bev_size_new']) ? $_POST['bev_size_new'] : ''; 
    $bev_price_new = !empty($_POST['bev_price_new']) ? $_POST['bev_price_new'] : ''; 
    $total_rows = count($_POST['bev_size_new']); 

    $sqlcheck = 
        "SELECT a.*
        FROM menu a
        LEFT JOIN bev c on a.i_menu_id = c.i_menu_id
        LEFT JOIN restaurant b on b.va_res_code = a.va_menu_code
        WHERE b.va_res_name = '$resname_insert1' AND b.i_res_id='$resid_insertbev' AND a.va_menu_code = '$menucode_insertbev'"; 

        if ($inserttypebev == 1)
        {
        $sqlcheck .= "AND c.va_bev_name = '$bev_name_new'";
        }
        else if ($inserttypebev == 2)
        {
        $sqlcheck .= "AND c.i_bev_id = '$bev_name_update'";    
        }
        $res = $dbhandler0->query($sqlcheck);
    if (empty($res) AND $inserttypebev == 1)
        {
            //start insert  
                $sqlcheck = 
                "INSERT INTO bev (
                i_menu_id,    
                va_bev_name,
                va_bev_desc,
                i_bev_type_id, 
                va_bev_pic_url)
                VALUES (
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insertbev' LIMIT 1),
                '$bev_name_new',
                '',
                '$bev_type_new','')";

                $res = $dbhandler0->insert($sqlcheck);
                $last_id = $res;

        for ($i=1; $i<=$total_rows; $i++)
                {
                $a=$bev_size_new[$i];
                $b=$bev_price_new[$i];   

                $sqlcheck2 = 
                "INSERT INTO bev_price (
                i_bev_id,    
                i_menu_id,
                va_bev_size, 
                d_bev_price)
                VALUES (
                '$last_id',
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insertbev' LIMIT 1),
                '$a',
                '$b')";


                 $res1 = $dbhandler0->insert($sqlcheck2);
            //===================================================
                }
        }
    else
    {
        for ($i=1; $i<=$total_rows; $i++)
                {
                $a=$bev_size_new[$i];
                $b=$bev_price_new[$i];   

                $sqlcheck2 = 
                "INSERT INTO bev_price (
                i_bev_id,    
                i_menu_id,
                va_bev_size, 
                d_bev_price)
                VALUES (
                '$bev_name_update',
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insertbev' LIMIT 1),
                '$a',
                '$b')"; 
                 $res1 = $dbhandler0->insert($sqlcheck2);
            //===================================================
                }        
    }  


        header('Location:'.$_POST['uri']);
       
}
//====================================================================================================== 
function insertnewqrcoderow() {
    global $dbhandler0;

    $qrdatanew1 = !empty($_POST['qrdatanew1']) ? $_POST['qrdatanew1'] : '';
    $qrdatanew2 = !empty($_POST['qrdatanew2']) ? $_POST['qrdatanew2'] : '';
    $qrtypenew = !empty($_POST['qrtypenew']) ? $_POST['qrtypenew'] : '';
    $resid_insert = !empty($_POST['resid_insert']) ? $_POST['resid_insert'] : '';
    $userid_insert = !empty($_POST['userid_insert']) ? $_POST['userid_insert'] : '';

    $sqlcheck = 
    "INSERT INTO qrcode (
    i_res_id,
    i_user_id,
    i_qr_type_id,    
    va_qr_data_1,
    va_qr_data_2)
    VALUES (
    '$resid_insert',
    '$userid_insert',
    '$qrtypenew',
    '$qrdatanew1',
    '$qrdatanew2')";

    $res = $dbhandler0->insert($sqlcheck);
    $last_id = $res;

    $sqlqrcode = "SELECT * FROM qrcode WHERE i_qr_id = '$last_id' LIMIT 1";    
    $resqrcode = $dbhandler0->query($sqlqrcode);
    
    $finalresult = array (
        'i_res_id' => $resqrcode[0]['i_res_id'],
        'i_qr_id' => $last_id
            );
    return $finalresult;
}
//====================================================================================================== 
function insertnewuser() {
    global $dbhandler0;
    
    $firstnamenew = !empty($_POST['firstnamenew']) ? $_POST['firstnamenew'] : '';
    $lastnamenew = !empty($_POST['lastnamenew']) ? $_POST['lastnamenew'] : '';
    $gendernew = !empty($_POST['gendernew']) ? $_POST['gendernew'] : '';
    $countrycodenew = !empty($_POST['countrycodenew']) ? $_POST['countrycodenew'] : '';
    $phonecodenew = !empty($_POST['phonecodenew']) ? $_POST['phonecodenew'] : '';
    $phonenew = !empty($_POST['phonenew']) ? $_POST['phonenew'] : '';
    $dobnew = !empty($_POST['dobnew']) ? $_POST['dobnew'] : '0000-00-00';
    $emailnew = !empty($_POST['emailnew']) ? $_POST['emailnew'] : '';
    $passnew = !empty($_POST['passnew']) ? $_POST['passnew'] : '';
    $facebooknew = !empty($_POST['facebooknew']) ? $_POST['facebooknew'] : '';
    $googlenew = !empty($_POST['googlenew']) ? $_POST['googlenew'] : '';    

    $sqlcheckuser = "SELECT * FROM user where va_email = '$emailnew'";
    $resuser = $dbhandler0->query($sqlcheckuser);

if (empty($resuser))
{
    $sqlcheck = 
    "INSERT INTO user (
    va_first_name,
    va_last_name,    
    va_gender,
    va_country_code,
    va_phone_code,
    va_phone,
    dt_dob,
    va_email,
    va_pass,
    va_facebook,
    va_google)
    VALUES (
    '$firstnamenew',
    '$lastnamenew',
    '$gendernew',
    '$countrycodenew',
    '$phonecodenew',
    '$phonenew',
    '$dobnew',
    '$emailnew',
    '$passnew',
    '$facebooknew',
    '$googlenew'        
    )";

    $res = $dbhandler0->insert($sqlcheck);
    $last_id = $res;
    return $res;
}
else
{
    if ($facebooknew != '' or $googlenew != '')
    {
    $res_i_user_id=$resuser[0]['i_user_id'];
    $sqlcheckupdate = "UPDATE user SET

    va_facebook = '$facebooknew',
    va_google = '$googlenew'
    WHERE i_user_id = '$res_i_user_id'"; 
    $resupdate = $dbhandler0->update($sqlcheckupdate);
    return $resupdate;
    }
    else
    {
    return -3;
    }
}
}
//======================================================================================================
?>