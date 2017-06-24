<?php
/*
getallstateandcity
------------------
variable    = none
usage       = to get all state and city from db 

getComp
------------------
variable    = state,city,companysearch
usage       = to get company with speicific query string

*/
include "system/function.php";
//===================================================
//get company from query string variable
function insertnewcomp() {
    global $dbhandler0;
    $newcomp = !empty($_POST['newcomp']) ? $_POST['newcomp'] : '';
    $state = !empty($_POST['state']) ? $_POST['state'] : '';
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $todaydate = date("Y-m-d H:i:s");

    if (empty($newcomp) or empty($state) or empty($city))
    {
        return false;
    }

    //start query for same name  
    $sqlcheck = 
        "SELECT a.i_comp_id,a.va_comp_name
        FROM company a
        WHERE a.va_comp_name = '$newcomp'";
        $res = $dbhandler0->query($sqlcheck);
    //================================================== 

        if (empty($res))
        {
            //start insert  
                $sqlcheck = 
                "INSERT INTO company (va_comp_name, i_state_id, i_city_id)
                VALUES ('$newcomp',$state,$city)";
                $res = $dbhandler0->insert($sqlcheck);
                return ($res);
            //=================================================== 
        }
    //start insert  
       // $sqlcheck = 
       // "INSERT INTO company (testint, testva, testdate)
       // VALUES ('testing max leong chee nang 2',$test,'$todaydate')";
    //===================================================

        //$dbhandler0->insert($sqlcheck);
//=======================================================
}
?>