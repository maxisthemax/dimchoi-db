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
    $city_new = !empty($_POST['city_new']) ? $_POST['city_new'] : '';
    $todaydate = date("Y-m-d H:i:s");

    if (empty($resname_new))
    {
        return false;
    }

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
                va_res_name,
                va_res_code,
                va_res_logo, 
                i_state_id, 
                i_city_id)
                VALUES (
                '$resname_new',
                '$rescode_new',
                '$reslogo_new',
                (SELECT i_state_id FROM state_city WHERE i_city_id=(SELECT i_city_id FROM city WHERE va_city_name='$city_new' LIMIT 1) LIMIT 1),
                (SELECT i_city_id FROM city WHERE va_city_name='$city_new' LIMIT 1))";
                $res = $dbhandler0->insert($sqlcheck);
                return ($res);
            //=================================================== 
        }
}
//====================================================================================================== 
function insertnewfood() {
    global $dbhandler0;
    $food_name_new = !empty($_POST['food_name_new']) ? $_POST['food_name_new'] : '';
    $resid_insert = !empty($_POST['resid_insert']) ? $_POST['resid_insert'] : '';
    $resname_insert = !empty($_POST['resname_insert']) ? $_POST['resname_insert'] : '';
    $menucode_insert = !empty($_POST['menucode_insert']) ? $_POST['menucode_insert'] : '';
    $food_type_new = !empty($_POST['food_type_new']) ? $_POST['food_type_new'] : '';
    $food_size_new = !empty($_POST['food_size_new']) ? $_POST['food_size_new'] : '';
    $food_price_new = !empty($_POST['food_price_new']) ? $_POST['food_price_new'] : '';        
    $sqlcheck = 
        "SELECT a.*
        FROM menu a
        LEFT JOIN food c on a.i_menu_id = c.i_menu_id
        LEFT JOIN restaurant b on b.va_res_code = a.va_menu_code
        WHERE b.va_res_name = '$resname_insert' AND b.i_res_id='$resid_insert' AND a.va_menu_code = '$menucode_insert' AND c.va_food_name = '$food_name_new'";

        $res = $dbhandler0->query($sqlcheck);
    if (empty($res))
        {
            //start insert  
                $sqlcheck = 
                "INSERT INTO food (
                i_menu_id,    
                va_food_name,
                i_food_type_id, 
                va_food_pic_url)
                VALUES (
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insert' LIMIT 1),
                '$food_name_new',
                '$food_type_new','')";

                $res = $dbhandler0->insert($sqlcheck);
                $last_id = $res;

                $sqlcheck2 = 
                "INSERT INTO food_price (
                i_food_id,    
                i_menu_id,
                va_food_size, 
                d_food_price)
                VALUES (
                '$last_id',
                (SELECT a.i_menu_id FROM menu a where a.va_menu_code = '$menucode_insert' LIMIT 1),
                '$food_size_new',
                '$food_price_new')";

                 $res1 = $dbhandler0->insert($sqlcheck2);
            //=================================================== 
        }
    if ($res && $res1){
        header('Location:'.$_POST['uri']);
    }        
}
//======================================================================================================
?>