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

//===================================================
//get all state and city
function getAllStateAndCity()
{
    global $dbhandler0;

    //===============================================
    //start query
    $sqlcheck = "SELECT b.va_state_name,a.va_city_name,a.i_state_id,a.i_city_id 
    FROM city a 
    left join state b on a.i_state_id = b.i_state_id 
    order by a.va_city_name";
    //===============================================

    $res = $dbhandler0->query($sqlcheck);
    return ($res);
}
//===================================================

//===================================================
//get restaurant from query string variable
function getres() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
	$state = !empty($_POST['state']) ? $_POST['state'] : '';
	$city = !empty($_POST['city']) ? $_POST['city'] : '';
    $ressearch = !empty($_POST['ressearch']) ? $_POST['ressearch'] : '';
    $total = !empty($_POST['total']) ? $_POST['total'] : '';
    $startfrom = !empty($_POST['startfrom']) ? $_POST['startfrom'] : '';
    $feature = !empty($_POST['feature']) ? $_POST['feature'] : '';
    $area = !empty($_POST['area']) ? $_POST['area'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name,d.va_area_name    
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    LEFT JOIN area d on a.i_area_id = d.i_area_id
    WHERE a.i_res_stat = 1";

    if (!empty($_POST)) //if all string url variable is 0 or null
    {
        if (!empty($city) or $city != 0)
    	{
    		$sqlcheck .= " and a.i_city_id = $city";	
    	}
    	if (!empty($state) or $state != 0)
    	{
    	 	$sqlcheck .= " and a.i_state_id = $state";	
    	}
        if (!empty($ressearch) or $ressearch != 0)
        {
            $sqlcheck .= " and (a.va_res_name like '%".$ressearch."%' OR c.va_city_name like '%".$ressearch."%')";  
        }     
        if (!empty($feature) or $feature != 0)
        {
            $sqlcheck .= " and a.i_feature = $feature";  
        }     
        if (!empty($area) or $area != 0)
        {
            $sqlcheck .= " and d.i_area_id = $area";  
        }                 	
    }

    if (!empty($total) or $total != 0)
    {
        $sqlcheck .= " LIMIT $total";

        if (!empty($startfrom) or $startfrom != 0)
        {
        $startfrom = $startfrom - 1;
                $sqlcheck .= " OFFSET $startfrom";
        }
    }
    //===================================================
    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
function getresbyfeature() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $state = !empty($_POST['state']) ? $_POST['state'] : '';
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $ressearch = !empty($_POST['ressearch']) ? $_POST['ressearch'] : '';
    $total = !empty($_POST['total']) ? $_POST['total'] : '';
    $startfrom = !empty($_POST['startfrom']) ? $_POST['startfrom'] : '';
    $feature = !empty($_POST['feature']) ? $_POST['feature'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT a.i_res_id ,a.va_res_name,a.va_res_logo
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    WHERE a.i_res_stat = 1";

    if (!empty($_POST)) //if all string url variable is 0 or null
    {
        if (!empty($city) or $city != 0)
        {
            $sqlcheck .= " and a.i_city_id = $city";    
        }
        if (!empty($state) or $state != 0)
        {
            $sqlcheck .= " and a.i_state_id = $state";  
        }
        if (!empty($ressearch) or $ressearch != 0)
        {
            $sqlcheck .= " and (a.va_res_name like '%".$ressearch."%' OR c.va_city_name like '%".$ressearch."%')";  
        }     
        if (!empty($feature) or $feature != 0)
        {
            $sqlcheck .= " and a.i_feature = $feature";  
        }               
    }

    if (!empty($total) or $total != 0)
    {
        $sqlcheck .= " LIMIT $total";

        if (!empty($startfrom) or $startfrom != 0)
        {
        $startfrom = $startfrom - 1;
                $sqlcheck .= " OFFSET $startfrom";
        }
    }
    //===================================================
    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
function getresbylocation() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $state = !empty($_POST['state']) ? $_POST['state'] : '';
    $city = !empty($_POST['city']) ? $_POST['city'] : '';
    $ressearch = !empty($_POST['ressearch']) ? $_POST['ressearch'] : '';
    $total = !empty($_POST['total']) ? $_POST['total'] : '';
    $startfrom = !empty($_POST['startfrom']) ? $_POST['startfrom'] : '';
    $feature = !empty($_POST['feature']) ? $_POST['feature'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT a.i_res_id ,a.va_res_name,a.va_res_logo
    FROM restaurant a 
    LEFT JOIN state b ON a.i_state_id = b.i_state_id 
    LEFT JOIN city c ON c.i_city_id = a.i_city_id 
    WHERE a.i_res_stat = 1";

    if (!empty($_POST)) //if all string url variable is 0 or null
    {
        if (!empty($city) or $city != 0)
        {
            $sqlcheck .= " and a.i_city_id = $city";    
        }
        if (!empty($state) or $state != 0)
        {
            $sqlcheck .= " and a.i_state_id = $state";  
        }
        if (!empty($ressearch) or $ressearch != 0)
        {
            $sqlcheck .= " and (a.va_res_name like '%".$ressearch."%' OR c.va_city_name like '%".$ressearch."%')";  
        }     
        if (!empty($feature) or $feature != 0)
        {
            $sqlcheck .= " and a.i_feature = $feature";  
        }               
    }

    if (!empty($total) or $total != 0)
    {
        $sqlcheck .= " LIMIT $total";

        if (!empty($startfrom) or $startfrom != 0)
        {
        $startfrom = $startfrom - 1;
                $sqlcheck .= " OFFSET $startfrom";
        }
    }
    //===================================================
    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
function getresfoodtype() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $res_id = !empty($_POST['res_id']) ? $_POST['res_id'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT DISTINCT c.va_food_type_name AS main
    FROM menu a 
    LEFT JOIN food b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN food_type c on b.i_food_type_id = c.i_food_type_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlcheck .= " and a.i_res_id = $res_id";    
        }           
    }   
    //===================================================

    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
function getresfoodmenu() 
{

    global $dbhandler0;
//=============================================================FOOD===================================================================================    
    $foodtypearray = array();  
    $foodarray = array();
    $food_menu_type_id = array();
    $food_price = array();
    //=============================================== 
    //define variable for query
    $res_id = !empty($_POST['res_id']) ? $_POST['res_id'] : '';
    //===============================================
    $sqlHQ = "SELECT i_hq_id from restaurant where i_res_id = '$res_id' LIMIT 1";
    $resHQ = $dbhandler0->query($sqlHQ);
    $hqid = $resHQ[0]['i_hq_id'];
    $res_id = $hqid;
    //===============================================
    //start query
    $sqlfoodtype = "SELECT DISTINCT c.va_food_type_name,c.i_food_type_id as food_type_id,c.va_food_type_pic_url,res.va_res_code
    FROM menu a 
    LEFT JOIN food b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN food_type c on b.i_food_type_id = c.i_food_type_id
    LEFT JOIN restaurant res on res.i_res_id = a.i_res_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlfoodtype .= " and a.i_res_id = $res_id";    
        }           
    }   
    $foodtype = $dbhandler0->query($sqlfoodtype);   
    //===================================================

    //===============================================
    //start query
    $sqlfood = "SELECT a.*, b.*,c.va_food_type_name
    FROM menu a 
    LEFT JOIN food b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN food_type c on b.i_food_type_id = c.i_food_type_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlfood .= " and a.i_res_id = $res_id";    
        }           
    }   
    $food = $dbhandler0->query($sqlfood);
    //===================================================    
    //===============================================
    //start query
    $sqlfoodprice = "SELECT c.i_food_id AS i_food_id,c.va_food_size AS va_food_size, FORMAT(c.d_food_price,2) AS d_food_price
    FROM menu a 
    LEFT JOIN food b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN food_price c ON c.i_food_id = b.i_food_id

    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlfoodprice .= " and a.i_res_id = $res_id";    
        }           
    }   
    $foodprice = $dbhandler0->query($sqlfoodprice);
    //===================================================
    foreach ($foodtype as $key1)
    {
           foreach ($food as $key2)
            {             
                if ($key1['va_food_type_name']==$key2['va_food_type_name'])
                {   
                foreach($foodprice as $price) 
                    {
                        if ($key2['i_food_id']==$price['i_food_id'])
                        {   
                            $food_price[] = ['va_food_size' => $price['va_food_size'],'d_food_price' => $price['d_food_price']];            
                        }
                    }                      
                $foodarray[]=[
                            'i_food_id' => $key2['i_food_id'],
                            'va_food_name' => $key2['va_food_name'],
                            'va_food_pic_url' => $_SESSION['file'].$key1['va_res_code'].'/'.$key2['va_food_pic_url'],
                            'va_food_desc' => $key2['va_food_desc'],
                            'food_price' => $food_price
                            ];
                }
                unset($food_price); 
                $food_price = array();                
            }
            $foodtypearray[]=array('menu_type'=>$key1['va_food_type_name'],'va_food_type_pic_url'=>$_SESSION['file'].$key1['va_res_code'].'/'.$key1['va_food_type_pic_url'],'menu_data'=>$foodarray); 
            unset($foodarray); 
            $foodarray = array();            
      
    $food_menu_type_id[$key1['va_food_type_name']] = $key1['food_type_id'];  
    }

    $in = json_encode($foodtypearray);
    $foodresult = json_decode($in, true);
