<?php
//func techf act

function get_path($func) 
{
	switch ($func) 
	{
		case "getallstateandcity":
	    case "getcomp":
	    	return array("path" => "query/search/func.php","querytype"=>"search");
	        break;
		case "insertnewcomp":
	    	return array("path" => "query/insert/func.php","querytype"=>"insert");
	        break;	
	}
}

?>