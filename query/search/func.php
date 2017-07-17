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
    $sqlcheck = "SELECT b.va_state_name,c.va_city_name,a.i_state_id,a.i_city_id 
    FROM state_city a 
    left join state b on a.i_state_id = b.i_state_id 
    left join city c on c.i_city_id = a.i_city_id 
    order by c.va_city_name";
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
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT a.*,b.va_state_name,c.va_city_name  
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
            $sqlcheck .= " and (a.va_res_name like '%".$ressearch."%' OR c.i_city_name like '%".$ressearch."%')";  
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
            $sqlcheck .= " and (a.va_res_name like '%".$ressearch."%' OR c.i_city_name like '%".$ressearch."%')";  
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
            $sqlcheck .= " and (a.va_res_name like '%".$ressearch."%' OR c.i_city_name like '%".$ressearch."%')";  
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
function getresfoodmenu() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $res_id1 = !empty($_POST['res_id1']) ? $_POST['res_id1'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT *
    FROM menu a 
    LEFT JOIN food b ON b.i_menu_id = a.i_menu_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id1) or $res_id1 != 0)
        {
            $sqlcheck .= " and a.i_res_id = $res_id1";    
        }           
    }   
    //===================================================

    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
function getresbeveragemenu() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
    $res_id2 = !empty($_POST['res_id2']) ? $_POST['res_id2'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT *
    FROM menu a 
    LEFT JOIN beverage b ON b.i_menu_id = a.i_menu_id
    WHERE b.i_menu_id = a.i_menu_id";
    if (!empty($_POST)) //if all string url variable is 0 or null
    {
         if (!empty($res_id2) or $res_id2 != 0)
        {
            $sqlcheck .= " and a.i_res_id = $res_id2";    
        }           
    }   
    //===================================================
    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
//=======================================================

?>