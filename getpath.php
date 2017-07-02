<?php
//func techf act

function get_path($func) 
{
	switch ($func) 
	{
		case "getallstateandcity":
	    case "getres":
	    case "getresbyfeature":
	    	return array("path" => "query/search/func.php","querytype"=>"search");
	        break;
		case "insertnewres":
	    	return array("path" => "query/insert/func.php","querytype"=>"insert");
	        break;	
	}
}

?>