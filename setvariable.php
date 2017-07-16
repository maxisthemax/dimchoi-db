<?php
include "lib/db.php";
include "config.php";
include "getpath.php";
include "system/function.php";
    global $dbhandler0;
    $sqlcheck = "SELECT b.va_state_name,c.va_city_name,a.i_state_id,a.i_city_id 
    FROM state_city a 
    left join state b on a.i_state_id = b.i_state_id 
    left join city c on c.i_city_id = a.i_city_id 
    order by c.va_city_name";
    //===============================================


    $res = $dbhandler0->query($sqlcheck);

    $result = array (
            'status' => '1',
            'message' => 'success',
            'data' => $res,
        );
    $fp = fopen('data/place.php', 'w');
    fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES));

//==============================================================================================

    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name  
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    WHERE a.i_res_stat = 1";
    //===============================================
    $res = $dbhandler0->query($sqlcheck);

    $result = array (
            'status' => '1',
            'message' => 'success',
            'data' => $res,
        );
    $fp = fopen('data/res.php', 'w');
    fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES));

//==============================================================================================       
?>       