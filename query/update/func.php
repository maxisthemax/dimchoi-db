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
    $resname = !empty($_POST['resname']) ? $_POST['resname'] : '';
    $reslogo = !empty($_POST['reslogo']) ? $_POST['reslogo'] : '';
    $resid = !empty($_POST['resid']) ? $_POST['resid'] : '';
    //===============================================  

    $sqlcheck = 
    "UPDATE restaurant 
    SET va_res_name = '$resname',
    va_res_logo = '$reslogo' 
    where i_res_id = $resid";
    $res = $dbhandler0->update($sqlcheck);
    return;
//=======================================================
}
?>