<?php
include "system/function.php";
include "lib/db.php";
include "config.php";
include "getpath.php";

 global $dbhandler0;
    $sqlcheck = "SELECT value
    FROM settings 
    where name = 'dev'";
    //===============================================
    $res = $dbhandler0->query($sqlcheck);
    var_dump(expression)$res,1[];
?>