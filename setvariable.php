<?php

//==============================================================================================
    global $dbhandler0;

    $sqlstate = "SELECT * FROM state a";
    $resstate = $dbhandler0->query($sqlstate);

    $in = json_encode($resstate);

    $datastate = json_decode($in, true);

    $sqlcheck = "SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id 
    FROM city a 
    left join state b on a.i_state_id = b.i_state_id 
    order by a.va_city_name";
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

    $sqlstate = "SELECT * FROM state a order by i_state_id";
    $resstate = $dbhandler0->query($sqlstate);
    $instate = json_encode($resstate);

    $sqlcity = "SELECT * FROM city a order by i_city_id";
    $rescity = $dbhandler0->query($sqlcity);
    $incity = json_encode($rescity);

    $datastate = json_decode($instate, true);
    $datacity = json_decode($incity, true);

    $sqlcheck = "SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id,c.i_area_id,c.va_area_name 
    FROM city a 
    left join state b on a.i_state_id = b.i_state_id 
    left join area c on c.i_city_id = a.i_city_id
    order by b.i_state_id,a.i_city_id,c.i_area_id";
    $res = $dbhandler0->query($sqlcheck);

    $in = json_encode($res);

    $data = json_decode($in, true);
    $out1 = [];
    $out2 = [];
    foreach($datastate as $elementstate)
    {
        foreach($datacity as $elementcity) {

                foreach($data as $value) {
                    if($elementstate['i_state_id']==$value['i_state_id']) 
                    { 
                        if($elementcity['i_city_id']==$value['i_city_id'])  
                        {  
                            $cityresult[]=
                            [
                                'area_id' => $value['i_area_id'],
                                'area_name' => $value['va_area_name']
                            ];
                        }  
                    } 
                }
                if (!empty($cityresult))
                {
                $finalresult1[]=
                [
                    'city_id' => $elementcity['i_city_id'],
                    'city_name' => $elementcity['va_city_name'],
                    'areas' => $cityresult
                ];
                }
                unset($cityresult);
        }

       $finalresult2[]=
       [
         'state_id' => $elementstate['i_state_id'],
         'state_name' => $elementstate['va_state_name'],
         'cities' => $finalresult1
       ];
       unset($finalresult1);

    }

    if($finalresult1)
    {
        resultarray($finalresult1,'data/area.php');
    }         
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,d.va_menu_code,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long,e.va_area_name      
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN menu d on d.i_res_id = a.i_res_id
    LEFT JOIN area e on a.i_area_id = e.i_area_id
    WHERE a.i_res_stat = 1";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/res.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long,e.va_area_name    
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN area e on a.i_area_id = e.i_area_id    
    WHERE a.i_res_stat = 1 AND a.i_feature =1";
    
    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resfeature1.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long,e.va_area_name        
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN area e on a.i_area_id = e.i_area_id    
    WHERE a.i_res_stat = 1 AND a.i_feature =2";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resfeature2.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long,e.va_area_name        
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN area e on a.i_area_id = e.i_area_id    
    WHERE a.i_res_stat = 1 AND a.i_feature =99";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resfeature99.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT e.* FROM area e";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/area.php');
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


