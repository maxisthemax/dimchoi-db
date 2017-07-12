<?php
/*
getAllStateAndCity
------------------
variable    = none
usage       = to get all state and city from db 

getRes
------------------
variable    = state,city,ressearch
usage       = to get restaurant with speicific query string
*/

include "system/function.php";

function updateres() 
{
    global $dbhandler0;
    //=============================================== 
    //define variable for query
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $state = !empty($_POST['state']) ? $_POST['state'] : '';

    $resname = !empty($_POST['resname']) ? $_POST['resname'] : '';
    $reslogo = !empty($_POST['reslogo']) ? $_POST['reslogo'] : '';
    $resid = !empty($_POST['resid']) ? $_POST['resid'] : '';
    //===============================================  

    $sqlcheck = 
    "UPDATE restaurant 
    SET va_res_name = '$resname',
    va_res_logo = '$reslogo', 
    i_city_id = (SELECT i_city_id FROM city WHERE va_city_name='$city' LIMIT 1)
    where i_res_id = $resid";
    $res = $dbhandler0->update($sqlcheck);
    return;
//=======================================================
}
?>