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
?>