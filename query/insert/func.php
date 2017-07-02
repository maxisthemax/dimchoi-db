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
    $newres = !empty($_POST['newres']) ? $_POST['newres'] : '';
    $state = !empty($_POST['state']) ? $_POST['state'] : '';
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $todaydate = date("Y-m-d H:i:s");

    if (empty($newres) or empty($state) or empty($city))
    {
        return false;
    }

    //start query for same name  
    $sqlcheck = 
        "SELECT a.i_res_id,a.va_res_name
        FROM restaurant a
        WHERE a.va_res_name = '$newres'";
        $res = $dbhandler0->query($sqlcheck);
    //================================================== 

        if (empty($res))
        {
            //start insert  
                $sqlcheck = 
                "INSERT INTO restaurant (va_res_name, i_state_id, i_city_id)
                VALUES ('$newres',$state,$city)";
                $res = $dbhandler0->insert($sqlcheck);
                return ($res);
            //=================================================== 
        }
    //start insert  
       // $sqlcheck = 
       // "INSERT INTO restaurant (testint, testva, testdate)
       // VALUES ('testing max leong chee nang 2',$test,'$todaydate')";
    //===================================================

        //$dbhandler0->insert($sqlcheck);
//=======================================================
}
?>