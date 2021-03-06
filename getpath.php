<?php
function get_path($func) 
{
/*---------------------------------------FOR MOBILE LIVE----------------------------------------------------------*/	
	switch ($func) 
	{
		case "getallstateandcity":
	    case "getres":
	    case "getresbyfeature":
	    case "getresbylocation":
	    case "getresfoodmenu":
	    case "getresfoodtype":
	    case "getorderqrcode":
	    case "getuser":
	    case "getresuser":
	    case "getuserorder":
	    case "getresorder":
	    	return array("path" => "query/search/func.php","querytype"=>"search");
	        break;

		case "insertnewqrcoderow": //shared
		case "insertnewuser": //shared
		case "insertorderfromqr": //shared
		case "insertitem": //shared
		case "insertnewusertoken": //shared
	    	return array("path" => "query/insert/func.php","querytype"=>"insert");
	        break;

		case "deleteitem": //shared
		case "deleteqrcode":
	    	return array("path" => "query/delete/func.php","querytype"=>"delete");
	        break;

		case "updateuser":				
		case "updateresusertoken":
		case "updateresorderstatus":
		case "updateresordertable":
		case "updateqrdata":
		case "updateresorderdata":
		case "updateuserorderdata":
		case "updateuserorderstatus":
		case "syncorderdata";
		case "closeorder";
		case "updateitemstatus";
		case "updateresetpassword";
	    	return array("path" => "query/update/func.php","querytype"=>"update");
	        break;
/*---------------------------------------FOR DEVELOPMENT.PHP ONLY----------------------------------------------------------*/

		case "insertnewres_dev":
		case "insertnewfood_dev":
		case "insertnewfoodtype_dev":
		case "insertnewrestype_dev":
		case "insertnewressetting_dev":
		case "insertnewresamenities_dev":
	    	return array("path" => "query/dev/insert/func.php","querytype"=>"insert");
	        break;

		case "updateres_dev":
		case "updateuser_dev":
		case "updatefood_dev":
		case "updatefoodtype_dev":	
		case "updaterestypetable_dev":	
		case "updaterestype_dev":	
		case "updateressettingtable_dev":	
		case "updateressetting_dev":
		case "updateresamenitiestable_dev":	
		case "updateresamenities_dev":				    
	    	return array("path" => "query/dev/update/func.php","querytype"=>"update");
	        break;	

		case "deletefood_dev":
		case "deletefoodprice_dev":
		case "deletecurrentrestype_dev":		
		case "deletecurrentressetting_dev":
		case "deletecurrentresamenities_dev":
	    	return array("path" => "query/dev/delete/func.php","querytype"=>"delete");
	        break;		                
	}
}
?>