//=============================================================FOOD===================================================================================

//=============================================================BEVERAGE===============================================================================
    $bevtypearray = array();  
    $bevarray = array();
    $bev_menu_type_id = array();
    $bev_price = array();
    //=============================================== 
    //define variable for query
    $res_id = !empty($_POST['res_id']) ? $_POST['res_id'] : '';
    //===============================================
    $sqlHQ = "SELECT i_hq_id from restaurant where i_res_id = '$res_id' LIMIT 1";
    $resHQ = $dbhandler0->query($sqlHQ);
    $hqid = $resHQ[0]['i_hq_id'];
    $res_id = $hqid;
    //===============================================
    //start query
    $sqlbevtype = "SELECT DISTINCT c.va_bev_type_name,c.i_bev_type_id as bev_type_id,c.va_bev_type_pic_url,res.va_res_code
    FROM menu a 
    LEFT JOIN bev b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN bev_type c on b.i_bev_type_id = c.i_bev_type_id
    LEFT JOIN restaurant res on res.i_res_id = a.i_res_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlbevtype .= " and a.i_res_id = $res_id";    
        }           
    }   
    $bevtype = $dbhandler0->query($sqlbevtype);   
    //===================================================

    //===============================================
    //start query
    $sqlbev = "SELECT a.*, b.*,c.va_bev_type_name
    FROM menu a 
    LEFT JOIN bev b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN bev_type c on b.i_bev_type_id = c.i_bev_type_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlbev .= " and a.i_res_id = $res_id";    
        }           
    }   
    $bev = $dbhandler0->query($sqlbev);
    //===================================================    
    //===============================================
    //start query
    $sqlbevprice = "SELECT c.i_bev_id AS i_bev_id,c.va_bev_size AS va_bev_size, FORMAT(c.d_bev_price,2) AS d_bev_price
    FROM menu a 
    LEFT JOIN bev b ON b.i_menu_id = a.i_menu_id
    LEFT JOIN bev_price c ON c.i_bev_id = b.i_bev_id

    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlbevprice .= " and a.i_res_id = $res_id";    
        }           
    }   
    $bevprice = $dbhandler0->query($sqlbevprice);
    //===================================================
    foreach ($bevtype as $key1)
    {
           foreach ($bev as $key2)
            {             
                if ($key1['va_bev_type_name']==$key2['va_bev_type_name'])
                {   
                foreach($bevprice as $price) 
                    {
                        if ($key2['i_bev_id']==$price['i_bev_id'])
                        {   
                            $bev_price[] = ['va_bev_size' => $price['va_bev_size'],'d_bev_price' => $price['d_bev_price']];            
                        }
                    }                      
                $bevarray[]=[
                            'i_bev_id' => $key2['i_bev_id'],
                            'va_bev_name' => $key2['va_bev_name'],
                            'va_bev_pic_url' => $_SESSION['file'].$key1['va_res_code'].'/'.$key2['va_bev_pic_url'],
                            'va_bev_desc' => $key2['va_bev_desc'],
                            'bev_price' => $bev_price
                            ];
                }
                unset($bev_price); 
                $bev_price = array();                
            }
            $bevtypearray[]=array('menu_type'=>$key1['va_bev_type_name'],'va_bev_type_pic_url'=>$_SESSION['file'].$key1['va_res_code'].'/'.$key1['va_bev_type_pic_url'],'menu_data'=>$bevarray); 
            unset($bevarray); 
            $bevarray = array();            
      
    $bev_menu_type_id[$key1['va_bev_type_name']] = $key1['bev_type_id'];  
    }

    $in = json_encode($bevtypearray);
    $bevresult = json_decode($in, true);

    $finalresult = array (
                'i_menu_id' => $key2['i_menu_id'], 
                'i_res_id' => $key2['i_res_id'],
                'va_menu_code' => $key2['va_menu_code'], 
                'food_menu_type_id' => $food_menu_type_id,                 
                'food_menu' => $foodresult,
                'beverage_menu' => $bevresult
            );

   return ($finalresult);  
}
function getresbeveragemenu() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $res_id = !empty($_POST['res_id']) ? $_POST['res_id'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT *
    FROM menu a 
    LEFT JOIN bev b ON b.i_menu_id = a.i_menu_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlcheck .= " and a.i_res_id = $res_id";    
        }           
    }   
    //===================================================
    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
