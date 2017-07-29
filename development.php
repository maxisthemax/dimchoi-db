<!DOCTYPE html>
<?php
include "lib/db.php";
include "config.php";
include "getpath.php";
include "setvariable.php";
?>

<form action="" method="post">
    <input type="submit" name="page" value="Main Test" />
    <input type="submit" name="page" value="Restaurant" />
    <input type="submit" name="page" value="Food" />
</form>

<?php
if (!empty($_POST['page']))
{
    switch($_POST["page"]){
        case "Main Test":
            include "development/test.php";
            break;
        case "Restaurant":
            include "development/restaurant.php";
            break;
        case "Food":
            include "development/food.php";
            break;
        }
}
?>