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
		case "insertnewfood":
		case "insertnewbev":
		case "insertnewqrcoderow":
	    	return array("path" => "query/insert/func.php","querytype"=>"insert");
	        break;	
		case "updateres":
		case "updatefood":
		case "updatebev":
	    	return array("path" => "query/update/func.php","querytype"=>"update");
	        break;	
		case "deletefood":
		case "deletefoodprice":
		case "deletebev":
		case "deletebevprice":		
	    	return array("path" => "query/delete/func.php","querytype"=>"delete");
	        break;		        	        
	}
}
?>