<?php
/*
getallstateandcity
------------------
variable    = none
usage       = to get all state and city from db 

getRes
------------------
variable    = state,city,ressearch
usage       = to get restaurant with speicific query string

*/
include "system/function.php";
//====================================================================================================== 
function deletefood() {
    global $dbhandler0;
    $food_id = !empty($_POST['food_id']) ? $_POST['food_id'] : '';
 
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
        }
    if ($res1 && $res2){
        header('Location:'.$_POST['uri']);
    }        
}
//====================================================================================================== 
function deletefoodprice() {
    global $dbhandler0;
    $food_price_id = !empty($_POST['food_price_id']) ? $_POST['food_price_id'] : '';
 
    $sqlcheck = 
        "SELECT a.* FROM food_price a where a.i_price_id = '$food_price_id'";

        $res = $dbhandler0->query($sqlcheck);

    if ($res)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM food_price where i_price_id = '$food_price_id'"; 
                $res1 = $dbhandler0->delete($sqldelete1);
        }
    if ($res1){
        header('Location:'.$_POST['uri']);
    }        
}
//====================================================================================================== 
function deletebev() {
    global $dbhandler0;
    $bev_id = !empty($_POST['bev_id']) ? $_POST['bev_id'] : '';
 
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
        }
    if ($res1 && $res2){
        header('Location:'.$_POST['uri']);
    }        
}
//======================================================================================================
function deletebevprice() {
    global $dbhandler0;
    $bev_price_id = !empty($_POST['bev_price_id']) ? $_POST['bev_price_id'] : '';
 
    $sqlcheck = 
        "SELECT a.* FROM bev_price a where a.i_price_id = '$bev_price_id'";

        $res = $dbhandler0->query($sqlcheck);

    if ($res)
        {
            //start delete 
                $sqldelete1 = "DELETE FROM bev_price where i_price_id = '$bev_price_id'"; 
                $res1 = $dbhandler0->delete($sqldelete1);
        }
    if ($res1){
        header('Location:'.$_POST['uri']);
    }        
}
//====================================================================================================== 
?>