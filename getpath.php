<?php
function get_path($func) 
{
	switch ($func) 
	{
		case "getallstateandcity":
	    case "getres":
	    case "getresbyfeature":
	    case "getresbylocation":
	    case "getresfoodmenu":
	    case "getresbeveragemenu":
	    case "getresfoodtype":
	    	return array("path" => "query/search/func.php","querytype"=>"search");
	        break;
		case "insertnewres":
	    	return array("path" => "query/insert/func.php","querytype"=>"insert");
	        break;	
		case "updateres":
		case "updatefood":
	    	return array("path" => "query/update/func.php","querytype"=>"update");
	        break;		        
	}
}
?>