//=============================================================BEVERAGE===================================================================================
//=============================================================QR CODE===================================================================================
function getorderqrcode() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $res_id = !empty($_POST['res_id']) ? $_POST['res_id'] : '';
    $qr_id = !empty($_POST['qr_id']) ? $_POST['qr_id'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT a.va_qr_data_1,a.va_qr_data_2
    FROM qrcode a 
    WHERE a.i_qr_type_id = 1";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id) or $res_id != 0)
        {
            $sqlcheck .= " and a.i_res_id = $res_id";    
        }    
         if (!empty($qr_id) or $qr_id != 0)
        {
            $sqlcheck .= " and a.i_qr_id = $qr_id";    
        }               
    } 
         $sqlcheck .=" LIMIT 1";
    //===================================================
    $res = $dbhandler0->query($sqlcheck);
    return ($res);
}    
//=============================================================QR CODE===================================================================================
//=============================================================LOGIN===================================================================================
function getuser() 
{
    global $dbhandler0;
    //=============================================== 
    //define variable for query
    $email = !empty($_POST['email']) ? $_POST['email'] : '';
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : '';
    $facebook = !empty($_POST['facebook']) ? $_POST['facebook'] : '';
    $google = !empty($_POST['google']) ? $_POST['google'] : '';    
    $type = !empty($_POST['type']) ? $_POST['type'] : '';

    //===============================================
    //===============================================
    //start query
    $sqlcheck = "SELECT *
    FROM user a 
    WHERE";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
        if ($type == 'email')
        {
            if (!empty($pass) AND !empty($email))
            {
                $sqlcheck .= " a.va_email = '$email'";    
                $sqlcheck .= " and a.va_pass = '$pass'";    
            }            
        }    
        else if ($type == 'fb')
        {  
            if (!empty($email) or $email != 0)
            {
                $sqlcheck .= " a.va_email = '$email'";    
            }           
        }    
        else if ($type == 'google')
        {
            if (!empty($email) or $email != 0)
            {
                $sqlcheck .= " a.va_email = '$email'";    
            }             
        }                   
    } 
         $sqlcheck .=" LIMIT 1";
    //===================================================
    $res = $dbhandler0->query($sqlcheck);

    if ($type == 'fb')
    {
        if (!empty($res))
        {
            $update_i_user_id = $res[0]['i_user_id'];
            if ($res[0]['va_facebook'] == '')
            {
            $sqlcheckupdate = "UPDATE user set va_facebook = '$facebook' WHERE i_user_id = '$update_i_user_id'";
            $res1 = $dbhandler0->update($sqlcheckupdate);
            }
        }
    }
    else if ($type == 'google')
    {
        if (!empty($res))
        {
            $update_i_user_id = $res[0]['i_user_id'];
            if ($res[0]['va_google'] == '')
            {
            $sqlcheckupdate = "UPDATE user set va_google = '$google' WHERE i_user_id = '$update_i_user_id'";
            $res1 = $dbhandler0->update($sqlcheckupdate);
            }
        }
    }        

    return ($res[0]);



}    
//=============================================================LOGIN===================================================================================   
?>
