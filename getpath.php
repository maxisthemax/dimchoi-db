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
	    case "getorderqrcode":
	    case "getuser":
	    case "getresuser":
	    case "getuserorder":
	    case "getresorder":
	    	return array("path" => "query/search/func.php","querytype"=>"search");
	        break;
		case "insertnewres":
		case "insertnewfood":
		case "insertnewbev":
		case "insertnewqrcoderow":
		case "insertnewuser":
		case "insertorderfromqr":
		case "insertnewfoodtype":
		case "insertnewbevtype":
	    	return array("path" => "query/insert/func.php","querytype"=>"insert");
	        break;	
		case "updateres":
		case "updatefood":
		case "updatebev":
		case "updateuser":		
		case "updatefood_dev":
		case "updatebev_dev":
		case "updateuser_dev":
		case "updatefoodtype_dev":
		case "updatebevtype_dev":
		case "updateresusertoken":
		case "updateresorderstatus":
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