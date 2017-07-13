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
//get restaurant from query string variable
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
                '$rescodenew',
                '$reslogo_new',
                (SELECT i_state_id FROM state_city WHERE i_city_id=(SELECT i_city_id FROM city WHERE va_city_name='$city_new' LIMIT 1) LIMIT 1),
                (SELECT i_city_id FROM city WHERE va_city_name='$city_new' LIMIT 1))";
                $res = $dbhandler0->insert($sqlcheck);
                return ($res);
            //=================================================== 
        }
}
?>