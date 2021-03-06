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
    unset($finalresult);       
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

    $sqlcheck = "SELECT * FROM (SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id,c.i_area_id,c.va_area_name,COUNT(res.i_res_id) as 'total_res'
    FROM city a 
    left join state b on a.i_state_id = b.i_state_id 
    left join area c on c.i_city_id = a.i_city_id
    left join restaurant res on res.i_area_id = c.i_area_id and res.i_res_stat = 1
    GROUP by c.i_area_id
    order by total_res DESC,b.i_state_id,a.i_city_id,c.i_area_id) AS result where result.i_area_id > 0";
    $res = $dbhandler0->query($sqlcheck);

    $in = json_encode($res);

    $data = json_decode($in, true);
    $out1 = [];
    $out2 = [];
    foreach($datastate as $elementstate)
    {
        foreach($datacity as $elementcity) {

                foreach($data as $value) {
                    $areaid = $value['i_area_id'];
                    $sqlresdata = "SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id,c.i_area_id,c.va_area_name,res.*
                    FROM city a 
                    left join state b on a.i_state_id = b.i_state_id 
                    left join area c on c.i_city_id = a.i_city_id
                    left join restaurant res on res.i_area_id = c.i_area_id and res.i_res_stat = 1
                    where res.i_area_id = $areaid
                    order by res.va_res_name asc,res.i_res_id asc";
                    $resdata = $dbhandler0->query($sqlresdata);                    
                    if($elementstate['i_state_id']==$value['i_state_id']) 
                    { 
                        if($elementcity['i_city_id']==$value['i_city_id'])  
                        {  
                            $cityresult[]=
                            [
                                'area_id' => $value['i_area_id'],
                                'area_name' => $value['va_area_name'],
                                'total_res' => $value['total_res'],
                                'res_data' => $resdata
                            ];
                        }  
                    } 
                    unset($resdata);
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

    if($finalresult2)
    {
        resultarray($finalresult2,'data/area.php');
    }     
    unset($resdata);
    unset($cityresult);
    unset($finalresult1);
    unset($elementstate);
    unset($elementcity);  
    unset($value);  
    unset($finalresult2);         
//==============================================================================================
    global $dbhandler0;

    $sqlstate = "SELECT * FROM state a";
    $resstate = $dbhandler0->query($sqlstate);

    $in = json_encode($resstate);

    $datastate = json_decode($in, true);

    $sqlcheck = "SELECT * FROM (SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id,COUNT(res.i_res_id) as 'total_res'
    FROM city a 
    left join state b on a.i_state_id = b.i_state_id
    left join restaurant res on res.i_city_id = a.i_city_id and res.i_res_stat = 1
    GROUP by a.i_city_id
    order by total_res DESC,b.i_state_id,a.i_city_id) AS result where result.i_city_id > 0";
    $res = $dbhandler0->query($sqlcheck);

    $in = json_encode($res);

    $data = json_decode($in, true);
    $out1 = [];
    $out2 = [];

    foreach($datastate as $elementstate) {

            foreach($data as $elementcity) {
            $cityid = $elementcity['i_city_id'];    
            $sqlresdata = "SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id,c.i_area_id,c.va_area_name,res.*
                    FROM city a 
                    left join state b on a.i_state_id = b.i_state_id 
                    left join area c on c.i_city_id = a.i_city_id
                    left join restaurant res on res.i_area_id = c.i_area_id and res.i_res_stat = 1
                    where res.i_city_id = $cityid
                    order by c.i_area_id,res.va_res_name";
                    $resdata = $dbhandler0->query($sqlresdata);                             
            if($elementstate['i_state_id']==$elementcity['i_state_id'])  
            {  
                $cityresult[]=
                [
                    'city_id' => $elementcity['i_city_id'],
                    'city_name' => $elementcity['va_city_name'],
                    'total_res' => $elementcity['total_res'],
                    'res_data' => $resdata
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
        resultarray($finalresult,'data/city.php');
    }     
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,d.va_menu_code,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long,e.va_area_name      
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN menu d on d.i_res_id = a.i_res_id
    LEFT JOIN area e on a.i_area_id = e.i_area_id
    WHERE a.i_res_stat = 1    
    ORDER BY a.va_res_name ASC,a.i_res_id ASC";

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
    WHERE a.i_res_stat = 1 AND a.i_res_ad =1
    ORDER BY a.va_res_name ASC,a.i_res_id ASC";

    $res = $dbhandler0->query($sqlcheck);

    if($res)
    {
        resultarray($res,'data/resads.php');
    }
//==============================================================================================
    global $dbhandler0;
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,a.va_res_desc,a.va_res_add1,a.va_res_add2,a.d_lat,a.d_long,e.va_area_name    
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN area e on a.i_area_id = e.i_area_id    
    WHERE a.i_res_stat = 1 AND a.i_feature =1
    ORDER BY a.va_res_name ASC,a.i_res_id ASC";

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
    WHERE a.i_res_stat = 1 AND a.i_feature =2
    ORDER BY a.va_res_name ASC,a.i_res_id ASC";

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
    WHERE a.i_res_stat = 1 AND a.i_feature =99
    ORDER BY a.va_res_name ASC,a.i_res_id ASC";

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


