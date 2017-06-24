<?php
/*
getAllStateAndCity
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
//get all state and city
function getAllStateAndCity()
{
    global $dbhandler0;

    //===============================================
    //start query
    $sqlcheck = "SELECT b.va_state_name,c.i_city_name 
    FROM state_city a 
    left join state b on a.i_state_id = b.i_state_id 
    left join city c on c.i_city_id = a.i_city_id 
    order by c.i_city_name";
    //===============================================

    $res = $dbhandler0->query($sqlcheck);
    return ($res);
}
//===================================================

//===================================================
//get company from query string variable
function getComp() 
{

    global $dbhandler0;

    //=============================================== 
    //define variable for query
	$state = !empty($_POST['state']) ? $_POST['state'] : '';
	$city = !empty($_POST['city']) ? $_POST['city'] : '';
    $companysearch = !empty($_POST['companysearch']) ? $_POST['companysearch'] : '';
    //===============================================

    //===============================================
    //start query
    $sqlcheck = "SELECT *
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
        if (!empty($companysearch) or $companysearch != 0)
        {
            $sqlcheck .= " and (a.va_comp_name like '%".$companysearch."%' OR c.i_city_name like '%".$companysearch."%')";  
        }          	
    }
    //===================================================
    
    $res = $dbhandler0->query($sqlcheck);
    return ($res);  
}
//=======================================================

?>