<?php

//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function deletefood_dev() 
{
    global $dbhandler0;
//define variable for query >>>    
    $food_id = !empty($_POST['food_id']) ? $_POST['food_id'] : '';
//define variable for query <<< 

    $sqlcheck = 
        "SELECT a.* FROM food a where a.i_food_id = '$food_id'";

        $res = $dbhandler0->query($sqlcheck);

    if ($res)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM food_price where i_food_id = '$food_id'"; 
                $res1 = $dbhandler0->delete($sqldelete1);

                $sqldelete2 = "DELETE FROM food where i_food_id = '$food_id'";
                $res2 = $dbhandler0->delete($sqldelete2);

                $sqlauto = "ALTER TABLE food AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);  
                $sqlauto = "ALTER TABLE food_price AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                                  
        }
    if ($res1 && $res2){
        header('Location:'.$_POST['uri']);
    }        
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function deletefoodprice_dev() 
{
    global $dbhandler0;

//define variable for query >>>    
    $food_price_id = !empty($_POST['food_price_id']) ? $_POST['food_price_id'] : '';
 //define variable for query <<< 

    $sqlcheck = 
        "SELECT a.* FROM food_price a where a.i_price_id = '$food_price_id'";

        $res = $dbhandler0->query($sqlcheck);

    $sqlcheckcount = 
        "SELECT a.* FROM food_price a where a.i_food_id = (SELECT a.i_food_id FROM food_price a where a.i_price_id = '$food_price_id')";

        $rescount = $dbhandler0->query($sqlcheckcount);

    if (count($rescount) > 1)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM food_price where i_price_id = '$food_price_id'"; 
                $res1 = $dbhandler0->delete($sqldelete1);
                $sqlauto = "ALTER TABLE food_price AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                 
        }
    else if ($rescount = 1) {
            //start delete 
                $sqldelete1 = "DELETE FROM food where i_food_id = (SELECT a.i_food_id FROM food_price a where a.i_price_id = '$food_price_id')"; 
                $res1 = $dbhandler0->delete($sqldelete1); 
                $sqlauto = "ALTER TABLE food AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                          
    }    
    if ($res1){
        header('Location:'.$_POST['uri']);
    }        
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function deletebev_dev() 
{
    global $dbhandler0;

//define variable for query >>>     
    $bev_id = !empty($_POST['bev_id']) ? $_POST['bev_id'] : '';
//define variable for query <<<  

    $sqlcheck = 
        "SELECT a.* FROM bev a where a.i_bev_id = '$bev_id'";

        $res = $dbhandler0->query($sqlcheck);

    if ($res)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM bev_price where i_bev_id = '$bev_id'"; 
                $res1 = $dbhandler0->delete($sqldelete1);

                $sqldelete2 = "DELETE FROM bev where i_bev_id = '$bev_id'";
                $res2 = $dbhandler0->delete($sqldelete2);

                $sqlauto = "ALTER TABLE bev_price AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto); 
                $sqlauto = "ALTER TABLE bev AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                                 
        }
    if ($res1 && $res2){
        header('Location:'.$_POST['uri']);
    }        
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function deletebevprice_dev() 
{
    global $dbhandler0;

//define variable for query >>>    
    $bev_price_id = !empty($_POST['bev_price_id']) ? $_POST['bev_price_id'] : '';
 //define variable for query <<< 

    $sqlcheck = 
        "SELECT a.* FROM bev_price a where a.i_price_id = '$bev_price_id'";

        $res = $dbhandler0->query($sqlcheck);

    $sqlcheckcount = 
        "SELECT a.* FROM bev_price a where a.i_bev_id = (SELECT a.i_bev_id FROM bev_price a where a.i_price_id = '$bev_price_id')";

        $rescount = $dbhandler0->query($sqlcheckcount);

    if (count($rescount) > 1)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM bev_price where i_price_id = '$bev_price_id'"; 
                $res1 = $dbhandler0->delete($sqldelete1);
                $sqlauto = "ALTER TABLE bev_price AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                  
        }
    else if ($rescount = 1) {
            //start delete 
                $sqldelete1 = "DELETE FROM bev where i_bev_id = (SELECT a.i_bev_id FROM bev_price a where a.i_price_id = '$bev_price_id')"; 
                $res1 = $dbhandler0->delete($sqldelete1);  
                $sqlauto = "ALTER TABLE bev AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                                        
    }    
    if ($res1){
        header('Location:'.$_POST['uri']);
    }        
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
function deletecurrentrestype_dev() 
{
    global $dbhandler0;
//define variable for query >>>  
    $restypeid_update = !empty($_POST['res_type_submit']) ? $_POST['res_type_submit'] : '';  
//define variable for query <<< 

    $sqlcheck = 
        "SELECT a.* FROM res_type a where a.i_res_type_id = '$restypeid_update'";

        $res = $dbhandler0->query($sqlcheck);
    if ($res)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM res_type where i_res_type_id = '$restypeid_update'"; 
                $res1 = $dbhandler0->delete($sqldelete1);

                $sqlauto = "ALTER TABLE res_type AUTO_INCREMENT = 1"; 
                $res = $dbhandler0->query($sqlauto);                
        }
    if ($res1){
        header('Location:'.$_POST['uri']);
    }        
}
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
//=====================================================================================================================================================================
?>