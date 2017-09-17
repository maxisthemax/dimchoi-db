<?php

//==============================================================================================
    global $dbhandler0;

    $sqlstate = "SELECT * FROM state a";
    $resstate = $dbhandler0->query($sqlstate);

    $in = json_encode($resstate);

    $datastate = json_decode($in, true);

    $sqlcheck = "SELECT b.va_state_name,c.va_city_name,a.i_state_id,a.i_city_id 
    FROM state_city a 
    left join state b on a.i_state_id = b.i_state_id 
    left join city c on c.i_city_id = a.i_city_id 
    order by c.i_city_id";
    $res = $dbhandler0->query($sqlcheck);

    $in = json_encode($res);

    $data = json_decode($in, true);
    $out1 = [];
    $out2 = [];

    foreach($datastate as $elementstate) {

            foreach($data as $elementcity) {
            if($elementstate['i_state_id']==$elementcity['i_state_id'])  
            {  
                $cityresult[]=
                [
                    'city_id' => $elementcity['i_city_id'],
                    'city_name' => $elementcity['va_city_name']
                ];
            }        
            }

            $finalresult[]=
            [
                'state_id' => $elementstate['i_state_id'],
                'state_name' => $elementstate['va_state_name'],
                'cities' => $cityresult
            ];

            unset($cityresult);

    }


     
    if($finalresult)
    {
        resultarray($finalresult,'data/place.php');
    }         
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,d.va_menu_code,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long  
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN menu d on d.i_res_id = a.i_res_id
    WHERE a.i_res_stat = 1";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/res.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long    
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    WHERE a.i_res_stat = 1 AND a.i_feature =1";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resfeature1.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long    
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    WHERE a.i_res_stat = 1 AND a.i_feature =2";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resfeature2.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long    
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    WHERE a.i_res_stat = 1 AND a.i_feature =99";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resfeature99.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*  
    FROM food_type a";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/foodtype.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*  
    FROM bev_type a";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/bevtype.php');
    }
//==============================================================================================
function resultarray($res,$filenameurl)
    {
        if (!empty($res))
        {
            $result = array (
                    'status' => '1',
                    'message' => 'success',
                    'data' => $res,
                );
        }
        else
        {
            $result = array (
                'status' => '0',
                'message' => 'fail',
            );
        }
        $fp = fopen($filenameurl, 'w');
        fwrite($fp, json_encode ($result, JSON_UNESCAPED_SLASHES));
    }            
?>


